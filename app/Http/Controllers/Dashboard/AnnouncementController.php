<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mews\Purifier\Facades\Purifier;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name'      => 'required',
            'date'      => 'required|date',
            'content'   => 'required'
        ]);

        try {
            $announcementDb                   = new Announcement();
            $announcementDb->name             = $request->name;
            $announcementDb->date             = $request->date;
            $announcementDb->content          = strip_tags($request->content);
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
