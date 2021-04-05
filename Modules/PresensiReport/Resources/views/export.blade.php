<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="6" style="font-size: 16px; font-weight:bold;text-align:center">FORMAT LAPORAN PRESENSI FKDM</th>
        </tr>
        <tr>
            <th><strong>Tanggal</strong></th>
            <th><strong>Cabang</strong></th>
            <th><strong>Nama</strong></th>
            <th><strong>Jabatan</strong></th>
            <th><strong>Jam Masuk</strong></th>
            <th><strong>Jam Keluar</strong></th>
            <th><strong>Jam Kerja</strong></th>
            <th><strong>Lokasi Masuk</strong></th>
            <th><strong>Lokasi Keluar</strong></th>
            <th><strong>Kategori</strong></th>
            <th><strong>Skor</strong></th>
            <th><strong>Status Presensi Masuk</strong></th>
            <th><strong>Status Jam Kerja</strong></th>
            <th><strong>Tidak Hadir Dengan Keterangan (Bulan ini)</strong></th>
            <th><strong>Tidak Hadir Tanpa Keterangan (Bulan ini)</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td>{{ \Carbon\Carbon::parse($laporan['date'])->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                <td>{{ $laporan['user']['anggota']['cabang']['name']??'' }}</td>
                <td>{{ $laporan['user']['name']??'' }}</td>
                <td>{{ $laporan['user']['anggota']['jabatan']['name']??'' }}</td>
                <td>{{ $laporan['time_in']??'' }}</td>
                <td>{{ $laporan['time_out']??'' }}</td>
                <td>{{ $laporan['work_time']??'' }}</td>
                <td>{{ $laporan['geolocation_in']??'' }}</td>
                <td>{{ $laporan['geolocation_out']??'' }}</td>
                <td>{{ $laporan['category']['name']??'' }}</td>
                <td>{{ $laporan['score']['score']??'' }}</td>
                <td>{{ $laporan['status_presensi']['status_presensi_masuk']??'' }}</td>
                <td>{{ $laporan['status_presensi']['status_presensi_worktime']??'' }}</td>
                <td>{{ $laporan['no_present']['with_note']['text']??'' }}</td>
                <td>{{ $laporan['no_present']['without_note']['text']??'' }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    Jakarta, {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    Anggota FKDM
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    {{ $anggota['anggota']['cabang']['name']??'' }}
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td style="height: 100px">
                    Tanda Tangan
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    {{ $anggota['name']??''}}
                </td>
            </tr>
        </tfoot>
    </table>
</html>