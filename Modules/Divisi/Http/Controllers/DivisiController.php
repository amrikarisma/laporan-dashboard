<?php

namespace Modules\Divisi\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $divisis = MyHelper::apiGet('divisi')['data'] ?? [];
        
        return view('divisi::index', compact('divisis'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $divisi_parent = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];

        return view('divisi::create', compact('divisi_parent'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'parent_id' => ['nullable'],
            'order' => ['nullable'],
            'status' => ['required'],
        ],[
            'required' => 'Nama wajib diisi.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status' => $request->status,
        ];
        $divisi = MyHelper::apiPost('divisi', $input);
        if(isset($divisi['status']) ) {
            if($divisi['status'] == 'success') {
                return redirect()->route('divisi.index')->with('message', $divisi['message']);
            } elseif($divisi['status'] == 'failed'){
                return redirect()->route('divisi.index')->with('error', $divisi['message']);
            }
        }
        return redirect()->back()->withErrors($divisi['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $divisi = MyHelper::apiGet('divisi/' . $id)['data'] ?? [];

        return view('divisi::show', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $divisi_parent = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];

        $divisi = MyHelper::apiGet('divisi/' . $id)['data'] ?? [];

        if (!$divisi) {
            return redirect()->route('divisi.index');
        }
        
        return view('divisi::edit', compact('divisi','divisi_parent'));
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
            'name' => ['required'],
            'parent_id' => ['nullable'],
            'order' => ['nullable'],
            'status' => ['required'],
        ],[
            'required' => 'Nama wajib diisi.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'order' => $request->order,
            'status' => $request->status,
        ];
        $divisi = MyHelper::apiPost('divisi/'.$id.'?_method=put', $input);

        if(isset($divisi['status']) ) {
            if($divisi['status'] == 'success') {
                return redirect()->route('divisi.index')->with('message', $divisi['message']);
            } elseif($divisi['status'] == 'failed'){
                return redirect()->route('divisi.index')->with('error', $divisi['message']);
            }
        }
        return redirect()->back()->withErrors($divisi['error'])->withInput();
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
