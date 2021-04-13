<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="6" style="font-size: 16px; font-weight:bold;text-align:center">FORMAT LAPORAN FKDM</th>
        </tr>
        <tr>
            <th><strong>No.</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Judul</strong></th>
            <th><strong>Kategori</strong></th>
            <th><strong>Lokasi</strong></th>
            <th><strong>Pengirim</strong></th>
            <th><strong>Penanganan</strong></th>
        </tr>
        </thead>
        <tbody>
    
        @foreach($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ \Carbon\Carbon::parse($laporan['created_at'])->isoFormat('D MMMM Y') }}</td>
                <td>{{ $laporan['laporan_title']??'' }}</td>
                <td>{{ $laporan['category']['name']??'Tidak ada kategori' }}</td>
                <td>{{ $laporan['laporan_location']??'' }}</td>
                <td>{{ $laporan['user']['name']??'' }}</td>
                <td>{{ $laporan['penanganan']??'' }}</td>
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
                <td colspan="2">
                    Jakarta, {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
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
                <td>
                </td>
                <td colspan="2">
                    {{ $anggota['name']??''}}
                </td>
            </tr>
        </tfoot>
    </table>
</html>