<?php

namespace Modules\IndikatorBobotKegiatan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class IndikatorBobotKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $bobotkegiatans = MyHelper::apiGet('indikatorkegiatan')['data'] ?? [];
        return view('indikatorbobotkegiatan::index', compact('bobotkegiatans'));
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

        return view('indikatorbobotkegiatan::create', compact('list_logic'));
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
            'param' => ['required','integer'],
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

        $bobotkegiatan = MyHelper::apiPost('indikatorkegiatan', $input);
        if(isset($bobotkegiatan['status']) && $bobotkegiatan['status'] == 'success'){
            return redirect()->route('bobotkegiatan.index')->with('message', $bobotkegiatan['message']);
        }

        return redirect()->back()->withErrors($bobotkegiatan['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('indikatorbobotkegiatan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $bobotkegiatan  = MyHelper::apiGet('indikatorkegiatan/'.$id)['data'] ?? [];

        $list_logic = [
            '<'     => 'Kurang Dari',
            '>'     => 'Lebih Dari',
            '='     => 'Sama Dengan',
            '<='    => 'Kurang Dari Sama Dengan',
            '>='    => 'Lebih Dari Sama Dengan',
        ];

        return view('indikatorbobotkegiatan::edit', compact('list_logic', 'bobotkegiatan'));
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
            'param' => ['required','integer'],
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

        $bobotkegiatan = MyHelper::apiRequest('PUT','indikatorkegiatan/'.$id, $input);
        if(isset($bobotkegiatan['status']) && $bobotkegiatan['status'] == 'success'){
            return redirect()->route('bobotkegiatan.index')->with('message', $bobotkegiatan['message']);
        }

        return redirect()->back()->withErrors($bobotkegiatan['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $bobotkegiatan = MyHelper::apiRequest('DELETE','indikatorkegiatan/'.$id);
        if(isset($bobotkegiatan['status']) && $bobotkegiatan['status'] == 'success'){
            return redirect()->route('bobotkegiatan.index')->with('message', $bobotkegiatan['message']);
        }

        return redirect()->back()->withErrors($bobotkegiatan['error'])->withInput();
    }
}
