@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Presensi</h3>
        </div>
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
                            {{ _('Jam Kerja')}}
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
                        <th>{{ _('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absents as $absent)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($absent['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                        <td>{{ $absent['user']['name']??'' }}</td>
                        <td>{{ $absent['time_in']??'' }}</td>
                        <td>{{ $absent['time_out']??'' }}</td>
                        <td>{{ $absent['work_time']??0 }} Jam</td>
                        <td>{{ $absent['geolocation_in']??'' }}</td>
                        <td>{{ $absent['geolocation_out']??'' }}</td>
                        <td>{{ $absent['category']['name']??'' }}</td>
                        <td>
                            <a class="btn btn-primary"
                            href="{{ route('presensi.show', $absent['id']) }}">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
