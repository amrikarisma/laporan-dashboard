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
            <th align="center" valign="center"  colspan="10" style="font-size: 16px; font-weight:bold;text-align:center; height: 50px">LAPORAN FKDM</th>
        </tr>
        <tr>
            <th align="center" valign="center" style="border:1px solid black" ><strong>No.</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Hari/Tanggal/Jam</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Foto</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Judul</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Kategori</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Deskripsi</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Usulan</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Lokasi</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Pengirim</strong></th>
            <th align="center" valign="center" style="border:1px solid black" ><strong>Penanganan</strong></th>
        </tr>
        </thead>
        <tbody>
            
        @foreach($laporans as $laporan)
            <tr>
                <td align="center" valign="center" style="border:1px solid black" >{{ $loop->iteration}}</td>
                <td valign="center" style="border:1px solid black" >{{ \Carbon\Carbon::parse($laporan['created_at'])->isoFormat('dddd, D MMMM Y / HH:mm') }}</td>
                @if (isset($laporan['image'][0]['path']) && file_exists(env('STORAGE_PATH').'/'.$laporan['image'][0]['path']) )
                    <td valign="center" style="border:1px solid black"><img width="100" height="100" src="{{ env('STORAGE_PATH').'/'.$laporan['image'][0]['path'] }}" alt=""></td>
                @else
                <td></td>
                @endif
                <td valign="center" style="border:1px solid black" >{{ $laporan['laporan_title']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['category']['name']??'Tidak ada kategori' }}</td>
                <td valign="center" style="border:1px solid black table-layout: auto;width:60px;word-wrap:break-word;">{{ $laporan['laporan_description']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['recommendation']??'' }}</td>
                <td valign="center" style="border:1px solid black;word-wrap:break-word;" >{{ $laporan['laporan_location']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['user']['name']??'' }}</td>
                <td valign="center" style="border:1px solid black" >{{ $laporan['penanganan']??'' }}</td>
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
                <td align="center" valign="center" colspan="2">
                    <strong>{{ $anggota['name']??''}}</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</html>