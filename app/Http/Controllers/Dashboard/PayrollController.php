<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CompanyEmployees;
use App\Models\EmployeePayroll;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('fileToUpload')) {
                $employee       = User::findOrFail($request->user_id);
                $employeeSlug   = Str::slug($employee->name, '-');
                try {
                    $filePayroll                    = $request->file('fileToUpload');
                    $hash                           = hash('md2', Sentinel::getUser()->company->id);
                    $destinationPath                = 'company/' . $hash . '/employee-payroll/' . $employeeSlug . '/' . Carbon::now()->format('Y-m');
                    $originalFile                   = $filePayroll->getClientOriginalName();
                    $filenamePayroll                = strtotime(date('Y-m-d-H:isa')) . $originalFile;
                    try {
                        $s3     = Storage::disk('s3')->put($destinationPath, $filePayroll, 'public');
                        $url    = Storage::disk('s3')->url($s3);

                        $payrollDb                  = new EmployeePayroll();
                        $payrollDb->employee_id     = $request->user_id;
                        $payrollDb->url             = $url;
                        $payrollDb->date            = Carbon::now()->format('Y-m-d H:i:s');
                        $payrollDb->save();

                        DB::commit();
                        return response()->json([
                            'error'   => false,
                            'message' => 'OK',
                            'data'    => $payrollDb,
                            'status'  => 200
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
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'error'   => false,
                        'message' => $e->getMessage(),
                        'data'    => null,
                        'status'  => 500
                    ], 500);
                }
            } else {
                return response()->json([
                    'error'   => false,
                    'message' => 'No file uploaded.',
                    'data'    => null,
                    'status'  => 401
                ], 401);
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

    public function update(Request $request, $id)
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
                    $payrollDb = EmployeePayroll::where('employee_id', $dataDb->user_id)->whereMonth('date', Carbon::now())->first();
                    if ($payrollDb) {
                        return '<a href="' . $payrollDb->url . '" target="_blank" class="btn"><i class="fa-solid fa-eye fa-lg" style="color: #6893df;"></i></a>';
                    } else {
                        return '<button class="btn" data-bs-toggle="tooltip" id="uploadButton" data-id="' . $dataDb->user_id . '" data-name="' . $user->name . '" type="button" data-bs-placement="bottom" title="Upload File"><i class="fa-solid fa-plus fa-lg" style="color: #6893df;"></i></button>';
                    }
                }
            )
            ->addColumn(
                'status',
                function ($dataDb) {
                    $payrollDb = EmployeePayroll::where('employee_id', $dataDb->user_id)->whereMonth('date', Carbon::now())->first();
                    if ($payrollDb) {
                        return '<span class="badge bg-success">Telah di upload</span>';
                    } else {
                        return '<span class="badge bg-secondary">Belum di upload</span>';
                    }
                }
            )
            ->rawColumns(array('checkbox', 'action', 'user_name', 'status'))
            ->make(true);
    }
}
