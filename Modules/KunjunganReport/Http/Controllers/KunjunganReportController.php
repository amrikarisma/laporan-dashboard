<?php

namespace Modules\KunjunganReport\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KunjunganReportController extends Controller
{
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

        // $absents = MyHelper::apiGet('presensi-report?'.$filterDate.$filterJabatan.$filterAnggota)??[];

        $kunjungans = MyHelper::apiGet('laporan?'.$filterDate.$filterJabatan.$filterAnggota)??[];
        // return $kunjungans;
        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        return view('kunjunganreport::index', compact('kunjungans', 'anggota', 'jabatan', 'request'));
    }
}
