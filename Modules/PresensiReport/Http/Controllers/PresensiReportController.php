<?php

namespace Modules\PresensiReport\Http\Controllers;

use App\Exports\PresensiExport;
use App\Lib\MyHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class PresensiReportController extends Controller
{
    public function ajaxlist(Request $request)
    {
        $params = [
            'start' => $request->start_date??'',
            'end'   => $request->end_date??'',
            'jabatan'   => $request->jabatan??'',
            'anggota'   => $request->anggota??'',
            'hadir'     => $request->hadir??'',
            'cabang'     => $request->cabang??'',
            'divisi'     => $request->divisi??'',
            'branch'     => $request->branch??'',
            'offset'    => $request->input('start'),
            'limit'     => $request->input('length'),
            'search'     => $request->input('search.value')
        ];
        $absents = MyHelper::apiGet('presensi-report?table=1', $params)['data']??[];

        return DataTables::collection($absents['data']??[])
        ->filter(function (){})
        ->setTotalRecords($absents['record_data']??0)
        ->setFilteredRecords($absents['total_filtered']??0)
        ->skipPaging()
        ->editColumn('date', function ($presensi) {
            return [
               'display' => !empty($presensi['date']) ? Carbon::parse($presensi['date'])->isoFormat('dddd, D MMMM Y') : '',
               'timestamp' => !empty($presensi['date']) ? Carbon::parse($presensi['date'])->timestamp : ''
            ];
         })

        ->editColumn('user.name', "presensireport::index.name") 
        ->editColumn('geolocation_in', "presensireport::index.geolocation_in") 
        ->editColumn('geolocation_out', "presensireport::index.geolocation_out") 
        ->editColumn('category.name', "presensireport::index.category") 
        ->editColumn('no_present.with_note.text', "presensireport::index.no_present_with_note") 
        ->editColumn('no_present.without_note.text', "presensireport::index.no_present_without_note") 
        ->editColumn('status_presensi.status_presensi_masuk', "presensireport::index.status_presensi") 
        ->editColumn('status_presensi.status_presensi_worktime', "presensireport::index.status_presensi_worktime") 
        ->editColumn('note', "presensireport::index.note") 
        ->addColumn('actions', "presensireport::index.action") 
        ->rawColumns(['actions','date','user.name','geolocation_in','geolocation_out','category.name','no_present.with_note.text', 'no_present.without_note.text','status_presensi.status_presensi_masuk','status_presensi.status_presensi_worktime','note'])
        ->make(true);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filterDate     = (!empty($request->start) && !empty($request->end)) ? 'start='.$request->start.'&end='.$request->end.'&' : '';
        $filterJabatan  = (!empty($request->jabatan)) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = (!empty($request->anggota)) ? 'anggota='.$request->anggota.'&' : '';
        $filterHadir  = (!empty($request->hadir)) ? 'hadir='.$request->hadir.'&' : '';
        $filterCabang  = !empty($request->cabang) ? 'cabang='.$request->cabang.'&' : '';
        $filterDivisi  = !empty($request->divisi) ? 'divisi='.$request->divisi.'&' : ''; // Divisi
        $filterbranch  = !empty($request->branch) ? 'branch='.$request->branch.'&' : ''; // Tingkatan provinsi, kota, kecamatan

        $param_url = $filterDate.''.$filterJabatan.''.$filterAnggota.''.$filterCabang.''.$filterDivisi.$filterbranch.''.$filterHadir;
        $absents = MyHelper::apiGet('presensi-report?'.$param_url)??[];

        session()->put('presensi_param', $param_url);

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $hadir = MyHelper::apiGet('kategori-presensi?pluck=1&group=0')['data']??[];

        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];

        $divisi = MyHelper::apiGet('divisi?pluck=1')['data'] ?? [];

        $branch = MyHelper::apiGet('cabang/branch?pluck=1')['data'] ?? [];

        return view('presensireport::index', compact('absents', 'anggota', 'jabatan','hadir','cabang','divisi','branch', 'request'));
    }

    public function show(Request $request, $id)
    {
        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];
        if(!$anggota) {
            return redirect()->back();
        }
        return view('presensireport::show', compact('anggota'));

    }

    public function downloadExcel(Request $request)
    {
        $profile = MyHelper::apiGet('profile')['data'] ?? [];
        $cabang = $profile['anggota'] != null ? str_replace(' ','-',$profile['anggota']['cabang']['name']) : 'semua-cabang';
        $date = Carbon::now()->isoFormat('DD-MMMM-YYYY');
        return (new PresensiExport)->download('laporan-presensi-'.$date.'-'.$cabang.'.xlsx');
    }
}
