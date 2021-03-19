<?php

namespace Modules\Presensi\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class PresensiController extends Controller
{
    public function ajaxlist()
    {
        $absents = MyHelper::apiGet('presensi')['data'] ?? [];
        return DataTables::of($absents)
        ->editColumn('date', "presensi::index.date") 
        ->editColumn('geolocation_in', "presensi::index.geolocation_in") 
        ->editColumn('geolocation_out', "presensi::index.geolocation_out") 
        ->editColumn('category.name', "presensi::index.category") 
        ->editColumn('note', "presensi::index.note") 
        ->addColumn('actions', "presensi::index.action") 
        ->rawColumns(['actions','date','geolocation_in','geolocation_out','category.name','note'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('presensi::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('presensi::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $absent = MyHelper::apiGet('presensi/'.$id)['data'][0]??[];
        // return $absent;
        return view('presensi::show', compact('absent'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('presensi::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
