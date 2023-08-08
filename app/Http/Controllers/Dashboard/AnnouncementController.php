<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mews\Purifier\Facades\Purifier;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'date'      => 'required|date',
            'content'   => 'required'
        ]);

        DB::beginTransaction();
        try {
            $announcementDb                   = new Announcement();
            $announcementDb->name             = $request->name;
            $announcementDb->date             = $request->date;
            $announcementDb->content          = $request->content;
            $announcementDb->company_id       = Sentinel::getUser()->company->id;
            $announcementDb->save();

            DB::commit();
            toastr()->success('Data berhasil disimpan!', 'Success');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Announcement Controller: function store");
            Log::error("Message: " . $e->getMessage());
            Log::error("Data: " . $e);
            toastr()->error('Terjadi kesalahan ...', 'Error');
            return back();
        }
    }
}
