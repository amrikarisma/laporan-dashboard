<?php

namespace Modules\History\Http\Controllers;

use App\Exports\GPSExport;
use App\Lib\MyHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HistoryController extends Controller
{
    public function location()
    {
        $location = MyHelper::apiGet('location')['data']??[];
        return $location;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        return view('history::index', compact('anggota','jabatan', 'request'));

    }

    public function downloadExcel(Request $request)
    {
        $profile = MyHelper::apiGet('profile')['data'] ?? [];
        $cabang = $profile['anggota'] != null ? str_replace(' ','-',$profile['anggota']['cabang']['name']) : 'semua-cabang';
        $date = Carbon::now()->locale('id_ID')->isoFormat('DD-MMMM-YYYY');
        return (new GPSExport)->download('laporan-aktifitas-gps-'.$date.'-'.$cabang.'.xlsx');
    }
}
