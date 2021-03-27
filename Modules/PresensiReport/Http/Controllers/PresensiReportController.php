<?php

namespace Modules\PresensiReport\Http\Controllers;

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
        $filterDate     = (!empty($request->start_date) && !empty($request->end_date)) ? 'start='.$request->start_date.'&end='.$request->end_date.'&' : '';
        $filterJabatan  = (!empty($request->jabatan)) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = (!empty($request->anggota)) ? 'anggota='.$request->anggota.'&' : '';
        $filterHadir  = (!empty($request->hadir)) ? 'hadir='.$request->hadir.'&' : 0;

        $absents = MyHelper::apiGet('presensi-report?'.$filterDate.''.$filterJabatan.''.$filterAnggota.''.$filterHadir)['data']??[];
        return DataTables::of($absents)
        ->editColumn('date', function ($presensi) {
            return [
               'display' => !empty($presensi['date']) ? Carbon::parse($presensi['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y') : '',
               'timestamp' => Carbon::parse($presensi['date'])->timestamp
            ];
         })

        ->editColumn('user.name', "presensireport::index.name") 
        ->editColumn('geolocation_in', "presensireport::index.geolocation_in") 
        ->editColumn('geolocation_out', "presensireport::index.geolocation_out") 
        ->editColumn('category.name', "presensireport::index.category") 
        ->editColumn('no_present.with_note.text', "presensireport::index.no_present_with_note") 
        ->editColumn('no_present.without_note.text', "presensireport::index.no_present_without_note") 
        ->editColumn('note', "presensireport::index.note") 
        ->addColumn('actions', "presensireport::index.action") 
        ->rawColumns(['actions','date','user.name','geolocation_in','geolocation_out','category.name','no_present.with_note.text', 'no_present.without_note.text','note'])
        ->make();
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
        $filterHadir  = (!empty($request->hadir)) ? 'hadir='.$request->hadir.'&' : 0;

        $absents = MyHelper::apiGet('presensi-report?'.$filterDate.''.$filterJabatan.''.$filterAnggota.''.$filterHadir)??[];

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $hadir = MyHelper::apiGet('kategori-presensi?pluck=1&group=0')['data']??[];
        // return $absents;
        return view('presensireport::index', compact('absents', 'anggota', 'jabatan','hadir', 'request'));
    }

    public function show(Request $request, $id)
    {
        $anggota = MyHelper::apiGet('anggota/' . $id)['data'] ?? [];
        if(!$anggota) {
            return redirect()->back();
        }
        return view('presensireport::show', compact('anggota'));

    }
}
