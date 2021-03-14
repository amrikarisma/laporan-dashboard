<?php

namespace Modules\PresensiReport\Http\Controllers;

use App\Lib\MyHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PresensiReportController extends Controller
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
        $filterHadir  = ($request->hadir) ? 'hadir='.$request->hadir.'&' : 0;

        $absents = MyHelper::apiGet('presensi-report?'.$filterDate.$filterJabatan.$filterAnggota.$filterHadir)??[];

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $hadir = MyHelper::apiGet('kategori-presensi?pluck=1&group=0')['data']??[];

        return view('presensireport::index', compact('absents', 'anggota', 'jabatan','hadir', 'request'));
    }
}
