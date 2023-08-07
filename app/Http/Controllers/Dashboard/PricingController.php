<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $user = Sentinel::getUser();

        $transactionDb = Transaction::where('user_id', $user->id)
            ->where('status_string', 'PENDING')
            ->where('virtual_account_number', '!=', null)
            ->where('paid_at', null)
            ->orderBy('id', 'desc')->first();

        if ($transactionDb) {
            return redirect()->route('pricing.show', [$transactionDb->transaction_id]);
        }
        return view('backend.pricing-plan.create-premium');
    }

    public function createPro()
    {
        $user = Sentinel::getUser();

        $transactionDb = Transaction::where('user_id', $user->id)
            ->where('status_string', 'PENDING')
            ->where('virtual_account_number', '!=', null)
            ->where('paid_at', null)
            ->orderBy('id', 'desc')->first();

        if ($transactionDb) {
            return redirect()->route('pricing.show', [$transactionDb->transaction_id]);
        }
        return view('backend.pricing-plan.create-pro');
    }

    public function show($id)
    {
        $transactionDb = Transaction::where('transaction_id', $id)
            ->where('status_string', 'PENDING')
            ->where('virtual_account_number', '!=', null)
            ->where('paid_at', null)
            ->orderBy('id', 'desc')->first();

        if ($transactionDb) {
            return view('backend.pricing-plan.process', [
                'transactionDb' => Transaction::where('transaction_id', $id)->first(),
            ]);
        } else {
            dd($transactionDb = Transaction::where('transaction_id', $id)->first());
            // return view pembayaran berhasil
        }
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
        if ($code == 'BCA') {
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

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }

        if ($code == 'BNI') {
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

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }

        if ($code == 'BRI') {
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

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }

        if ($code == 'MANDIRI') {
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

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }
    }

    public function storePro(Request $request)
    {
        $user = Sentinel::getUser();
        $code = $request->payment_method;
        if ($code == 'BCA') {
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
                $transactionDb->nominal                        = 405000;
                $transactionDb->notes                          = 'Upgrade Akun Pro';
                $transactionDb->virtual_account_bank           = strtoupper($code) . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by                     = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 405000,
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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
                return back();
            }
        }

        if ($code == 'BNI') {
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
                $transactionDb->nominal                         = 405000;
                $transactionDb->notes                           = 'Upgrade Akun Pro';
                $transactionDb->virtual_account_bank            = strtoupper($code) . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by                      = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 405000,
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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }

        if ($code == 'BRI') {
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
                $transactionDb->nominal                 = 405000;
                $transactionDb->notes                   = 'Upgrade Akun Pro';
                $transactionDb->paid_at                 = date('Y-m-d H:i:s');
                $transactionDb->virtual_account_bank    = $code . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by              = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 405000,
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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
            }
        }

        if ($code == 'MANDIRI') {
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
                $transactionDb->nominal                 = 405000;
                $transactionDb->notes                   = 'Upgrade Akun Pro';
                $transactionDb->paid_at                 = date('Y-m-d H:i:s');
                $transactionDb->virtual_account_bank    = $code . ' VIRTUAL ACCOUNT';
                $transactionDb->created_by              = $user->name;
                $transactionDb->save();

                Xendit::setApiKey('xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo');

                $params = [
                    'external_id'           => $transactionDb->transaction_code,
                    'bank_code'             => $code,
                    'name'                  => 'UPGRADE AKUN - TIMKERJAKU',
                    'currency'              => 'IDR',
                    'is_single_use'         => true,
                    'is_closed'             => true,
                    'expected_amount'       => 405000,
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
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: PricingController");
                Log::error("Error Message: " . $e->getMessage());
                Log::error("Rolling Back Process ...");
                DB::rollback();
                Log::error("Rollback Success!");
                Log::error("Redirecting back ...");
                Log::error("----------------------------------------------------");
                toastr()->error('Terjadi kesalahan ...', 'Error');
                return back();
            }
        }
    }

    public function simulate($code)
    {
        $transactionDb = Transaction::where('transaction_code', $code)->first();

        try {
            $payload = json_encode(array("amount" => $transactionDb->nominal));

            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.xendit.co/callback_virtual_accounts/external_id=' . $code . '/simulate_payment');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode("xnd_development_vzMwjduoe6Auppur5ORS7xsm0tlpml50O1IW2kbchQoOZI2g3vArkVHFA8gIdo:")
            ));
            $response       = curl_exec($ch);
            $json_convert   = json_decode($response);
            curl_close($ch);

            toastr()->success('Pembayaran berhasil di-lakukan', 'Success');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Terjadi kesalahan ...', 'Error');
            return back();
            Log::info("ERR : Simulate Payment Error");
            Log::critical("Error Code: ");
        }
    }
}
