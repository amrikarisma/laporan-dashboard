<?php

namespace Modules\GPSReport\Http\Controllers;

use App\Lib\MyHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class GPSReportController extends Controller
{
    public function ajaxlist(Request $request)
    {
        $filterDate     = (!empty($request->start_date) && !empty($request->end_date)) ? 'start='.$request->start_date.'&end='.$request->end_date.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';
        $filterHadir  = ($request->hadir) ? 'hadir='.$request->hadir.'&' : 0;

        $laporanGPS = MyHelper::apiGet('gps-report?'.$filterDate.$filterJabatan.$filterAnggota.$filterHadir)['data']??[];
        return DataTables::of($laporanGPS)
        ->editColumn('created_at', function ($laporanGPS) {
            return [
               'display' => !empty($laporanGPS['created_at']) ? Carbon::parse($laporanGPS['created_at'])->locale('id_ID')->isoFormat('dddd, D MMMM Y') : '',
               'timestamp' => Carbon::parse($laporanGPS['created_at'])->timestamp
            ];
         })
         ->editColumn('user.name', "presensireport::index.name") 
        ->addColumn('actions', "kegiatanreport::index.action") 
        ->rawColumns(['actions','user.name'])
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
        $filterHadir  = ($request->hadir) ? 'hadir='.$request->hadir.'&' : 0;

        $absents = MyHelper::apiGet('presensi-report?'.$filterDate.$filterJabatan.$filterAnggota.$filterHadir)??[];

        $gpsReport = MyHelper::apiGet('gps-report')??[];

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $hadir = MyHelper::apiGet('kategori-presensi?pluck=1&group=0')['data']??[];

        return view('gpsreport::index', compact('gpsReport', 'anggota', 'jabatan','hadir', 'request'));
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     $absent = MyHelper::apiGet('gps-report/'.$id)['data'][0]??[];
    //     // return $absent;
    //     return view('gpsreport::show', compact('absent'));
    // }
}
