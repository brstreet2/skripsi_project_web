<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getProvinces(Request $request)
    {
        try {
            $perPage = 10;
            $page    = $request->page ?? 1;
            $term = $request->term;

            Paginator::currentPageResolver(
                function () use ($page) {
                    return $page;
                }
            );

            $count = Province::count();

            if ($count > $perPage) {
                $perPage = $count;
            }

            $dataDb = Province::select('id', 'name as text')->where('name', 'LIKE', '%' . $request->term . '%')->paginate($perPage);

            return $dataDb;
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }

    public function getRegencies(Request $request)
    {
        try {
            $dataDb = Regency::where('province_id', $request->province_id)->get();

            return response()->json($dataDb);
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return $exception->getCode();
        }
    }
}
