@extends('adminlte::page')

@section('content')
    <h1>Data Anggota</h1>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Date')}}
                        </th>
                        <th>
                            {{ _('Nama')}}
                        </th>
                        <th>
                            {{ _('Jam Masuk')}}
                        </th>
                        <th>
                            {{ _('Jam Keluar')}}
                        </th>
                        <th>
                            {{ _('Lokasi Masuk')}}
                        </th>
                        <th>
                            {{ _('Lokasi Keluar')}}
                        </th>
                        <th>
                            {{ _('Keterangan')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotas as $anggota)
                    <tr>
                        <td>{{ $absent['date'] }}</td>
                        <td>{{ $absent['user']['name'] }}</td>
                        <td>{{ $absent['time_in'] }}</td>
                        <td>{{ $absent['time_out'] }}</td>
                        <td>{{ $absent['geolocation_in'] }}</td>
                        <td>{{ $absent['geolocation_out'] }}</td>
                        <td>{{ $absent['keterangan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
