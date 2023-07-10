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

    public function datatables(Request $request)
    {
        $user = Sentinel::getUser();

        $dataDb = CompanyEmployees::where('company_id', $user->company->id)->get();

        return DataTables::of($dataDb)
            ->addColumn('user_name', function ($dataDb) {
                $user = Sentinel::findById($dataDb->user_id);
                return '<a href="' . route('employee.index') . '">' . $user->name . '</a=>';
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
