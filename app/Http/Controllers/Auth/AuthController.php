<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Mail\activationEmail;
use App\Mail\forgotPassEmail;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
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

    public function forgotPassForm()
    {
        return view('template.forgot-password');
    }

    public function forgotPass(Request $request)
    {
        $request->validate([
            'email' => "required|email"
        ], [
            'email.required'    => "Email tidak boleh kosong",
            'email.email'       => "Format Email salah"
        ]);

        $checkUser = User::where('email', $request->email)->first();
        if (!$checkUser) {
            toastr()->success("Kami telah mengirim tautan ke Email anda untuk Perbaharui kata sandi anda. Silahkan cek Email anda.", 'Success');
            return back();
        }

        $user = Sentinel::findByCredentials(['login' => $checkUser->email]);

        $checkReminder = Reminder::exists($user);
        if (!$checkReminder) {
            $reminder = Reminder::create($user);
        } else {
            $reminder = Reminder::where('user_id', $user->id)->where('completed', 0)->first();
        }
        $code = $reminder->code;

        Mail::to($user->email)->send(new forgotPassEmail($user, $code));

        toastr()->success('Kami telah mengirim tautan ke Email anda untuk perbaharui kata sandi anda. Silahkan cek Email anda.', 'Success');
        return back();
    }

    public function setPasswordForm($token = null)
    {
        $reminder = Reminder::where('code', $token)->first();
        if ($reminder) {
            if ($reminder->completed == 0) {
                $userDb = Sentinel::findById($reminder->user_id);

                $validLink = true;
                $user_id   = $userDb->id;
            } else {
                $validLink = false;
                session()->flash("error", "Link expired.");
            }
        } else {
            $validLink = false;
            session()->flash("error", "Link tidak valid.");
        }

        return view('template.reset-password', compact('validLink', 'token'));
    }

    public function setPassword($token = null, Request $request)
    {
        $request->validate([
            'password'    => "required|min:8",
            'repassword'  => "required|same:password"
        ], [
            'password.required'   => "Password tidak boleh kosong",
            'password.min'        => "Password minimal 8 karakter",
            'repassword.required' => "Konfirmasi Password tidak boleh kosong",
            'repassword.same'     => "Konfirmasi Password tidak sesuai."
        ]);

        if ($request->token == null || $request->token == '') {
            session()->flash("error", "Link tidak valid");
            return back();
        } else {
            $reminder = Reminder::where('code', request()->token)->first();
            if ($reminder) {
                if ($reminder->completed == 0) {
                    $userDb = Sentinel::findById($reminder->user_id);

                    Reminder::complete($userDb, request()->token, request()->password);

                    session()->flash("success", "Reset Password berhasil");
                    return redirect()->route('auth.login.form');
                } else {
                    session()->flash("error", "Link expired");
                    return back();
                }
            } else {
                session()->flash("error", "Link tidak valid");
                return back();
            }
        }
    }
}
