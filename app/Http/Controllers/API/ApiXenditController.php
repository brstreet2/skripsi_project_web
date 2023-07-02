<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Xendit\Xendit;

class ApiXenditController extends Controller
{
    public function va_created(Request $request)
    {
        Xendit::setApiKey('xnd_development_jo4hshZNW3xKXPcJsBJFauH75tT0NucIGIj9uHWlHxJpVGOTAIPVCXZ');

        $id                  = $request->id;
        $external_id         = $request->external_id;
        $bank_code           = $request->bank_code;
        $account_number      = $request->account_number;
        $status              = $request->status;
        $expected_amount     = $request->expected_amount;

        if ($status == "ACTIVE") {
            if ($request->failure_code != null) {
                $failure_code = ' karena ' . $request->failure_code;
            } else {
                $request->failure_code = '';
                $failure_code = '';
            }

            $deposit = Transaction::where('transaction_id', $id)->first();

            if ($deposit) {
                $deposit->transaction_status = $status;
                $deposit->payment_method     = $bank_code . '_VA';
                $deposit->save();
            }
        }

        Log::info("VA_CREATED DATA", [$request]);
    }

    public function va_paid(Request $request)
    {
        Xendit::setApiKey('xnd_development_jo4hshZNW3xKXPcJsBJFauH75tT0NucIGIj9uHWlHxJpVGOTAIPVCXZ');

        $external_id         = $request->external_id;
        $bank_code           = $request->bank_code;
        $account_number      = $request->account_number;
        $amount              = $request->amount;
        $payment_id          = $request->payment_id;
        $paid_at             = Carbon::parse($request->transaction_timestamp)->format('Y-m-d H:i:s');

        Log::info("VA_PAID DATA", [$external_id, $bank_code, $account_number, $amount, $payment_id, $paid_at]);
        Log::info("VA_PAID DATA #2: ", [$request]);

        $depositDb          = Transaction::where('deposit_code', $external_id)->first();
        Log::info("VA_DEPOSIT DATA", [$depositDb]);

        if ($depositDb) {
            $depositDb->transaction_status      = 'PAID';
            $depositDb->paid_at                 = $paid_at;
            $depositDb->payment_id              = $payment_id;
            $depositDb->save();
            Log::info("DEPOSITDB #1", [$depositDb]);
            $user       = Sentinel::findById($depositDb->user_id);
            $logDepositDb = 'Deposit Code: ' . $external_id . ' has been completed by: ' . $user->name . ' (ID: ' . $depositDb->user_id . ')';

            $user = User::where('id', $depositDb->user_id)->first();
            $user->saldo      = Transaction::where('user_id', $depositDb->user_id)->whereNotNull('paid_at')->sum('nominal');
            $user->updated_by = $user->name;
            $user->save();

            $logSaldo   = "User: " . $user->name . " (ID: " . $user->id . "), successfully added: " . $depositDb->nominal . ", current saldo: " . $user->saldo;

            return 'PAID';
        }
    }
}
