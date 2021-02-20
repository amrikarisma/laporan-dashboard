<?php

namespace Modules\Cabang\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class CabangController extends Controller
{
    public function getCabang(Request $request)
    {
        $cabangs = MyHelper::apiRequest('get', 'cabang')['data']??[];

        $data = new Collection($cabangs);
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', 'cabang::datatables-action' )
        ->rawColumns(['action'])
        ->filter(function(){}) // disable built-in search function
        ->make(true);
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $cabangs = MyHelper::apiRequest('get', 'cabang')['data']??[];


        return view('cabang::index', compact('cabangs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $getAnggotas = MyHelper::apiRequest('get', 'anggota')['data']??[];
        $anggotas = [];
        foreach ($getAnggotas as $anggota) {
            $anggotas[$anggota['id']] = $anggota['user']['name'];
        }

        $cabangs = MyHelper::apiRequest('get', 'cabang')['data']??[];
        $parent = [];
        foreach ($cabangs as $cabang) {
            $parent[$cabang['id']] = $cabang['name'];
        }


        return view('cabang::create', compact('parent','anggotas'));
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
        $cabang = MyHelper::apiRequest('get', 'cabang/'.$id)['data']??[];
        // return $cabang;
        return view('cabang::show', compact('cabang'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $getAnggotas = MyHelper::apiRequest('get', 'anggota')['data']??[];
        $anggotas = [];
        foreach ($getAnggotas as $anggota) {
            if($anggota['id'] != $anggotaid) {
                $anggotas[$anggota['id']] = $anggota['user']['name'];
            }
        }

        $cabangs = MyHelper::apiRequest('get', 'cabang')['data']??[];
        $parent = [];
        
        foreach ($cabangs as $cabang) {
            if($cabang['id'] != $id) {
                $parent[$cabang['id']] = $cabang['name'];
            }
        }
        $cabang = MyHelper::apiRequest('get', 'cabang/'.$id)['data']??[];

        return view('cabang::edit', compact('cabang', 'parent','anggotas'));
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
