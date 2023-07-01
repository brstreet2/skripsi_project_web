<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CompanyEmployees;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceDetail;
use App\Models\EmployeePayroll;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.attendance.index');
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

    public function presence($id)
    {
        $user = Sentinel::getUser();
        return view('backend.attendance.view', compact('user'));
    }

    public function presenceDatatables(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$request->select_month) {
            $dataDb = EmployeeAttendance::where('employee_id', $user->id)->whereMonth('period', $request->current_month)->with('attendance_detail', 'user')->get();
        } elseif ($request->select_month) {
            $dataDb = EmployeeAttendance::where('employee_id', $user->id)->whereMonth('period', $request->select_month)->with('attendance_detail', 'user')->get();
        }

        return DataTables::of($dataDb)
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->addColumn(
                'clock_in',
                function ($dataDb) {
                    return $dataDb->attendance_detail[0]->clock_in;
                }
            )
            ->addColumn(
                'clock_out',
                function ($dataDb) {
                    return $dataDb->attendance_detail[0]->clock_out;
                }
            )
            ->addColumn(
                'status',
                function ($dataDb) {
                    if ($dataDb->attendance_detail[0]->status == 0) {
                        return 'Menunggu persetujuan';
                    } elseif ($dataDb->attendance_detail[0]->status == 1) {
                        return '<p class="text-success">Telah disetujui</p>';
                    } else {
                        return '<p class="text-danger">Ditolak</p>';
                    }
                }
            )
            ->addColumn(
                'action',
                function ($dataDb) {
                    if ($dataDb->attendance_detail[0]->status == 0) {
                        return '<button class="btn btn-success btn-md text-center" data-bs-toggle="tooltip" id="approveBtn" data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Terima kehadiran ' . $dataDb->user->name . '?"><i class="fa-solid fa-check fa-sm"></i></button>
                        <button class="btn btn-danger" btn-md text-center data-bs-toggle="tooltip" id="rejectBtn" data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Tolak kehadiran ' . $dataDb->user->name . '?"><i class="fa-sharp fa-solid fa-x fa-sm"></i></button>';
                    } elseif ($dataDb->attendance_detail[0]->status == 1) {
                        return '<button class="btn btn-warning btn-md text-center" data-bs-toggle="tooltip"data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Edit"><i class="fa-sharp fa-solid fa-pen-to-square fa-sm"></i></button>';
                    } else {
                    }
                }
            )
            ->addColumn(
                'second_action',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->filter(function ($instance) use ($request) {
                if ($request->get('month') == '0' || $request->get('month') == '1') {
                    $instance->whereMonth('period', $request->get('month'));
                }
            })
            ->rawColumns(array('checkbox', 'action', 'mmonth', 'status'))
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
                    return '<a href="' . route('attendance.presence', $dataDb->user_id) . '" id="tooltip" title="Lihat Kehadiran"><button class="btn btn-primary fw-bolder mb-4 px-4 rounded-pill" style="background-color: #444EFF" >Lihat</button></a>';
                }
            )
            ->addColumn(
                'second_action',
                function ($dataDb) {
                    return;
                }
            )
            ->rawColumns(array('checkbox', 'action', 'user_name'))
            ->make(true);
    }

    public function attendanceApprove(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeAttendanceDetail::where('id', $request->id)->first();
            $dataDb->status        = 1;
            $dataDb->status_string = 'Di-terima';
            $dataDb->save();
            DB::commit();
            return response()->json([
                'error'     => false,
                'message'   => 'Data approved!',
                'data'      => $dataDb,
                'status'    => 200
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error'     => true,
                'message'   => $e->getMessage(),
                'data'      => null,
                'status'    => 401
            ], 401);
        }
    }
}
