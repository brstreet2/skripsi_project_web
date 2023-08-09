<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\EmployeePayroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;

class ApiPayrollController extends Controller
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
            $month   = Carbon::now();
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

                $payrollDb       = EmployeePayroll::where('employee_id', $user->id)->whereMonth('date', $month->month)->first();
                if ($payrollDb) {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => $payrollDb,
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
                'message'   => 'error',
                'data'      => '',
                'status'    => 403
            ], 403);
        }
    }
}
