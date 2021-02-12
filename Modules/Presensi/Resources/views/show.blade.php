@extends('adminlte::page')

@section('content')
    <h1>Detail Presensi</h1>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Tanggal' }}</td>
                        <td>{{ \Carbon\Carbon::parse($absent['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Nama' }}</td>
                        <td>{{ $absent['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Masuk' }}</td>
                        <td>{{ $absent['time_in']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Keluar' }}</td>
                        <td>{{ $absent['time_out']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Lokasi Presensi Masuk' }}</td>
                        <td>{{ $absent['geolocation_in']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Lokasi Presensi Keluar' }}</td>
                        <td>{{ $absent['geolocation_out']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Keterangan' }}</td>
                        <td>{{ $absent['category']['name']??'' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection