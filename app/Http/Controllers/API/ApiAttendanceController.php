<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;

class ApiAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $error      = false;
        $message    = '';

        try {
            $bearerToken = request()->bearerToken();
            if ($bearerToken == null) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid Token',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            }

            $tokenId    = app(Parser::class)->parse($bearerToken)->claims()->get('jti');
            $revoked    = Token::find($tokenId)->revoked;

            if ($revoked) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Not Allowed',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            } else {
                $userId     = app(Parser::class)->parse($bearerToken)->claims()->get('sub');

                $user       = User::find($userId);

                // $validator  = Validator::make($request->all(), [
                //     'date'      => 'required',
                // ]);

                // if ($validator->fails()) {
                //     return response()->json([
                //         'error'     => true,
                //         'message'   => 'Invalid Input',
                //         'data'      => '',
                //         'status'    => 403
                //     ], 403);
                // }

                $employee_attendance_id     = $request->attendance_id;
                $employee_attendance_date   = $request->date;
                $employee_clock_in          = $request->clock_in;
                $employee_clock_out         = $request->clock_out;

                $employeeAttendanceDb               = EmployeeAttendance::where('employee_id', $user->id)->where('period', $request->date)->first();

                if ($employeeAttendanceDb) {
                    $employeeAttendanceDetailDb             = EmployeeAttendanceDetail::where('attendance_id', $employeeAttendanceDb->id)->first();
                    $employeeAttendanceDetailDb->clock_out  = $employee_clock_out;
                    $employeeAttendanceDetailDb->save();

                    DB::commit();
                    return response()->json([
                        'error'     => false,
                        'message'   => 'Attendance Recorded.',
                        'data'      => $employeeAttendanceDetailDb,
                        'status'    => 201
                    ], 201);
                } else {
                    $employeeAttendanceDb               = new EmployeeAttendance();
                    $employeeAttendanceDb->employee_id  = $user->id;
                    $employeeAttendanceDb->period       = $request->date;
                    $employeeAttendanceDb->save();

                    $employeeAttendanceDetailDb                 = new EmployeeAttendanceDetail();
                    $employeeAttendanceDetailDb->attendance_id  = $employeeAttendanceDb->id;
                    $employeeAttendanceDetailDb->date           = $request->date;
                    $employeeAttendanceDetailDb->clock_in       = $employee_clock_in;
                    if ($request->has('clock_out')) {
                        $employeeAttendanceDetailDb->clock_out      = $employee_clock_out;
                    }
                    $employeeAttendanceDetailDb->status         = 0;
                    $employeeAttendanceDetailDb->status_string  = 'Waiting for Approval';
                    $employeeAttendanceDetailDb->created_at     = Carbon::now()->format('Y-m-d H:i:s');
                    $employeeAttendanceDetailDb->save();

                    DB::commit();
                    return response()->json([
                        'error'     => false,
                        'message'   => 'Attendance Recorded.',
                        'data'      => $employeeAttendanceDetailDb,
                        'status'    => 201
                    ], 201);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error'     => true,
                'message'   => dd($e),
                'data'      => '',
                'status'    => 407
            ], 407);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAttendance(Request $request)
    {
        DB::beginTransaction();
        $error      = false;
        $message    = '';

        try {
            $bearerToken = request()->bearerToken();
            if ($bearerToken == null) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid Token',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            }

            $tokenId = app(Parser::class)->parse($bearerToken)->claims()->get('jti');
            $period  = Carbon::now()->format('Y-m-d');
            $revoked = Token::find($tokenId)->revoked;

            if ($revoked) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Not Allowed',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            } else {
                $userId = app(Parser::class)->parse($bearerToken)->claims()->get('sub');

                $user = User::find($userId);
                $user->updated_by = $user->name;
                $user->save();

                $attendanceDb       = EmployeeAttendance::where('employee_id', $user->id)->where('period', $period)->first();
                if ($attendanceDb) {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => $attendanceDb,
                        'status' => $status
                    ], $status);
                } else {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => null,
                        'status' => $status
                    ], $status);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'     => true,
                'message'   => dd($e),
                'data'      => '',
                'status'    => 403
            ], 403);
        }
    }

    public function getAttendanceDetail(Request $request)
    {
        DB::beginTransaction();
        $error      = false;
        $message    = '';

        try {
            $bearerToken = request()->bearerToken();
            if ($bearerToken == null) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid Token',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            }

            $tokenId = app(Parser::class)->parse($bearerToken)->claims()->get('jti');
            $period  = Carbon::now()->format('Y-m-d');
            $revoked = Token::find($tokenId)->revoked;

            if ($revoked) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Not Allowed',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            } else {
                $userId = app(Parser::class)->parse($bearerToken)->claims()->get('sub');

                $user = User::find($userId);
                $user->updated_by = $user->name;
                $user->save();

                $attendanceDb       = EmployeeAttendance::where('employee_id', $user->id)->where('period', $period)->first();
                if ($attendanceDb) {
                    $attendanceDetailDb = EmployeeAttendanceDetail::where('attendance_id', $attendanceDb->id)->first();
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => [
                            'id'                => $attendanceDetailDb->id,
                            'attendance_id'     => $attendanceDetailDb->attendance_id,
                            'date'              => $attendanceDetailDb->date,
                            'clock_in'          => $attendanceDetailDb->clock_in,
                            'clock_out'         => $attendanceDetailDb->clock_out,
                            'status'            => $attendanceDetailDb->status,
                            'status_string'     => $attendanceDetailDb->status_string,
                            'created_at'        => $attendanceDetailDb->created_at,
                            'updated_at'        => $attendanceDetailDb->updated_at
                        ],
                        'status' => $status
                    ], $status);
                } else {
                    $attendanceDetailDb = null;
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => 'No Data',
                        'status' => $status
                    ], $status);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'     => true,
                'message'   => dd($e),
                'data'      => '',
                'status'    => 403
            ], 403);
        }
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
}
