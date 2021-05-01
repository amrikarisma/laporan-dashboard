<?php

namespace App\Exports;

use App\Lib\MyHelper;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PresensiExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $fileName = "laporan.xlsx";

    public function view(): View
    {
        $getUrl = session('presensi_param')??'';
        $getPresensi = MyHelper::apiGet('presensi-report/export/?'.$getUrl)['data']??[];
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionPresensi = collect($getPresensi);
        return view('presensireport::export', [
            'laporans' => $collectionPresensi,
            'anggota' => $anggota
        ]);
    }
}
