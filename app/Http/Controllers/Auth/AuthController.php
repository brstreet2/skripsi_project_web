<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\loginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Mail\activationEmail;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(registerRequest $request)
    {
        $credentials = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password
        ];

        $user       = Sentinel::register($credentials);
        $activation = Activation::create($user);
        Mail::to($user->email)->send(new activationEmail($user, $activation->code));
        toastr()->success('Registration completed, check your inbox to activate your account!', 'Success');
        return back();
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(loginRequest $request)
    {
        $credentials = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        $remember = $request->remember == 'On' ? true : false;

        try {
            if(Sentinel::authenticate($credentials, $remember)) {
                toastr()->success('Welcome back '.Sentinel::getUser()->name.'!', 'Success');
                if($request->rto !== null)  {
                    return redirect()->to($request->rto);
                } else {
                    return redirect()->route('dashboard.index');
                }
            } else {
                toastr()->error('Invalid Credentials!', 'Error');
                return redirect()->route('auth.login.form');
            }
        } catch(ThrottlingException $ex){
			dd($ex);
			return redirect()->route('auth.login.form');
		}
		catch(NotActivatedException $ex){
            dd($ex);
			return redirect()->route('auth.login.form');
		}
    }

    public function logout()
    {
        Sentinel::logout();
        toastr()->info('Successfully logged out.', 'Info');
        return redirect()->route('auth.login.form');
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

    public function activateAccount($code) 
    {
        DB::beginTransaction();
        try {
            $activation = Activation::where('code', $code)->first();
            if($activation){
                if($activation->completed == 0){
                    $userDb = Sentinel::findById($activation->user_id);

                    $activation->completed    = 1;
                    $activation->completed_at = date('Y-m-d H:i:s');
                    $activation->save();
                    
                    $userDb->token             = '';
                    $userDb->email_verified_at = date('Y-m-d H:i:s');
                    $userDb->save();
                } else {
                    // session()->flash('Your account has been activated');
                    toastr()->info('Your account has been activated.', 'Info');
                    return redirect()->route('auth.login.form');
                }
            } else {
                toastr()->error('Invalid Link!', 'Error');
                return redirect()->route('auth.login.form');
            }
            DB::commit();
            return redirect()->route('auth.login.form');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
