<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Mail\activationEmail;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function home()
    {
        return view('auth.dashboard');
    }

    public function registerForm()
    {
        if (!Sentinel::getUser()) {
            return view('auth.register');
        } else {
            return redirect()->route('dashboard.index');
        }
    }

    public function register(registerRequest $request)
    {
        $upperCaseName = ucwords($request->name);
        $credentials = [
            'name'      => $upperCaseName,
            'email'     => $request->email,
            'password'  => $request->password,
            'token'     => '',
            'user_type' => 1
        ];

        $find = User::where("email", $request->email)->first();
        if ($find) {
            session()->flash("error", "Email telah terdaftar.");
            return back();
        }

        $user       = Sentinel::register($credentials);
        $activation = Activation::create($user);
        $role       = Role::where('slug', 'admin')->first();
        $role       = Sentinel::findRoleById($role->id);
        $role->users()->attach($user);
        Mail::to($user->email)->send(new activationEmail($user, $activation->code));
        toastr()->success('Registrasi berhasil! Periksa inbox email anda untuk aktivasi akun.', 'Success');
        return back();
    }

    public function loginForm()
    {
        if (!Sentinel::getUser()) {
            return view('auth.login');
        } else {
            return redirect()->route('dashboard.index');
        }
    }

    public function login(loginRequest $request)
    {
        $credentials = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        $remember = $request->remember == 'On' ? true : false;

        try {
            if (Sentinel::authenticate($credentials, $remember)) {
                toastr()->success('Selamat datang, ' . Sentinel::getUser()->name . '!', 'Success');
                if ($request->rto !== null) {
                    return redirect()->to($request->rto);
                } else {
                    return redirect()->route('dashboard.index');
                }
            } else {
                toastr()->error('Email atau Password salah!', 'Error');
                return redirect()->route('auth.login.form');
            }
        } catch (ThrottlingException $ex) {
            toastr()->error('Terjadi kesalahan ...', 'Error');
            return redirect()->route('auth.login.form');
        } catch (NotActivatedException $ex) {
            toastr()->error('Akun perlu di aktivasi!', 'Error');
            return redirect()->route('auth.login.form');
        }
    }

    public function logout()
    {
        Sentinel::logout();
        toastr()->info('Berhasil keluar.', 'Info');
        return redirect()->route('auth.login.form');
    }

    public function activateAccount($code)
    {
        DB::beginTransaction();
        try {
            $activation = Activation::where('code', $code)->first();
            if ($activation) {
                if ($activation->completed == 0) {
                    $userDb = User::find($activation->user_id);

                    $activation->completed    = 1;
                    $activation->completed_at = date('Y-m-d H:i:s');
                    $activation->save();

                    $userDb->token             = '';
                    $userDb->email_verified_at = date('Y-m-d H:i:s');
                    $userDb->save();
                } else {
                    // session()->flash('Your account has been activated');
                    toastr()->info('Akun anda telah di aktivasi.', 'Info');
                    return redirect()->route('auth.login.form');
                }
            } else {
                toastr()->error('Link tidak sah!', 'Error');
                return redirect()->route('auth.login.form');
            }
            DB::commit();
            toastr()->info('Akun anda berhasil di aktivasi!', 'Success');
            return redirect()->route('auth.login.form');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
