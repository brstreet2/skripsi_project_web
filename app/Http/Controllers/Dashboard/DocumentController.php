<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentTemplate\documentTemplateRequest;
use App\Models\DocumentTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.document.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user       = Sentinel::getUser();
        DB::beginTransaction();
        $check  = DocumentTemplate::where('slug', Str::slug($request->document_name, '-'))->first();

        if ($check) {
            toastr()->error('Tolong cari nama lain.', 'Error');
            return back();
        }

        try {
            $documentTemplate                   = new DocumentTemplate();
            $documentTemplate->name             = $request->document_name;
            $documentTemplate->slug             = Str::slug($request->document_name, '-');
            $documentTemplate->description      = Purifier::clean($request->description);
            $documentTemplate->content          = $request->content;

            $timestamp = Carbon::now();
            $hash      = hash('md2', $timestamp);
            $pdf = Pdf::loadHTML($request->content)->setPaper('a4', 'portrait')->setWarnings(false);
            $filenamePath  = 'documents/' . $hash . '_' . $documentTemplate->slug . '.pdf';
            try {
                $s3     = Storage::disk('s3')->put($filenamePath, $pdf->output(), 'public');
                $url    = Storage::disk('s3')->url($filenamePath);
            } catch (\Exception $e) {
                report($e);
                toastr()->error('Terjadi kesalahan ...', 'Error');
                return back();
            }
            $documentTemplate->url              = $url;
            $documentTemplate->created_by       = $user->name;
            $documentTemplate->company_id       = $user->company->id;
            $documentTemplate->save();

            DB::commit();
            toastr()->success('Data berhasil disimpan!', 'Success');
            return redirect()->route('document.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Terjadi kesalahan ...', 'Error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('backend.document.show', ['documentDb' => DocumentTemplate::where('slug', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('backend.document.edit', ['documentDb' => DocumentTemplate::where('slug', $slug)->first()]);
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

    public function destroy($id)
    {
        $documentDb     = DocumentTemplate::find($id);

        DB::beginTransaction();
        try {
            if ($documentDb) {
                $trim = Str::after($documentDb->url, 'https://s3-id-jkt-1.kilatstorage.id/timkerjaku/');
                Storage::disk('s3')->delete($trim);
                $documentDb->deleted_at = Carbon::now();
                $documentDb->deleted_by = Sentinel::getUser()->name;
                $documentDb->url        = "";
                $documentDb->save();
                DB::commit();
                return response()->json([
                    'error'     => false,
                    'message'   => 'data has been deleted',
                    'data'      => [$documentDb],
                    'status'    => 200
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error'     => true,
                'message'   => $e->getMessage(),
                'data'      => null,
                'status'    => 500
            ], 500);
            DB::rollback();
            report($e);
        }
    }

    public function destroyBulk(Request $request)
    {
        $data = DocumentTemplate::whereIn('id', $request->id)->get();
        return response()->json([
            'success',
            'data' => $data
        ]);
    }

    public function datatables(Request $request)
    {
        $user = Sentinel::getUser();

        $dataDb = DocumentTemplate::where('company_id', $user->company->id);
        return DataTables::eloquent($dataDb)
            ->addColumn(
                'action',
                function ($dataDb) {
                    return '
                <a href="' . route('document.edit', $dataDb->slug) . '"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Dokumen" class="btn"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #6893df;"></i></a>
                <button class="btn" data-bs-toggle="tooltip" id="deleteButton" data-id="' . $dataDb->id . '" data-name="' . $dataDb->name . '" type="button" data-bs-placement="bottom" title="Delete ' . $dataDb->name . '?"><i class="fa-solid fa-trash fa-lg" style="color: #6893df;"></i></button>';
                    // <button class="btn"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #6893df;"></i></button>
                    // <button class="btn"><i class="fa-solid fa-eye fa-lg" style="color: #6893df;"></i></button>';
                    // return '<a href="' . route('banner.show', $dataDb->id) . '" id="tooltip" title="' . trans('global.show') . '"><span class="label label-primary label-sm"><i class="fa fa-arrows-alt"></i></span></a>
                    //     <a href="'.route('banner.edit', [$dataDb->id]).'" id="tooltip" title="'.trans('global.update').'"><span class="label label-warning label-sm"><i class="fa fa-edit"></i></span></a>
                    //     <a href="#" data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->title]).'" data-href="'.route('banner.destroy', [$dataDb->id]).'" id="tooltip" data-method="DELETE" data-title="'.trans('global.delete').'" data-toggle="modal" data-target="#delete"><span class="label label-danger label-sm"><i class="fa fa-trash-o"></i></span></a>';
                    // <a href="' . route('document.show', $dataDb->slug) . '"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat Dokumen" class="btn"><i class="fa-solid fa-eye fa-lg" style="color: #6893df;"></i></a>
                    // <a href="' . $dataDb->url . '" target="_blank" class="btn"><i class="fa-solid fa-download fa-lg" style="color: #6893df;"></i></a>
                }
            )
            ->addColumn(
                'checkbox',
                function ($dataDb) {
                    return $dataDb->id;
                }
            )
            ->rawColumns(array('action', 'checkbox', 'description'))
            ->make(true);
    }
}
