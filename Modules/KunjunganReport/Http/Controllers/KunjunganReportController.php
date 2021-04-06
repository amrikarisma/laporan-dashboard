<?php

namespace Modules\KunjunganReport\Http\Controllers;

use App\Exports\KunjugnanExport;
use App\Lib\MyHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class KunjunganReportController extends Controller
{
    public function ajaxlist(Request $request)
    {
        $filterDate     = (!empty($request->start_date) && !empty($request->end_date)) ? 'start='.$request->start_date.'&end='.$request->end_date.'&' : '';
        $filterJabatan  = ($request->jabatan) ? 'jabatan='.$request->jabatan.'&' : '';
        $filterAnggota  = ($request->anggota) ? 'anggota='.$request->anggota.'&' : '';
        $filterCabang  = ($request->cabang) ? 'cabang='.$request->cabang.'&' : '';

        $kunjungans = MyHelper::apiGet('laporan?nopage=1&'.$filterDate.$filterJabatan.$filterAnggota.$filterCabang)['data']??[];
        return DataTables::of($kunjungans)
        ->editColumn('user.name', "kunjunganreport::index.name") 
        ->editColumn('category.name', "kunjunganreport::index.category") 
        // ->editColumn('laporan_geolocation', "kunjunganreport::index.geolocation") 
        // ->addColumn('address', function($data) {
        //     $var = $data['laporan_geolocation'];
        //     $geo = explode (", ", $var);
        //     if(isset($geo[1])) {
        //         // return $geo[1];
        //         return $this->getAddress($geo[0],$geo[1]);
        //     } else {
        //         return 'GPS tidak valid';
        //     }
        // }) 
        ->editColumn('created_at', "kunjunganreport::index.date") 
        ->editColumn('laporan_description', "kunjunganreport::index.laporan_description") 
        ->editColumn('laporan_performance.persentase', "kunjunganreport::index.performance") 
        ->addColumn('actions', "kunjunganreport::index.action") 
        ->rawColumns(['actions','user.name','laporan_description','created_at','laporan_geolocation','laporan_performance.persentase'])
        ->make();
    }

    public function getAddress($lat,$long)
    {
        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat='.$lat.'&lon='.$long);
        return $response['features'][0]['properties']['display_name']??'Alamat tidak ketemu';
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
        $filterCabang  = ($request->cabang) ? 'cabang='.$request->cabang.'&' : '';

        $param_url = $filterDate.$filterJabatan.$filterAnggota.$filterCabang;
        $kunjungans = MyHelper::apiGet('laporan?'.$param_url)??[];
        session()->put('kunjungan_param', $param_url);

        $anggota = MyHelper::apiGet('anggota?pluck=1')['data']??[];

        $jabatan = MyHelper::apiGet('jabatan?pluck=1')['data']??[];

        $cabang = MyHelper::apiGet('cabang?pluck=1')['data'] ?? [];

        return view('kunjunganreport::index', compact('kunjungans','cabang', 'anggota', 'jabatan', 'request'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $kunjungan = MyHelper::apiGet('laporan/'.$id)['data']??[];
        $var = $kunjungan['laporan_geolocation'];
        $geo = explode (", ", $var);
        if(isset($geo[1])) {
            // return $geo[1];
            $kunjungan['address'] = $this->getAddress($geo[0],$geo[1]);
        } else {
            $kunjungan['address'] =  'GPS tidak valid';
        }

        if(!$kunjungan) {
            return redirect(route('laporan.kunjungan.index'));
        }

        return view('kunjunganreport::show', compact('kunjungan'));
    }

    public function downloadExcel(Request $request)
    {
        $profile = MyHelper::apiGet('profile')['data'] ?? [];
        $cabang = $profile['anggota'] != null ? str_replace(' ','-',$profile['anggota']['cabang']['name']) : 'semua-cabang';
        $date = Carbon::now()->locale('id_ID')->isoFormat('DD-MMMM-YYYY');
        return (new KunjugnanExport)->download('laporan-kunjungan-'.$date.'-'.$cabang.'.xlsx');
    }
}
