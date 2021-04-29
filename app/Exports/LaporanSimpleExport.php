<?php

namespace App\Exports;

use App\Lib\MyHelper;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanSimpleExport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $getUrl = session('kegiatan_param')??'';
        $getLaporan = MyHelper::apiGet('laporan/export/?'.$getUrl)['data']??[];
        session()->forget('kegiatan_param');
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionLaporan = collect($getLaporan);
        return view('kegiatanreport::export_simple', [
            'laporans' => $collectionLaporan,
            'anggota' => $anggota
        ]);
    }
}
