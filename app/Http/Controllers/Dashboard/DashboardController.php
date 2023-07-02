<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Sentinel::getUser()->company != null) {
            $companyEmployees = Sentinel::getUser()->company->company_employees;
            $count            = sizeof($companyEmployees);
            if ($count == 0) {
                $count = null;
            } else {
                $count = $count;
            }
        } else {
            $count = 0;
        }

        if (!Sentinel::getUser()) {
            toastr()->error('You are not authorized!', 'Error');
            return redirect()->route('auth.login.form');
        } else {
            return view('backend.dashboard.dashboard', compact('count'));
        }
    }
}
