<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="7" valign="center" style="font-size: 16px; font-weight:bold;text-align:center; height:50px">LAPORAN KUNJUNGAN FKDM</th>
        </tr>
        <tr>
            <th align="center" valign="center" style="border:1px solid black"><strong>No.</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Judul</strong></th>
            <th align="center" valign="center" style="border:1px solid black; width: 50px;word-wrap: break-word"><strong>Lokasi Manual</strong></th>
            <th align="center" valign="center" style="border:1px solid black; width: 50px;word-wrap: break-word"><strong>Alamat GPS</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Lokasi GPS</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Tanggal</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Pengirim</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td align="center" valign="center" style="border:1px solid black">{{ $loop->iteration}}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['laporan_title']??'' }}</td>
                <td valign="center" style="border:1px solid black;word-wrap: break-word">{{ $laporan['laporan_location']??'' }}</td>
                <td valign="center" style="border:1px solid black;word-wrap: break-word">{{ !empty($laporan['laporan_address_geo']) ? $laporan['laporan_address_geo'] : ($laporan['laporan_geolocation']??'') }}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['laporan_geolocation']??'' }}</td>
                <td valign="center" style="border:1px solid black">{{ \Carbon\Carbon::parse($laporan['created_at'])->isoFormat('D MMMM Y') }}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['user']['name']??'' }}</td>
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
                <td align="center" valign="center" colspan="2"
                    style="height: 60px">
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
                <td align="center" valign="center" colspan="2">
                    <strong>{{ $anggota['name']??''}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</html>