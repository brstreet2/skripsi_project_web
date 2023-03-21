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
use Mews\Purifier\Facades\Purifier;
use Yajra\DataTables\Facades\DataTables;

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
        $user       = 'AZKA';
        $base_url   = 'http://skripsi_project_web.test/';

        DB::beginTransaction();
        try {
            $documentTemplate                   = new DocumentTemplate();
            $documentTemplate->document_name    = $request->document_name;
            $documentTemplate->description      = Purifier::clean($request->description);
            $documentTemplate->content          = $request->content;
            
            $timestamp = Carbon::now();
            $hash      = hash('md2', $timestamp);
            $pdf = Pdf::loadHTML($request->content)->setPaper('a4', 'portrait')->setWarnings(false)->save($hash.'.pdf');
            
            $documentTemplate->document_url     = $base_url.$hash.'.pdf';
            $documentTemplate->created_by       = 'AZKA';
            $documentTemplate->save();

            DB::commit();
            return redirect()->route('document.index');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
        }
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

    public function datatables(Request $request)
    {
        $select = [
            'document_template.*'
        ];

        $dataDb = DocumentTemplate::select($select);

        return DataTables::eloquent($dataDb)
        ->addColumn(
            'action',
            function ($dataDb) {
                return '
                <button class="btn"><i class="fa-solid fa-download fa-lg text-color-primary"></i></button>
                <button class="btn"><i class="fa-solid fa-pen-to-square fa-lg" style="color:rgb(231, 220, 19)"></i></button>
                <button class="btn"><i class="fa-solid fa-trash fa-lg" style="color: #fa0000;"></i></button>';
                // return '<a href="' . route('banner.show', $dataDb->id) . '" id="tooltip" title="' . trans('global.show') . '"><span class="label label-primary label-sm"><i class="fa fa-arrows-alt"></i></span></a>
                //     <a href="'.route('banner.edit', [$dataDb->id]).'" id="tooltip" title="'.trans('global.update').'"><span class="label label-warning label-sm"><i class="fa fa-edit"></i></span></a>
                //     <a href="#" data-message="'.trans('auth.delete_confirmation', ['name' => $dataDb->title]).'" data-href="'.route('banner.destroy', [$dataDb->id]).'" id="tooltip" data-method="DELETE" data-title="'.trans('global.delete').'" data-toggle="modal" data-target="#delete"><span class="label label-danger label-sm"><i class="fa fa-trash-o"></i></span></a>';
            }
        )
        ->addColumn(
            'checkbox',
            function ($dataDb) {
                return $dataDb->id;
            }
        )
        ->rawColumns(array('action','checkbox', 'description'))
        ->make(true);
    }
}
