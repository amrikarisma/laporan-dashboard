<?php

namespace Modules\Jabatan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function ajaxlist()
    {
        $jabatans = MyHelper::apiGet('jabatan')['data'] ?? [];
        return DataTables::of($jabatans)
        ->addColumn('actions', "jabatan::index.action") 
        ->rawColumns(['actions'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        return view('jabatan::index');
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
        $validator = Validator::make($request->all(), [
            'name' => ['required','string'],
            'time_in' => ['date_format:H:i:s'],
            'time_out' => ['date_format:H:i:s'],
            'work_time' => ['nullable','date_format:H:i:s'],
            'daily_report' => ['required','max:3'],
            'daily_visit_report' => ['required','max:3'],
            'absent_without_note' => ['required','max:3'],
            'absent_with_note' => ['required','max:3'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
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
        $jabatan_parent = MyHelper::apiGet('jabatan?pluck=1&notme='.$id)['data'] ?? [];

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
        $validator = Validator::make($request->all(), [
            'name' => ['required','string'],
            'time_in' => ['date_format:H:i:s'],
            'time_out' => ['date_format:H:i:s'],
            'work_time' => ['nullable','date_format:H:i:s'],
            'daily_report' => ['required','max:3'],
            'daily_visit_report' => ['required','max:3'],
            'absent_without_note' => ['required','max:3'],
            'absent_with_note' => ['required','max:3'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

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
