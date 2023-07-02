<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CompanyEmployees;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceDetail;
use App\Models\EmployeePayroll;
use App\Models\EmployeeTimeOff;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('backend.attendance.index');
    }

    public function presence($id)
    {
        $user = User::find($id);
        return view('backend.attendance.view', compact('user'));
    }

    public function absent($id)
    {
        $user = User::find($id);
        return view('backend.attendance.timeoff', compact('user'));
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
                        return '<p class="text-success fw-bold">Telah disetujui</p>';
                    } else {
                        return '<p class="text-danger fw-bold">Ditolak</p>';
                    }
                }
            )
            ->addColumn(
                'period',
                function ($dataDb) {
                    $date = Carbon::parse($dataDb->period)->locale('id');

                    $date->settings(['formatFunction' => 'translatedFormat']);

                    return $date->format('l, j F Y');
                }
            )
            ->addColumn(
                'action',
                function ($dataDb) {
                    if ($dataDb->attendance_detail[0]->status == 0) {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip" id="approveBtn" data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Terima kehadiran ' . $dataDb->user->name . '?"><i class="fa-solid fa-check fa-md" style="color: #6893df;"></i></button>
                        <button class="btn" btn-md text-center data-bs-toggle="tooltip" id="rejectBtn" data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Tolak kehadiran ' . $dataDb->user->name . '?"><i class="fa-sharp fa-solid fa-x fa-md" style="color: #6893df;"></i></button>';
                    } elseif ($dataDb->attendance_detail[0]->status == 1) {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip"data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Edit"><i class="fa-sharp fa-solid fa-pen-to-square fa-md" style="color: #6893df;"></i></button>';
                    } else {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip" id="showBtn" data-id="' . $dataDb->attendance_detail[0]->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Lihat alasan penolakan"><i class="fa-solid fa-eye fa-md" style="color: #6893df;"></i></button>';
                    }
                }
            )
            ->filter(function ($instance) use ($request) {
                if ($request->get('month') == '0' || $request->get('month') == '1') {
                    $instance->whereMonth('period', $request->get('month'));
                }
            })
            ->rawColumns(array('checkbox', 'action', 'month', 'status'))
            ->make(true);
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
                    return '<a href="' . route('attendance.presence', $dataDb->user_id) . '" id="tooltip" title="Lihat Kehadiran"><button class="btn btn-primary fw-bolder rounded-pill" style="background-color: #444EFF" ><i class="fa-sharp fa-solid fa-business-time"></i> Lihat</button></a>';
                }
            )
            ->addColumn(
                'second_action',
                function ($dataDb) {
                    return '<a href="' . route('attendance.absent', $dataDb->user_id) . '" id="tooltip" title="Lihat Kehadiran"><button class="btn btn-primary fw-bolder rounded-pill" style="background-color: #444EFF" ><i class="fa-sharp fa-regular fa-calendar-days"></i> Lihat</button></a>';
                }
            )
            ->rawColumns(array('checkbox', 'action', 'user_name', 'second_action'))
            ->make(true);
    }

    public function attendanceApprove(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeAttendanceDetail::where('id', $request->id)->first();
            $dataDb->status        = 1;
            $dataDb->status_string = 'Diterima';
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

    public function attendanceReject(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeAttendanceDetail::where('id', $request->id)->first();
            $dataDb->status        = 2;
            $dataDb->status_string = $request->status_string;
            $dataDb->save();
            DB::commit();
            return response()->json([
                'error'     => false,
                'message'   => 'Data telah ditolak!',
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

    public function attendanceReason(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeAttendanceDetail::where('id', $request->id)->first();
            DB::commit();
            return response()->json([
                'error'     => false,
                'message'   => 'DATA_FOUND',
                'data'      => $dataDb->status_string,
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

    public function absentDatatables(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$request->select_month) {
            $dataDb = EmployeeTimeOff::where('employee_id', $user->id)->whereMonth('start_date', $request->current_month)->with('user')->get();
        } elseif ($request->select_month) {
            $dataDb = EmployeeTimeOff::where('employee_id', $user->id)->whereMonth('start_date', $request->select_month)->with('user')->get();
        }

        return DataTables::of($dataDb)
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->addColumn(
                'type',
                function ($dataDb) {
                    if ($dataDb->type == 0) {
                        return 'Cuti';
                    } elseif ($dataDb->type == 1) {
                        return 'Izin';
                    }
                }
            )
            ->addColumn(
                'start_date',
                function ($dataDb) {
                    $date = Carbon::parse($dataDb->start_date)->locale('id');

                    $date->settings(['formatFunction' => 'translatedFormat']);

                    return $date->format('l, j F Y');
                }
            )
            ->addColumn(
                'end_date',
                function ($dataDb) {
                    $date = Carbon::parse($dataDb->end_date)->locale('id');

                    $date->settings(['formatFunction' => 'translatedFormat']);

                    return $date->format('l, j F Y');
                }
            )
            ->addColumn(
                'status',
                function ($dataDb) {
                    if ($dataDb->status == 0) {
                        return 'Menunggu persetujuan';
                    } elseif ($dataDb->status == 1) {
                        return '<p class="text-success fw-bold">Telah disetujui</p>';
                    } else {
                        return '<p class="text-danger fw-bold">Ditolak</p>';
                    }
                }
            )
            ->addColumn(
                'action',
                function ($dataDb) {
                    if ($dataDb->status == 0) {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip" id="approveBtn" data-id="' . $dataDb->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Terima izin / cuti ' . $dataDb->user->name . '?"><i class="fa-solid fa-check fa-md" style="color: #6893df;"></i></button>
                        <button class="btn" btn-md text-center data-bs-toggle="tooltip" id="rejectBtn" data-id="' . $dataDb->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Tolak izin / cuti ' . $dataDb->user->name . '?"><i class="fa-sharp fa-solid fa-x fa-md" style="color: #6893df;"></i></button>';
                    } elseif ($dataDb->status == 1) {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip"data-id="' . $dataDb->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Edit"><i class="fa-sharp fa-solid fa-pen-to-square fa-md" style="color: #6893df;"></i></button>';
                    } else {
                        return '<button class="btn btn-md text-center" data-bs-toggle="tooltip" id="showBtn" data-id="' . $dataDb->id . '" data-name="' . $dataDb->user->name . '" type="button" data-bs-placement="bottom" title="Lihat alasan penolakan"><i class="fa-solid fa-eye fa-md" style="color: #6893df;"></i></button>';
                    }
                }
            )
            ->filter(function ($instance) use ($request) {
                if ($request->get('month') == '0' || $request->get('month') == '1') {
                    $instance->whereMonth('period', $request->get('month'));
                }
            })
            ->rawColumns(array('checkbox', 'action', 'start_date', 'end_date', 'type', 'status'))
            ->make(true);
    }

    public function absentApprove(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeTimeOff::where('id', $request->id)->first();
            $dataDb->status        = 1;
            $dataDb->status_string = 'Diterima';
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

    public function absentReject(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeTimeOff::where('id', $request->id)->first();
            $dataDb->status        = 2;
            $dataDb->status_string = $request->status_string;
            $dataDb->save();
            DB::commit();
            return response()->json([
                'error'     => false,
                'message'   => 'Data telah ditolak!',
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

    public function absentReason(Request $request)
    {
        DB::beginTransaction();
        try {
            $dataDb                = EmployeeTimeOff::where('id', $request->id)->first();
            DB::commit();
            return response()->json([
                'error'     => false,
                'message'   => 'DATA_FOUND',
                'data'      => $dataDb->status_string,
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
