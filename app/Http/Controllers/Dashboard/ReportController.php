<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CompanyEmployees;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeTimeOff;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $dataDb = CompanyEmployees::where('company_id', $user->company->id)->get();
        if ($dataDb) {
            $employee = $dataDb;
        } else {
            $employee = null;
        }
        return view('backend.report.index', compact('employee'));
    }

    public function datatables(Request $request)
    {
        $user = User::find($request->user_id);

        if (!isset($user)) {
            $dataDb = [];
        } else {
            if (!$request->user_id) {
                $dataDb = EmployeeAttendance::where('employee_id', $user->id)->whereMonth('period', $request->current_month)->with('attendance_detail', 'user')->get();
            } elseif ($request->user_id) {
                $dataDb = EmployeeAttendance::where('employee_id', $user->id)->whereMonth('period', $request->current_month)->with('attendance_detail', 'user')->get();
            }
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

    public function secondDatatables(Request $request)
    {
        $user = User::find($request->user_id);

        if (!isset($user)) {
            $dataDb = [];
        } else {
            if (!$request->user_id) {
                $dataDb = EmployeeTimeOff::where('employee_id', $user->id)->whereMonth('start_date', $request->current_month)->with('user')->get();
            } elseif ($request->user_id) {
                $dataDb = EmployeeTimeOff::where('employee_id', $user->id)->whereMonth('start_date', $request->current_month)->with('user')->get();
            }
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
            ->filter(function ($instance) use ($request) {
                if ($request->get('month') == '0' || $request->get('month') == '1') {
                    $instance->whereMonth('period', $request->get('month'));
                }
            })
            ->rawColumns(array('checkbox', 'start_date', 'end_date', 'status', 'type'))
            ->make(true);
    }
}
