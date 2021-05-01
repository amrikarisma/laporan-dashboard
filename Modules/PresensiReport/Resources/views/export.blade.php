<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th  align="center" valign="center" colspan="15" style="font-size: 16px; font-weight:bold;text-align:center;height: 50px">LAPORAN PRESENSI FKDM</th>
        </tr>
        <tr>
            <th align="center" valign="center" style="border:1px solid black"><strong>Tanggal</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Cabang</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Nama</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Jabatan</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Jam Masuk</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Jam Keluar</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Jam Kerja</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Lokasi Masuk</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Lokasi Keluar</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Kategori</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Skor</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Status Presensi Masuk</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Status Jam Kerja</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Tidak Hadir Dengan Keterangan (Bulan ini)</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Tidak Hadir Tanpa Keterangan (Bulan ini)</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td valign="center" style="border:1px solid black" >{{ \Carbon\Carbon::parse($laporan['date'])->isoFormat('D MMMM Y') }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['user']['anggota']['cabang']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['user']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['user']['anggota']['jabatan']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['time_in']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['time_out']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['work_time']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['geolocation_in']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['geolocation_out']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['category']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['score']['score']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['status_presensi']['status_presensi_masuk']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['status_presensi']['status_presensi_worktime']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['no_present']['with_note']['text']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['no_present']['without_note']['text']??'' }}</td>
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
                </td>
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
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td align="center" valign="center" colspan="2">
                    Jakarta, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
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
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td align="center" valign="center" colspan="2">
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
                </td>
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
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td align="center" valign="center" colspan="2">
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
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td align="center" valign="center" colspan="2" style="height: 60px">
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
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td align="center" valign="center" colspan="2">
                    <strong>{{ $anggota['name']??''}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</html>