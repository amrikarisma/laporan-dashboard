<html>
    <table class="table-responsive" width="100%">
        <thead>
        <tr>
            <th colspan="6" style="font-size: 16px; font-weight:bold;text-align:center">FORMAT LAPORAN KUNJUNGAN FKDM</th>
        </tr>
        <tr>
            <th><strong>No.</strong></th>
            <th><strong>Judul</strong></th>
            <th><strong>Lokasi Manual</strong></th>
            <th><strong>Alamat GPS</strong></th>
            <th><strong>Lokasi GPS</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Pengirim</strong></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($laporans as $laporan)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $laporan['laporan_title']??'' }}</td>
                <td>{{ $laporan['laporan_location']??'' }}</td>
                <td>{{ !empty($laporan['laporan_address_geo']) ? $laporan['laporan_address_geo'] : ($laporan['laporan_geolocation']??'') }}</td>
                <td>{{ $laporan['laporan_geolocation']??'' }}</td>
                <td>{{ \Carbon\Carbon::parse($laporan['created_at'])->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                <td>{{ $laporan['user']['name']??'' }}</td>
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