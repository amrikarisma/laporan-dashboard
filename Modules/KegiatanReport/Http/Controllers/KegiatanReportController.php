<?php

namespace Modules\KegiatanReport\Http\Controllers;

use App\Exports\LaporanExport;
use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class KegiatanReportController extends Controller
{
    public function ajaxlist(Request $request)
    {
        $filterDate     = (!empty($request->start_date) && !empty($request->end_date)) ? 'start='.$request->start_date.'&end='.$request->end_date.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';

        $kegiatans = MyHelper::apiGet('laporan?nopage=1&'.$filterDate.$filterJabatan.$filterAnggota)['data']??[];
        return DataTables::of($kegiatans)
        ->editColumn('user.name', "kegiatanreport::index.name") 
        ->editColumn('category.name', "kegiatanreport::index.category") 
        ->editColumn('laporan_geolocation', "kegiatanreport::index.geolocation") 
        ->editColumn('created_at', "kegiatanreport::index.date") 
        ->editColumn('laporan_description', "kegiatanreport::index.laporan_description") 
        ->editColumn('laporan_performance.persentase', "kegiatanreport::index.performance") 
        ->editColumn('status', "kegiatanreport::index.status") 
        ->addColumn('actions', "kegiatanreport::index.action") 
        ->rawColumns(['actions','user.name','laporan_description','created_at','laporan_geolocation','laporan_performance.persentase','status'])
        ->make();
    }
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

        $kegiatans = MyHelper::apiGet('laporan?'.$filterDate.$filterJabatan.$filterAnggota)??[];

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        return view('kegiatanreport::index', compact('kegiatans', 'anggota', 'jabatan', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kegiatanreport::create');
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
        $kegiatan = MyHelper::apiGet('laporan/'.$id)['data']??[];

        if(!$kegiatan) {
            return redirect(route('laporan.kegiatan.index'));
        }
        $idAnggota = session('id_anggota');
        $anggota = MyHelper::apiGet('anggota/'.$idAnggota)['data']??[];
        return view('kegiatanreport::show', compact('kegiatan', 'anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('kegiatanreport::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $input = [
            'penanganan' => $request->penanganan,
            'penanganan_oleh' => $request->penanganan_oleh,
            'status' => $request->status,
        ];
        $kegiatan = MyHelper::apiRequest('PUT','laporan/'.$id, $input);
        if(isset($kegiatan['status']) && $kegiatan['status'] == 'success'){
            return redirect()->route('laporan.kegiatan.index')->with('message', $kegiatan['message']);
        }
        // return $kegiatan;
        return redirect()->back()->withErrors($kegiatan['error'])->withInput();
    }
    public function downloadExcel(Request $request)
    {
        return (new LaporanExport)->download('laporan.xlsx');
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
