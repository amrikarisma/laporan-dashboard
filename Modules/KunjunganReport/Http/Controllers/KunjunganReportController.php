<?php

namespace Modules\KunjunganReport\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class KunjunganReportController extends Controller
{
    public function ajaxlist(Request $request)
    {
        $filterDate     = (!empty($request->start_date) && !empty($request->end_date)) ? 'start='.$request->start_date.'&end='.$request->end_date.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';

        $kunjungans = MyHelper::apiGet('laporan?nopage=1&'.$filterDate.$filterJabatan.$filterAnggota)['data']??[];
        return DataTables::of($kunjungans)
        ->editColumn('user.name', "kunjunganreport::index.name") 
        ->editColumn('category.name', "kunjunganreport::index.category") 
        ->editColumn('laporan_geolocation', "kunjunganreport::index.geolocation") 
        ->editColumn('created_at', "kunjunganreport::index.date") 
        ->editColumn('laporan_description', "kunjunganreport::index.laporan_description") 
        ->editColumn('laporan_performance.persentase', "kunjunganreport::index.performance") 
        ->addColumn('actions', "kunjunganreport::index.action") 
        ->rawColumns(['actions','user.name','laporan_description','created_at','laporan_geolocation','laporan_performance.persentase'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // return $request;
        $filterDate     = ($request->start && $request->end) ? 'start='.$request->start.'&end='.$request->end.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';

        $kunjungans = MyHelper::apiGet('laporan?'.$filterDate.$filterJabatan.$filterAnggota)??[];

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        return view('kunjunganreport::index', compact('kunjungans', 'anggota', 'jabatan', 'request'));
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
            return redirect(route('laporan.kunjungan.index'));
        }

        return view('kunjunganreport::show', compact('kunjungan'));
    }
}
