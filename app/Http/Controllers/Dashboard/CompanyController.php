<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\companyRequest;
use App\Models\Company;
use App\Models\Industry;
use App\Models\Province;
use App\Models\Regency;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $companyDb                  = new Company();
            $companyDb->name            = $request->company_name;
            $companyDb->phone           = $request->company_phone;
            $companyDb->pic_email       = $request->company_spv;
            $companyDb->address         = $request->company_address;
            $companyDb->province_id     = $request->company_province;
            $companyDb->province_string = '';
            $companyDb->city_id         = $request->company_city;
            $companyDb->city_string     = '';
            $companyDb->industry        = $request->company_industry;
            $companyDb->industry_string = '';
            $companyDb->company_size_id = $request->company_size;
            $companyDb->pic_id          = Sentinel::getUser()->id();
            $companyDb->created_by      = Sentinel::getUser()->name();
            $companyDb->created_at      = Carbon::now();

            DB::commit();
            return back();
        } catch (\Exception $e) {
            Log::error("----------------------------------------------------");
            Log::error("Error Log Date: " . Carbon::now('Y-m-d H:i:s'));
            Log::error("Error Exception Code: " . $e->getCode());
            Log::error("Error at controller: CompanyController");
            Log::error("Error at function / method: store");
            Log::error("Error Message: " . $e->getMessage());
            Log::error("Rolling Back Process ...");
            DB::rollback();
            Log::error("Rollback Success!");
            Log::error("Redirecting back ...");
            Log::error("----------------------------------------------------");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
}
