<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th align="center" valign="center" colspan="6" style="font-size: 16px; font-weight:bold;text-align:center; height:60px">LAPORAN AKTIVITAS GPS FKDM</th>
        </tr>
        <tr>
            <th align="center" valign="center" style="border:1px solid black"><strong>No.</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Nama</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Aktivitas GPS</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Skor</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Keterangan Skor</strong></th>
            <th align="center" valign="center" style="border:1px solid black"><strong>Aktivitas Terakhir</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td align="center" valign="center" style="border:1px solid black">{{ $loop->iteration}}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['user']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['gps_activity']??'' }}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['score']??'' }}</td>
                <td valign="center" style="border:1px solid black">{{ $laporan['score_text']??'' }}</td>
                <td valign="center" style="border:1px solid black">{{ \Carbon\Carbon::parse($laporan['created_at'])->isoFormat('dddd, D MMMM Y / HH:mm') }}</td>
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
                <td align="center" valign="center" colspan="2">
                    <strong>{{ $anggota['name']??''}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</html>