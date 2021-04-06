<?php

namespace App\Exports;

use App\Laporan;
use App\Lib\MyHelper;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $fileName = "laporan.xlsx";

    public function view(): View
    {
        // $getLaporan = MyHelper::apiGet('laporan/export')['data']??[];

        $getUrl = session('kegiatan_param')??'';
        $getLaporan = MyHelper::apiGet('laporan/export/?'.$getUrl)['data']??[];
        session()->forget('kegiatan_param');
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionLaporan = collect($getLaporan);
        return view('kegiatanreport::export', [
            'laporans' => $collectionLaporan,
            'anggota' => $anggota
        ]);
    }
}
