<?php

namespace App\Exports;

use App\Laporan;
use App\Lib\MyHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $getUrl = session('kegiatan_param') ?? '';
        $getLaporan = MyHelper::apiGet('laporan/export/?' . $getUrl)['data'] ?? [];
        $anggota = MyHelper::apiGet('profile')['data'] ?? [];
        $collectionLaporan = collect($getLaporan);
        return view('kegiatanreport::export', [
            'laporans' => $collectionLaporan,
            'anggota' => $anggota
        ]);
    }
}
