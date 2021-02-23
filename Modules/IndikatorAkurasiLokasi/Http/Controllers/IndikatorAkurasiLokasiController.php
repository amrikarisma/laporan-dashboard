<?php

namespace Modules\IndikatorAkurasiLokasi\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class IndikatorAkurasiLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $akurasilokasis = MyHelper::apiGet('indikatorakurasilokasi')['data'] ?? [];
        return view('indikatorakurasilokasi::index', compact('akurasilokasis'));
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
        return view('indikatorakurasilokasi::create', compact('list_logic'));
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

        $akurasilokasi = MyHelper::apiPost('indikatorakurasilokasi', $input);
        if(isset($akurasilokasi['status']) && $akurasilokasi['status'] == 'success'){
            return redirect()->route('akurasilokasi.index')->with('message', $akurasilokasi['message']);
        }

        return redirect()->back()->withErrors($akurasilokasi['error'])->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('indikatorakurasilokasi::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $akurasilokasi  = MyHelper::apiGet('indikatorakurasilokasi/'.$id)['data'] ?? [];

        $list_logic = [
            '<'     => 'Kurang Dari',
            '>'     => 'Lebih Dari',
            '='     => 'Sama Dengan',
            '<='    => 'Kurang Dari Sama Dengan',
            '>='    => 'Lebih Dari Sama Dengan',
        ];

        return view('indikatorakurasilokasi::edit', compact('list_logic', 'akurasilokasi'));
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

        $akurasilokasi = MyHelper::apiRequest('PUT','indikatorakurasilokasi/'.$id, $input);
        if(isset($akurasilokasi['status']) && $akurasilokasi['status'] == 'success'){
            return redirect()->route('akurasilokasi.index')->with('message', $akurasilokasi['message']);
        }

        return redirect()->back()->withErrors($akurasilokasi['error'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $akurasilokasi = MyHelper::apiRequest('DELETE','indikatorakurasilokasi/'.$id);
        if(isset($akurasilokasi['status']) && $akurasilokasi['status'] == 'success'){
            return redirect()->route('akurasilokasi.index')->with('message', $akurasilokasi['message']);
        }

        return redirect()->back()->withErrors($akurasilokasi['error'])->withInput();
    }
}
