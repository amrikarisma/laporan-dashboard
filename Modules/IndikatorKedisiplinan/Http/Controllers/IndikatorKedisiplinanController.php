<?php

namespace Modules\IndikatorKedisiplinan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Indikator\Http\Controllers\IndikatorController;

class IndikatorKedisiplinanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $kedisiplinans = MyHelper::apiGet('indikatorkedisiplinan')['data'] ?? [];
        return view('indikatorkedisiplinan::index', compact('kedisiplinans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $list_logic = [
            '<'     => 'Kurang Dari',
            '>'     => 'Lebih Dari',
            '='     => 'Sama Dengan',
            '<='    => 'Kurang Dari Sama Dengan',
            '>='    => 'Lebih Dari Sama Dengan',
        ];

        return view('indikatorkedisiplinan::create', compact('list_logic'));
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
            'param' => ['required'],
            'logic' => ['required'],
            'score' => ['required'],
            'note' => ['nullable'],
            'status' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'name'      => $request->name,
            'logic'     => $request->logic,
            'param'     => $request->param,
            'score'     => $request->score,
            'note'      => $request->note,
            'status'    => $request->status
        ];

        $kedisiplinan = MyHelper::apiPost('indikatorkedisiplinan', $input);
        if(isset($kedisiplinan['status']) && $kedisiplinan['status'] == 'success'){
            return redirect()->route('kedisiplinan.index')->with('message', $kedisiplinan['message']);
        }

        return redirect()->back()->withErrors($kedisiplinan['error'])->withInput();

        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('indikatorkedisiplinan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $kedisiplinan  = MyHelper::apiGet('indikatorkedisiplinan/'.$id)['data'] ?? [];

        $list_logic = [
            '<'     => 'Kurang Dari',
            '>'     => 'Lebih Dari',
            '='     => 'Sama Dengan',
            '<='    => 'Kurang Dari Sama Dengan',
            '>='    => 'Lebih Dari Sama Dengan',
        ];

        return view('indikatorkedisiplinan::edit', compact('list_logic', 'kedisiplinan'));
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
            'param' => ['required'],
            'logic' => ['required'],
            'score' => ['required'],
            'note' => ['nullable'],
            'status' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = [
            'name'      => $request->name,
            'logic'     => $request->logic,
            'param'     => $request->param,
            'score'     => $request->score,
            'note'      => $request->note,
            'status'    => $request->status
        ];

        $kedisiplinan = MyHelper::apiRequest('PUT','indikatorkedisiplinan/'.$id, $input);

        if(isset($kedisiplinan['status']) && $kedisiplinan['status'] == 'success'){
            return redirect()->route('kedisiplinan.index')->with('message', $kedisiplinan['message']);
        }

        return redirect()->back()->withErrors($kedisiplinan['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $kedisiplinan = MyHelper::apiRequest('DELETE','indikatorkedisiplinan/'.$id);
        if(isset($kedisiplinan['status']) && $kedisiplinan['status'] == 'success'){
            return redirect()->route('kedisiplinan.index')->with('message', $kedisiplinan['message']);
        }

        return redirect()->back()->withErrors($kedisiplinan['error'])->withInput();
    }
}
