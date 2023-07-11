<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\companyRequest;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Industry;
use App\Models\Province;
use App\Models\Regency;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();

        return view('backend.company.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.company.editcompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(companyRequest $request)
    {
        DB::beginTransaction();
        try {
            $companyDb                      = new Company();
            $companyDb->name                = $request->company_name;
            $companyDb->phone               = $request->company_phone;
            $companyDb->pic_email           = $request->company_spv;
            $companyDb->address             = $request->company_address;
            $companyDb->province_id         = $request->company_province;
            $companyDb->province_string     = Province::where('id', $request->company_province)->first()->value('name');
            $companyDb->city_id             = $request->company_city;
            $companyDb->city_string         = Regency::where('id', $request->company_city)->first()->value('name');;
            $companyDb->industry            = $request->company_industry;
            $companyDb->industry_string     = Industry::where('id', $request->company_industry)->first()->value('name');;
            $companyDb->company_size_id     = $request->company_size;
            $companyDb->company_size_string = CompanySize::where('id', $request->company_size)->first()->value('size');
            $companyDb->owner_id            = Sentinel::getUser()->id;
            $companyDb->created_by          = Sentinel::getUser()->name;
            $companyDb->created_at          = Carbon::now();
            $companyDb->longitude           = $request->longitude;
            $companyDb->latitude            = $request->latitude;
            $companyDb->save();

            DB::commit();
            toastr()->success('Anda telah berhasil membuat perusahaan!', 'Success');
            return redirect()->route('company.index');
        } catch (\Exception $e) {
            Log::error("----------------------------------------------------");
            Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
            Log::error("Error Exception Code: " . $e->getCode());
            Log::error("Error at controller: CompanyController");
            Log::error("Error at function / method: store");
            Log::error("Error Message: " . $e->getMessage());
            Log::error("Rolling Back Process ...");
            DB::rollback();
            Log::error("Rollback Success!");
            Log::error("Redirecting back ...");
            Log::error("----------------------------------------------------");
            toastr()->error('Something went wrong ...', 'Error');
            return back();
        }
    }

    public function edit($id)
    {
        return view('backend.company.edit', ['company' => Company::find($id)]);
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function getProvinces(Request $request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;
            $term = $request->term;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $count = Province::count();

            if ($count > $perPage) {
                $perPage = $count;
            }

            $dataDb = Province::select('id', 'name as text')->where('name', 'LIKE', '%' . $request->term . '%')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function getRegencies(Request $request)
    {
        try {
            $dataDb = Regency::where('province_id', $request->province_id)->get();

            return response()->json($dataDb);
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function getIndustries(Request $request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;
            $term = $request->term;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $count = Industry::count();

            if ($count > $perPage) {
                $perPage = $count;
            }

            $dataDb = Industry::select('id', 'name as text')->where('name', 'LIKE', '%' . $request->term . '%')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function getCompanySizes(Request $request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;
            $term    = $request->term;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $count = CompanySize::count();

            if ($count > $perPage) {
                $perPage = $count;
            }

            $dataDb = CompanySize::select('id', 'size as text')->where('size', 'LIKE', '%' . $request->term . '%')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function submitPhoto(Request $request)
    {
        $user = Sentinel::getUser();
        DB::beginTransaction();
        if ($request->hasFile('company_image')) {
            $timestamp = Carbon::now();
            $hash      = hash('md2', $timestamp);
            $extension = $request->company_image->getClientOriginalExtension();
            $filenamePath  = 'company_avatar/' . $hash . '_' . $user->company->id;
            try {
                $s3     = Storage::disk('s3')->put($filenamePath, $request->company_image, 'public');
                $url    = Storage::disk('s3')->url($s3);

                $companyDb              = Company::find($user->company->id);
                $companyDb->ava_url     = $url;
                $companyDb->save();

                DB::commit();
                return response()->json([
                    'error'     => false,
                    'message'   => 'success',
                    'data'      => $request->company_image->getClientOriginalName(),
                    'status'    => 200
                ], 200);
            } catch (\Exception $e) {
                report($e);
                return response()->json([
                    'error'     => true,
                    'message'   => $e->getMessage(),
                    'data'      => [],
                    'status'    => 500
                ], 500);
            }
        } else {
            return response()->json([
                'error'     => true,
                'message'   => "NO INPUT!",
                'data'      => [],
                'status'    => 500
            ], 500);
        }
    }
}
