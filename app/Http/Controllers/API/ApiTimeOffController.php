<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\EmployeeTimeOff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;
use Illuminate\Support\Facades\Validator;

class ApiTimeOffController extends Controller
{
    public function get(Request $request)
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

                $timeOffDb       = EmployeeTimeOff::where('employee_id', $user->id)->get();
                if ($timeOffDb) {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => $timeOffDb,
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
    public function post(Request $request)
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

                $validator  = Validator::make($request->all(), [
                    'start_date'      => 'required',
                    'end_date'        => 'required',
                    'type'            => 'required',
                    'type_string'     => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'error'     => true,
                        'message'   => 'Invalid Input',
                        'data'      => '',
                        'status'    => 403
                    ], 403);
                }

                $employeeTimeoffDb                   = new EmployeeTimeOff();
                $employeeTimeoffDb->employee_id      = $user->id;
                $employeeTimeoffDb->type             = $request->type;
                $employeeTimeoffDb->type_string      = $request->type_string;
                $employeeTimeoffDb->start_date       = $request->start_date;
                $employeeTimeoffDb->end_date         = $request->end_date;
                $employeeTimeoffDb->status           = 0;
                $employeeTimeoffDb->status_string    = 'Menunggu persetujuan';
                $employeeTimeoffDb->save();

                DB::commit();
                return response()->json([
                    'error'     => false,
                    'message'   => 'Timeoff Recorded.',
                    'data'      => $employeeTimeoffDb,
                    'status'    => 201
                ], 201);
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
}
