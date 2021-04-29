<?php

namespace Modules\Cabang\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
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
    public function index(Request $request)
    {

        $param = [
            'filter_cabang' => $request->cabang
        ];
        $cabangs = MyHelper::apiRequest('get', 'cabang', $param)['data']??[];
        
        $cabang = MyHelper::apiRequest('get','cabang?pluck=1')['data'] ?? [];

        return view('cabang::index', compact('cabangs','cabang', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $avail = [
            'current' => '',
        ];

        $anggotas = MyHelper::apiRequest('post', 'cabang/anggota-available/', $avail)['data']??[];
        $parent = MyHelper::apiRequest('get', 'cabang?pluck=1')['data']??[];
        $branch = MyHelper::apiRequest('get', 'cabang/branch?pluck=1')['data']??[];

        return view('cabang::create', compact('parent','branch','anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch' => ['required'],
            'name' => ['required'],
            'parent_id' => ['nullable'],
            'cabang_photo'      => ['nullable', 'image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        if ($request->hasFile('cabang_photo') && $request->file('cabang_photo')->isValid()) {
            $input['cabang_photo'] = $request->cabang_photo;
        }

        $input = [
            'branch_id' => $request->branch,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'anggota_id' => $request->anggota_id,
            'phone_number' => $request->phone_number,
        ];

        $cabang = MyHelper::apiPostWithFile('cabang', $input, $request);
        if(isset($cabang['status']) && $cabang['status'] == 'success'){
            return redirect()->route('cabang.index')->with('message', $cabang['message']);
        }

        return redirect()->back()->withErrors($cabang['error'])->withInput();
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

        return view('cabang::show', compact('cabang'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $parent = MyHelper::apiRequest('get', 'cabang?pluck=1')['data']??[];

        $cabang = MyHelper::apiRequest('get', 'cabang/'.$id)['data']??[];

        $branch = MyHelper::apiRequest('get', 'cabang/branch?pluck=1')['data']??[];
        
        $avail = [
            'current' => isset($cabang['anggota']['id']) ? $cabang['anggota']['id'] : '',
            'cabang'  => $id
        ];

        $anggotas = MyHelper::apiRequest('post', 'cabang/anggota-available/', $avail)['data']??[];

        return view('cabang::edit', compact('cabang','branch', 'parent','anggotas'));
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
            'branch' => ['required'],
            'name' => ['required'],
            'parent_id' => ['nullable'],
            'anggota_id' => ['nullable'],
            'cabang_photo'      => ['nullable', 'image','mimes:jpg,png,jpeg,gif,svg','max:2048'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'branch_id' => $request->branch,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'anggota_id' => $request->anggota_id,
            'phone_number' => $request->phone_number,
            'cabang_photo' => $request->cabang_photo,
        ];
        $cabang = MyHelper::apiPostWithFile('cabang/'.$id.'./update', $input, $request);

        if(isset($cabang['status']) && $cabang['status'] == 'success'){
            return redirect()->route('cabang.index')->with('message', $cabang['message']);
        }
        return redirect()->back()->withErrors($cabang['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $cabang = MyHelper::apiRequest('delete', 'cabang/' . $id) ?? [];

        if($cabang['status'] == 'failed') {
            return redirect()->route('cabang.index')->with('error', $cabang['message']);
        }
        return redirect()->route('cabang.index')->with('message', $cabang['message']);
    }
}
