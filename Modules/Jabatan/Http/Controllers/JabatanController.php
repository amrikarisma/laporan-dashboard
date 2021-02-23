<?php

namespace Modules\Jabatan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jabatans = MyHelper::apiGet('jabatan')['data'] ?? [];
        
        return view('jabatan::index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $jabatan_parent = MyHelper::apiGet('jabatan?pluck=1')['data'] ?? [];
        // return $jabatan_parent;
        return view('jabatan::create', compact('jabatan_parent'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $form = $request->except(['_token']);
        $jabatan = MyHelper::apiRequest('post', 'jabatan', $form) ?? [];
        // return $jabatan;
        if (isset($jabatan['error'])) {
            return redirect()->back()->withErrors($jabatan['error'])->withInput();
        }
        // return redirect()->route('jabatan.show',$jabatan['data']['id'])->with('message', $jabatan['message']);        //
        return redirect()->route('jabatan.index')->with('message', $jabatan['message']);        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $jabatan = MyHelper::apiGet('jabatan/' . $id)['data'] ?? [];
        if (!$jabatan) {
            return redirect()->route('jabatan.index');
        }

        return view('jabatan::show', compact('jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $jabatan_parent = MyHelper::apiGet('jabatan?pluck=1')['data'] ?? [];

        $jabatan = MyHelper::apiGet('jabatan/' . $id)['data'] ?? [];

        if (!$jabatan) {
            return redirect()->route('jabatan.index');
        }
        
        return view('jabatan::edit', compact('jabatan','jabatan_parent'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $form = $request->except(['_token']);
        $jabatan = MyHelper::apiRequest('put', 'jabatan/' . $id, $form) ?? [];

        if (isset($jabatan['error'])) {
            return redirect()->back()->with('error', $jabatan['error']);
        }
        
        return redirect()->route('jabatan.show', $id)->with('message', $jabatan['message']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jabatan = MyHelper::apiRequest('delete', 'jabatan/' . $id) ?? [];
        return redirect()->route('jabatan.index')->with('message', $jabatan['message']);
    }
}
