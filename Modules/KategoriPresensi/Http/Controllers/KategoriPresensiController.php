<?php

namespace Modules\KategoriPresensi\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriPresensiController extends Controller
{
    public function ajaxlist()
    {
        $kategoripresensi = MyHelper::apiGet('kategori-presensi')['data'] ?? [];
        return DataTables::of($kategoripresensi)
        ->addColumn('actions', "kategoripresensi::index.action") 
        ->rawColumns(['actions'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('kategoripresensi::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kategoripresensi::create');
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
            'group'   => $request->group,
            'status'   => $request->status,
        ];

        $kategoripresensi = MyHelper::apiPost('kategori-presensi', $input);
        if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'success'){
            return redirect()->route('kategori-presensi.index')->with('message', $kategoripresensi['message']);
        } else if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'failed') {
            return redirect()->back()->with('error', $kategoripresensi['message']);
        }

        return redirect()->back()->withErrors($kategoripresensi['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $kategoripresensi = MyHelper::apiGet('kategori-presensi/'.$id)??[];
        if($kategoripresensi['status'] == 'failed') {
            return redirect()->route('kategori-presensi.index')->with('error', 'Data tidak ditemukan');
        }
        $kategori = $kategoripresensi['data']??[];
        return view('kategoripresensi::show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $kategoripresensi = MyHelper::apiGet('kategori-presensi/'.$id)??[];
        if($kategoripresensi['status'] == 'failed') {
            return redirect()->route('kategori-presensi.index')->with('error', 'Data tidak ditemukan');
        }
        $kategori = $kategoripresensi['data']??[];
        return view('kategoripresensi::edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
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
            'group'   => $request->group,
            'status'   => $request->status,
        ];

        $kategoripresensi = MyHelper::apiRequest('PUT', 'kategori-presensi/'.$id, $input);
        if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'success'){
            return redirect()->route('kategori-presensi.index')->with('message', $kategoripresensi['message']);
        } else if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'failed') {
            return redirect()->back()->with('error', $kategoripresensi['message']);
        }

        return redirect()->back()->withErrors($kategoripresensi['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $kategoripresensi = MyHelper::apiRequest('DELETE', 'kategori-presensi/'.$id);
        if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'success'){
            return redirect()->route('kategori-presensi.index')->with('message', $kategoripresensi['message']);
        } else if(isset($kategoripresensi['status']) && $kategoripresensi['status'] == 'failed') {
            return redirect()->route('kategori-presensi.index')->with('error', $kategoripresensi['message']);
        }

        return redirect()->back()->withErrors($kategoripresensi['error'])->withInput();
    }
}
