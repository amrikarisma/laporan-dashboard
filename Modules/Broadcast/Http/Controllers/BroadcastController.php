<?php

namespace Modules\Broadcast\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BroadcastController extends Controller
{
    public function ajaxlist()
    {
        $broadcasts = MyHelper::apiGet('broadcast')['data'] ?? [];
        return DataTables::of($broadcasts)
        ->editColumn('created_at', "broadcast::index.date") 
        ->editColumn('status', "broadcast::index.status") 
        ->addColumn('actions', "broadcast::index.action") 
        ->rawColumns(['actions','status', 'created_at'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('broadcast::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $targetSend = MyHelper::apiRequest('get', 'cabang?pluck=1')['data']??[];

        return view('broadcast::create',compact('targetSend'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => ['required'],
            'description'   => ['required'],
            'image' => ['nullable','image:jpeg,png,jpg','max:2048'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // dd($request);

        $input = [
            'user'          => session('id_user'),
            'title'         => $request->title,
            'description'   => $request->description,
            'image'         => $request->image,
            'target_send'   => $request->target_send
        ];

        $broadcast = MyHelper::apiPostWithFile('broadcast', $input, $request);
        return $broadcast;
        if(isset($broadcast['status']) && $broadcast['status'] == 'success'){
            return redirect()->route('broadcast.index')->with('message', $broadcast['message']);
        }

        return redirect()->back()->withErrors($broadcast['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $broadcast = MyHelper::apiGet('broadcast/'.$id)['data']??[];
        if(!$broadcast) {
            return redirect(route('broadcast.index'))->with('error', 'Pengumuman tidak ditemukan');
        }

        return view('broadcast::show', compact('broadcast'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('broadcast::edit');
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
        $broadcast = MyHelper::apiRequest('DELETE','broadcast/'.$id);
        if(isset($broadcast['status']) && $broadcast['status'] == 'success'){
            return redirect()->route('broadcast.index')->with('message', $broadcast['message']);
        }

        return redirect()->back()->withErrors($broadcast['error'])->withInput();
    }
}
