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
    // public function headings(): array
    // {
    //     return [
    //         ['FORMAT LAPORAN FKDM'],
    //        ['No', 'Hari Tanggal/Jam', 'Informasi/Kegiatan/Isu/Kejadian', 'Penanganan Upaya/Solusi', 'Keterangan'],
    //     ];
    // }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $getLaporan = MyHelper::apiGet('laporan/export')['data'];
    //     $collection = collect($getLaporan);
    //     $multiplied = $collection->map(function ($item, $key) {
    //         return [
    //             'No'        => $key+1,
    //             'date'    => $item['created_at'],
    //             'title'    => $item['laporan_title'],
    //             'penanganan'    => $item['penanganan'],
    //         ];
    //     });

    //     $laporan = $multiplied->toArray();
    //     $laporan = collect($laporan);


    //     return $laporan;
    // }

    public function view(): View
    {
        $getLaporan = MyHelper::apiGet('laporan/export')['data']??[];
        $anggota = MyHelper::apiGet('profile')['data']??[];
        $collectionLaporan = collect($getLaporan);
        return view('kegiatanreport::export', [
            'laporans' => $collectionLaporan,
            'anggota' => $anggota
        ]);
    }
}
