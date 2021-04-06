<?php

namespace App\Exports;

use App\Lib\MyHelper;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KunjugnanExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $fileName = "laporan.xlsx";

    public function view(): View
    {
        $getUrl = session('kunjungan_param')??'';
        $getLaporan = MyHelper::apiGet('laporan/export/?'.$getUrl)['data']??[];
        session()->forget('kunjungan_param');
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionLaporan = collect($getLaporan);

        return view('kunjunganreport::export', [
            'laporans' => $collectionLaporan,
            'anggota' => $anggota
        ]);
    }
}
