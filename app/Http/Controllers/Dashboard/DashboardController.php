<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
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

        $announcementDb = Announcement::orderBy('created_at', 'DESC')->first();

        if (isset($announcementDb)) {
            $announcement = $announcementDb;
        } else {
            $announcement = null;
        }

        if (!Sentinel::getUser()) {
            toastr()->error('Anda tidak bisa masuk!', 'Error');
            return redirect()->route('auth.login.form');
        } else {
            return view('backend.dashboard.dashboard', compact('count', 'announcement'));
        }
    }
}
