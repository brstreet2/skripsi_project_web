<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Transaction;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xendit\Xendit;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pricing-plan.pricing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPremium()
    {
        return view('backend.pricing-plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePremium(Request $request)
    {
        $user = Sentinel::getUser();
        $code = $request->payment_method;
        if ($code == 'bca') {
            try {
                $user = Sentinel::getUser();
                $date = date('ymd');
                $transaction = Transaction::orderBy('id', 'desc')->first();
                if ($transaction == null) {
                    $id = 1;
                } else {
                    $code_last = substr($transaction->transaction_code, -4);
                    $code_date = substr($transaction->transaction_code, 0, 6);
                    if ($code_date == $date) {
                        $id = (int)$code_last + 1;
                    } else {
                        $id = 1;
                    }
                }
                $transaction_code_new = $date . sprintf("%04d", $id);

                $transactionDb                                 = new Transaction();
                $transactionDb->user_id                        = $user->id;
                $transactionDb->transaction_code               = $transaction_code_new;
                $transactionDb->date                           = date('Y-m-d');
                $transactionDb->nominal                        = 205000;
                $transactionDb->notes                          = 'Upgrade Akun Premium';
                $transactionDb->virtual_account_bank           = strtoupper($code) . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by                     = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_YFJm4CcsCZlhBkMiAHGs0buS0s613B5jBTHL5GzApXCcshsHTJkhPhfFeOBXUU');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 205000,
                    'expiration_date'       => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'))
                ];

                $createVa                                   = \Xendit\VirtualAccounts::create($params);
                $transactionDb->transaction_id              = $createVa['id'];
                $transactionDb->status_string               = $createVa['status'];
                $transactionDb->virtual_account_number      = $createVa['account_number'];
                $transactionDb->paid_at                     = null;
                $transactionDb->expired_date                = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));
                $transactionDb->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }

        if ($code == 'bni') {
            try {
                $user = Sentinel::getUser();
                $date = date('ymd');
                $transaction = Transaction::orderBy('id', 'desc')->first();
                if ($transaction == null) {
                    $id = 1;
                } else {
                    $code_last = substr($transaction->transaction_code, -4);
                    $code_date = substr($transaction->transaction_code, 0, 6);
                    if ($code_date == $date) {
                        $id = (int)$code_last + 1;
                    } else {
                        $id = 1;
                    }
                }
                $transaction_code_new = $date . sprintf("%04d", $id);

                $transactionDb                                  = new Transaction();
                $transactionDb->user_id                         = $user->id;
                $transactionDb->transaction_code                = $transaction_code_new;
                $transactionDb->date                            = date('Y-m-d');
                $transactionDb->nominal                         = 205000;
                $transactionDb->notes                           = 'Upgrade Akun Premium';
                $transactionDb->virtual_account_bank            = strtoupper($code) . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by                      = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_YFJm4CcsCZlhBkMiAHGs0buS0s613B5jBTHL5GzApXCcshsHTJkhPhfFeOBXUU');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 205000,
                    'expiration_date'       => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'))
                ];

                $createVa                                   = \Xendit\VirtualAccounts::create($params);
                $transactionDb->transaction_id              = $createVa['id'];
                $transactionDb->status_string               = $createVa['status'];
                $transactionDb->virtual_account_number      = $createVa['account_number'];
                $transactionDb->paid_at                     = null;
                $transactionDb->expired_date                = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));
                $transactionDb->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }

        if ($code == 'bri') {
            try {
                $user = Sentinel::getUser();
                $date = date('ymd');
                $transaction = Transaction::orderBy('id', 'desc')->first();
                if ($transaction == null) {
                    $id = 1;
                } else {
                    $code_last = substr($transaction->transaction_code, -4);
                    $code_date = substr($transaction->transaction_code, 0, 6);
                    if ($code_date == $date) {
                        $id = (int)$code_last + 1;
                    } else {
                        $id = 1;
                    }
                }
                $transaction_code_new = $date . sprintf("%04d", $id);

                $transactionDb                          = new Transaction();
                $transactionDb->user_id                 = $user->id;
                $transactionDb->transaction_code        = $transaction_code_new;
                $transactionDb->date                    = date('Y-m-d');
                $transactionDb->nominal                 = 205000;
                $transactionDb->notes                   = 'Upgrade Akun Premium';
                $transactionDb->paid_at                 = date('Y-m-d H:i:s');
                $transactionDb->virtual_account_bank    = $code . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by              = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_YFJm4CcsCZlhBkMiAHGs0buS0s613B5jBTHL5GzApXCcshsHTJkhPhfFeOBXUU');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 205000,
                    'expiration_date'       => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'))
                ];

                $createVa                                  = \Xendit\VirtualAccounts::create($params);
                $transactionDb->transaction_id             = $createVa['id'];
                $transactionDb->status_string              = $createVa['status'];
                $transactionDb->virtual_account_number     = $createVa['account_number'];
                $transactionDb->paid_at                    = null;
                $transactionDb->expired_date               = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));
                $transactionDb->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }

        if ($code == 'mandiri') {
            try {
                $user = Sentinel::getUser();
                $date = date('ymd');
                $transaction = Transaction::orderBy('id', 'desc')->first();
                if ($transaction == null) {
                    $id = 1;
                } else {
                    $code_last = substr($transaction->transaction_code, -4);
                    $code_date = substr($transaction->transaction_code, 0, 6);
                    if ($code_date == $date) {
                        $id = (int)$code_last + 1;
                    } else {
                        $id = 1;
                    }
                }
                $transaction_code_new = $date . sprintf("%04d", $id);

                $transactionDb                          = new Transaction();
                $transactionDb->user_id                 = $user->id;
                $transactionDb->transaction_code        = $transaction_code_new;
                $transactionDb->date                    = date('Y-m-d');
                $transactionDb->nominal                 = 205000;
                $transactionDb->notes                   = 'Upgrade Akun Premium';
                $transactionDb->paid_at                 = date('Y-m-d H:i:s');
                $transactionDb->virtual_account_bank    = $code . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by              = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_YFJm4CcsCZlhBkMiAHGs0buS0s613B5jBTHL5GzApXCcshsHTJkhPhfFeOBXUU');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 205000,
                    'expiration_date'       => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'))
                ];

                $createVa                                   = \Xendit\VirtualAccounts::create($params);
                $transactionDb->transaction_id              = $createVa['id'];
                $transactionDb->status_string               = $createVa['status'];
                $transactionDb->virtual_account_number      = $createVa['account_number'];
                $transactionDb->paid_at                     = null;
                $transactionDb->expired_date                = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));
                $transactionDb->save();

                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                dd($exception);
            }
        }
    }
}
