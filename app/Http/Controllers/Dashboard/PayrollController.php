<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyEmployees;
use App\Models\Payroll;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.payroll.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('fileToUpload')) {
                $file_name = $request->file('fileToUpload')->getClientOriginalName();
                $earn_proof = $request->file('fileToUpload')->storeAs("public/files/", $file_name);

                $payrollDb                  = new Payroll();
                $payrollDb->employee_id     = $request->user_id;
                $payrollDb->url             = $file_name;
                $payrollDb->date            = Carbon::now()->format('Y-m-d H:i:s');
                $payrollDb->save();

                DB::commit();
                return response()->json(['success' => true], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'error'     => true,
                'code'      => 500,
                'message'   => $th->getMessage()
            ]);
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

    public function datatables(Request $request)
    {
        $user = Sentinel::getUser();

        $dataDb = CompanyEmployees::where('company_id', $user->company->id)->get();

        return DataTables::of($dataDb)
            ->addColumn('user_name', function ($dataDb) {
                $user = Sentinel::findById($dataDb->user_id);
                return $user->name;
            })
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->addColumn(
                'action',
                function ($dataDb) {
                    $user = Sentinel::findById($dataDb->user_id);
                    return '<button class="btn" data-bs-toggle="tooltip" id="uploadButton" data-id="' . $dataDb->user_id . '" data-name="' . $user->name . '" type="button" data-bs-placement="bottom" title="Delete ' . $dataDb->name . '?"><i class="fa-solid fa-trash fa-lg" style="color: #6893df;"></i></button>';
                }
            )
            ->rawColumns(array('checkbox', 'action', 'user_name'))
            ->make(true);
    }
}
