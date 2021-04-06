<?php

namespace App\Exports;

use App\Lib\MyHelper;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GPSExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $fileName = "laporan.xlsx";

    public function view(): View
    {
        $getUrl = session('gps_param')??'';
        $getGPSReport = MyHelper::apiGet('gps-report/export/?'.$getUrl)['data']??[];
        session()->forget('gps_param');
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionGPS = collect($getGPSReport);
        return view('gpsreport::export', [
            'laporans' => $collectionGPS,
            'anggota' => $anggota
        ]);
    }
}
