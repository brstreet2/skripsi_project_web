<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }

    public function edit()
    {
        return view('backend.profile.edit');
    }

    public function security()
    {
        return view('backend.profile.security');
    }

    public function securityForm()
    {
        return view('backend.profile.changepassword');
    }

    public function postSecurity(Request $request)
    {
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name'                      => 'required|regex:/^(?:[^"\'\<>\ㅤ\⠀])+$/i',
                'email'                     => 'required|email',
                'phone'                     => 'required'
            ],
            [
                'name.required'             => 'Mohon isi nama anda.',
                'name.regex'                => 'Format nama belum sesuai!',
                'email.email'               => 'Input harus berupa email!',
                'phone.required'            => 'Mohon isi nomor telepon anda.',
                'email.required'            => 'Mohon isi email anda.',
            ]
        );

        $user = Sentinel::getUser();

        DB::beginTransaction();
        try {

            if ($request->hasFile('file_avatar')) {
                $timestamp = Carbon::now();
                $hash      = hash('md2', $timestamp);
                $extension = $request->file_avatar->getClientOriginalExtension();
                $filenamePath  = 'users/' . $hash . '_' . $user->id;
                try {
                    $s3     = Storage::disk('s3')->put($filenamePath, $request->file_avatar, 'public');
                    $url    = Storage::disk('s3')->url($s3);
                    $user->name     = $request->name;
                    $user->email    = $request->email;
                    $user->phone    = $request->phone;
                    $user->avatar   = $url;
                    $user->save();
                } catch (\Exception $e) {
                    toastr()->error('Terjadi kesalahan ...', 'Error');
                    return back();
                }
            } else {
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->phone    = $request->phone;
                $user->save();
            }

            DB::commit();
            toastr()->success('Profil berhasil disimpan!', 'Success');
            return back();
        } catch (\Exception $e) {
            Log::error("----------------------------------------------------");
            Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
            Log::error("Error Exception Code: " . $e->getCode());
            Log::error("Error at controller: ProfileController");
            Log::error("Error at function / method: update");
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
