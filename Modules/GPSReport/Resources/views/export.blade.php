<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="6" style="font-size: 16px; font-weight:bold;text-align:center">FORMAT LAPORAN GPS FKDM</th>
        </tr>
        <tr>
            <th><strong>No.</strong></th>
            <th><strong>Nama</strong></th>
            <th><strong>Aktifitas GPS</strong></th>
            <th><strong>Skor</strong></th>
            <th><strong>Keterangan Skor</strong></th>
            <th><strong>Aktifitas Terakhir</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $laporan['user']['name']??'' }}</td>
                <td>{{ $laporan['gps_activity']??'' }}</td>
                <td>{{ $laporan['score']??'' }}</td>
                <td>{{ $laporan['score_text']??'' }}</td>
                <td>{{ \Carbon\Carbon::parse($laporan['created_at'])->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
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