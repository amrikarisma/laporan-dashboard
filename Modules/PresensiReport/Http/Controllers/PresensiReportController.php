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
        // return $request;
        $filterDate = ($request->start && $request->end) ? 'start='.$request->start.'&end='.$request->end.'&' : '';
        $filterJabatan = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';

        $absents = MyHelper::apiGet('presensi-report?'.$filterDate.$filterJabatan.$filterAnggota)??[];
        // return $absents;
        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        if($request->ajax) {
            return $absents['count'];
        }

        return view('presensireport::index', compact('absents', 'anggota', 'jabatan', 'request'));
    }
}
