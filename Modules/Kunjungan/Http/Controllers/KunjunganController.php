<?php

namespace Modules\Kunjungan\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filterDate     = ($request->start && $request->end) ? 'start='.$request->start.'&end='.$request->end.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';

        // $absents = MyHelper::apiGet('presensi-report?'.$filterDate.$filterJabatan.$filterAnggota)??[];

        $kunjungans = MyHelper::apiGet('laporan?'.$filterDate.$filterJabatan.$filterAnggota)??[];
        // return $kunjungans;
        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        return view('kunjungan::index', compact('kunjungans', 'anggota', 'jabatan', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kunjungan::create');
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
        $kunjungan = MyHelper::apiGet('laporan/'.$id)['data']??[];

        if(!$kunjungan) {
            return redirect(route('kunjungan.index'));
        }

        return view('kunjungan::show', compact('kunjungan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('kunjungan::edit');
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
