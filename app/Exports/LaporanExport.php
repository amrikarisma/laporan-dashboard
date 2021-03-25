<?php

namespace App\Exports;

use App\Laporan;
use App\Lib\MyHelper;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;
    private $fileName = 'laporan.xlsx';
    public function headings(): array
    {
        return [
            ['FORMAT LAPORAN FKDM'],
           ['No', 'Hari Tanggal/Jam', 'Informasi/Kegiatan/Isu/Kejadian', 'Penanganan Upaya/Solusi', 'Keterangan'],
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $getLaporan = MyHelper::apiGet('laporan/export')['data'];
        $collection = collect($getLaporan);
        $i =0;
        $multiplied = $collection->map(function ($item, $key) use($i) {
            $i = $i+1;
            return [
                'No'        => $i,
                'date'    => $item['created_at'],
                'title'    => $item['laporan_title'],
                // 'location'    => $item['laporan_location'],
                // 'geolocation'    => $item['laporan_geolocation'],
                // 'status'    => $item['status'],
                'penanganan'    => $item['penanganan'],
                // 'anggota'    => $item['user']['name'],
                // 'category' => $item['laporan_category'] = $item['category']['name']??''
            ];
        });

        $laporan = $multiplied->toArray();
        $laporan = collect($laporan);


        return $laporan;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            LaporanExport::class    => function(LaporanExport $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
