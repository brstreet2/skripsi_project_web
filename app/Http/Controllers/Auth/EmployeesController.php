<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\CompanyEmployees;
use App\Traits\Users\AttachRoleTrait;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    use AttachRoleTrait;

    public function index()
    {
        // dd(count(Sentinel::getUser()->company->company_employees));
        return view('backend.employees.index');
    }

    public function store(Request $request)
    {
        $senUser = Sentinel::getUser();

        $request->validate([
            'name'      => 'required|regex:/^(?:[^"\'\<>\ㅤ\⠀])+$/i',
            'email'     => 'required|email|regex:/^(?:[^"\'\<>\ㅤ\⠀+])+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i',
            'password'  => 'required|min:8',
            'phone'     => 'required',
            'job_title' => 'required'
        ]);

        $check      = count($senUser->company->company_employees);

        if ($senUser->user_type == 1) {
            $user_type = 'free';
            $limit     = 4;
        }

        if ($senUser->user_type == 2) {
            $user_type = 'premium';
            $limit     = 25;
        }

        if ($senUser->user_type == 3) {
            $user_type = 'pro';
            $limit     = 100;
        }

        if ($check >= $limit) {
            toastr()->error('Limit karyawan telah tercapai!', 'Error');
            return back();
        }

        $find = User::where("email", $request->email)->first();
        if ($find) {
            toastr()->error('Email telah terdaftar!', 'Error');
            return back();
        } else {
            $upperCaseName = ucwords($request->name);

            DB::beginTransaction();
            try {
                $data = [
                    'name'      => $upperCaseName,
                    'email'     => $request->email,
                    'password'  => $request->password,
                    'phone'     => $request->phone,
                    'user_type' => 0
                ];

                $user   = Sentinel::registerAndActivate($data);

                $userEmployeeDb                 = new CompanyEmployees();
                $userEmployeeDb->user_id        = $user->id;
                $userEmployeeDb->company_id     = $senUser->company->id;
                $userEmployeeDb->job_title      = $request->job_title;
                $userEmployeeDb->created_at     = Carbon::now()->format('Y-m-d H:i:s');
                $userEmployeeDb->save();

                $userDb      = User::find($user->id);
                $this->attach($userDb, 'Employee');

                $user->save();

                toastr()->success('Karyawan berhasil ditambahkan.', 'Success');
                DB::commit();
                return back();
            } catch (\Exception $e) {
                Log::error("----------------------------------------------------");
                Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
                Log::error("Error Exception Code: " . $e->getCode());
                Log::error("Error at controller: EmployeesController");
                Log::error("Error at function / method: store");
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
        return view('backend.employees.edit', [
            'employee'          => User::find($id),
            'employeeDetail'    => CompanyEmployees::where('user_id', $id)->first()
        ]);
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

        $user = Sentinel::findById($id);

        DB::beginTransaction();
        try {
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->phone    = $request->phone;
            $user->save();
            if ($request->has('job_title')) {
                $employeeDetailDb               = CompanyEmployees::where('user_id', '=', $id)->first();
                $employeeDetailDb->job_title    = $request->job_title;
                $employeeDetailDb->save();
            }
            DB::commit();
            toastr()->success('Data karyawan berhasil disimpan!', 'Success');
            return back();
        } catch (\Exception $e) {
            Log::error("----------------------------------------------------");
            Log::error("Error Log Date: " . Carbon::now()->format('Y-m-d H:i:s'));
            Log::error("Error Exception Code: " . $e->getCode());
            Log::error("Error at controller: EmployeesController");
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

    public function datatables(Request $request)
    {
        $user = Sentinel::getUser();

        $dataDb = CompanyEmployees::where('company_id', $user->company->id)->get();

        return DataTables::of($dataDb)
            ->addColumn('user_name', function ($dataDb) {
                $user = Sentinel::findById($dataDb->user_id);
                return '<a href="' . route('employee.edit', $dataDb->user_id) . '">' . $user->name . '</a=>';
            })
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->addColumn(
                'action',
                function ($dataDb) {
                    return '<a href="' . route('employee.edit', $dataDb->user_id) . '"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Karyawan" class="btn"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #6893df;"></i></a>
                    <button class="btn" data-bs-toggle="tooltip" id="deleteButton" data-id="' . $dataDb->id . '" data-name="' . $dataDb->name . '" type="button" data-bs-placement="bottom" title="Delete ' . $dataDb->name . '?"><i class="fa-solid fa-trash fa-lg" style="color: #6893df;"></i></button>';
                }
            )
            ->rawColumns(array('checkbox', 'description', 'user_name', 'action'))
            ->make(true);
    }
}
