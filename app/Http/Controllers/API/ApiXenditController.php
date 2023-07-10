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

            $transaction = Transaction::where('transaction_id', $id)->first();

            if ($transaction) {
                $transaction->status_string      = $status;
                $transaction->save();
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

        $transactionDb       = Transaction::where('transaction_code', $external_id)->first();
        Log::info("VA_DEPOSIT DATA", [$transactionDb]);

        if ($transactionDb) {
            $transactionDb->status_string           = 'PAID';
            $transactionDb->paid_at                 = $paid_at;
            $transactionDb->save();
            Log::info("DEPOSITDB #1", [$transactionDb]);
            $user       = Sentinel::findById($transactionDb->user_id);


            $user             = User::where('id', $transactionDb->user_id)->first();
            $user->user_type  = 1;
            $user->updated_by = $user->name;
            $user->save();
            return 'PAID';
        }
    }
}
