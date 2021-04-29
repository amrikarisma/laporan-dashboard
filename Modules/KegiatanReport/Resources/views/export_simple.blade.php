<html>
    <head>
        <style>
             td {
                display: table-cell;
                vertical-align: middle;
                height: 100%;
             }
        </style>
    </head>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="10" style="font-size: 16px; font-weight:bold;text-align:center">FORMAT LAPORAN FKDM</th>
        </tr>
        <tr>
            <th><strong>No.</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Judul</strong></th>
            <th><strong>Deskripsi</strong></th>
            <th><strong>Foto</strong></th>
            <th><strong>Rekomendasi</strong></th>
        </tr>
        </thead>
        <tbody>
            
        @foreach($laporans as $laporan)
            <tr>
                <td align="center" valign="center">{{ $loop->iteration}}</td>
                <td align="center" valign="center">{{ \Carbon\Carbon::parse($laporan['created_at'])->isoFormat('dddd, D MMMM Y / HH:mm') }}</td>
  
                <td align="center" valign="center">{{ $laporan['laporan_title']??'' }}</td>
                <td align="center" valign="center" style="table-layout: auto;width:60px;word-wrap:break-word;">{{ $laporan['laporan_description']??'' }}</td>
                @if (isset($laporan['image'][0]['path']))
                    <td><img width="100" height="100" src="{{ env('STORAGE_PATH').'/'.$laporan['image'][0]['path'] }}" alt=""></td>
                @else
                    <td></td>
                @endif
                <td align="center" valign="center">{{ $laporan['recommendation']??'' }}</td>
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
                <td colspan="2">
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
                <td colspan="2">
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
                <td colspan="2">
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
                <td colspan="2" style="height: 100px">
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
                <td colspan="2">
                    {{ $anggota['name']??''}}
                </td>
            </tr>
        </tfoot>
    </table>
</html>