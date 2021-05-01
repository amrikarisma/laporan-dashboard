<?php

namespace Modules\KegiatanReport\Http\Controllers;

use App\Exports\LaporanExport;
use App\Exports\LaporanSimpleExport;
use App\Lib\MyHelper;
use Carbon\Carbon;
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
        $filterJabatan  = !empty($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = !empty($request->anggota) ? 'anggota='.$request->anggota.'&' : '';
        $filterCabang  = !empty($request->cabang) ? 'cabang='.$request->cabang.'&' : '';
        $filterDivisi  = !empty($request->divisi) ? 'divisi='.$request->divisi.'&' : '';
        $filterCategory  = !empty($request->category) ? 'category='.$request->category.'&' : '';
        $filterbranch  = !empty($request->branch) ? 'branch='.$request->branch.'&' : ''; // Tingkatan provinsi, kota, kecamatan

        $param_url = $filterDate.''.$filterJabatan.''.$filterAnggota.''.$filterCabang.''.$filterDivisi.''.$filterCategory.''.$filterbranch;
        $kegiatans = MyHelper::apiGet('laporan?nopage=1&'.$param_url)['data']??[];

        return DataTables::of($kegiatans)
        ->editColumn('created_at', function ($kegiatans) {
            return [
               'display' => !empty($kegiatans['created_at']) ? Carbon::parse($kegiatans['created_at'])->isoFormat('dddd, D MMMM Y / HH:mm') : '',
               'timestamp' => !empty($kegiatans['created_at']) ? Carbon::parse($kegiatans['created_at'])->timestamp : ''
            ];
         })
        ->editColumn('user.name', "kegiatanreport::index.name") 
        ->editColumn('category.name', "kegiatanreport::index.category") 
        ->editColumn('laporan_address_geo', "kegiatanreport::index.laporan_address_geo") 
        ->editColumn('laporan_description', "kegiatanreport::index.laporan_description") 
        ->editColumn('recommendation', "kegiatanreport::index.recommendation") 
        ->editColumn('laporan_performance.persentase', "kegiatanreport::index.performance") 
        ->editColumn('status', "kegiatanreport::index.status") 
        ->addColumn('actions', "kegiatanreport::index.action") 
        ->rawColumns(['actions','user.name','laporan_description','created_at','laporan_address_geo','laporan_performance.persentase','status'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filterDate     = (!empty($request->start) && !empty($request->end)) ? 'start='.$request->start.'&end='.$request->end.'&' : '';
        $filterJabatan  = !empty($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : ''; // Jabatan
        $filterAnggota  = !empty($request->anggota) ? 'anggota='.$request->anggota.'&' : ''; // Anggota
        $filterCabang  = !empty($request->cabang) ? 'cabang='.$request->cabang.'&' : ''; //Cabang
        $filterDivisi  = !empty($request->divisi) ? 'divisi='.$request->divisi.'&' : ''; // Divisi
        $filterCategory  = !empty($request->category) ? 'category='.$request->category.'&' : ''; // Category laporan
        $filterbranch  = !empty($request->branch) ? 'branch='.$request->branch.'&' : ''; // Tingkatan provinsi, kota, kecamatan

        $param_url = $filterDate.''.$filterJabatan.''.$filterAnggota.''.$filterCabang.''.$filterDivisi.''.$filterCategory.''.$filterbranch;
        $kegiatans = MyHelper::apiGet('laporan?'.$param_url)??[];
        session()->put('kegiatan_param', $param_url);

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];

        $divisi = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];

        $categories = MyHelper::apiGet('kategorilaporan?pluck=1')['data'] ?? [];

        $branch = MyHelper::apiGet('cabang/branch?pluck=1')['data'] ?? [];

        return view('kegiatanreport::index', compact('kegiatans', 'cabang','anggota', 'jabatan','divisi', 'categories','branch','request'));
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
        $superadmin = MyHelper::hasAccess([1], session('roles'));
        if($superadmin) {
            $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];
        } else {
            $anggota = MyHelper::apiGet('anggota/'.$idAnggota)['data']??[];
        }
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

        return redirect()->back()->withErrors($kegiatan['error'])->withInput();
    }
    public function downloadExcel(Request $request)
    {
        $profile = MyHelper::apiGet('profile')['data'] ?? [];
        $cabang = $profile['anggota'] != null ? str_replace(' ','-',$profile['anggota']['cabang']['name']) : 'semua-cabang';
        $date = Carbon::now()->isoFormat('DD-MMMM-YYYY');

        if(!empty($request->simple) && $request->simple == "1") {
            return (new LaporanSimpleExport)->download('laporan-kegiatan-'.$date.'-'.$cabang.'-simple.xlsx');
        } else {
            return (new LaporanExport)->download('laporan-kegiatan-'.$date.'-'.$cabang.'.xlsx');
        }
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
