<?php

namespace Modules\KategoriLaporan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriLaporanController extends Controller
{
    public function ajaxlist()
    {
        $kategorilaporan = MyHelper::apiGet('kategorilaporan')['data'] ?? [];
        return DataTables::of($kategorilaporan)
        ->addColumn('actions', "kategorilaporan::index.action") 
        ->rawColumns(['actions'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('kategorilaporan::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kategorilaporan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'name'         => $request->name,
            'description'   => $request->description,
        ];

        $kategorilaporan = MyHelper::apiPost('kategorilaporan', $input);
        if(isset($kategorilaporan['status']) && $kategorilaporan['status'] == 'success'){
            return redirect()->route('kategorilaporan.index')->with('message', $kategorilaporan['message']);
        }

        return redirect()->back()->withErrors($kategorilaporan['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('kategorilaporan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('kategorilaporan::edit');
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
