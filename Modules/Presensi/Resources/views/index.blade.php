@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Presensi</h3>
        </div>
        <div class="card-body">
            <table id="table" class="table">
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
                            {{ _('Kategori')}}
                        </th>
                        <th>
                            {{ _('Keterangan')}}
                        </th>
                        <th>{{ _('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($absents as $absent)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($absent['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                        <td>{{ $absent['user']['name']??'' }}</td>
                        <td>{{ $absent['time_in']??'' }}</td>
                        <td>{{ $absent['time_out']??'' }}</td>
                        <td>{{ $absent['work_time']??0 }}</td>
                        <td>{{ $absent['geolocation_in']??'' }}</td>
                        <td>{{ $absent['geolocation_out']??'' }}</td>
                        <td>{{ $absent['category']['name']??'' }}</td>
                        <td>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('presensi.show', $absent['id']) }}">Detail</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: `{{ route('presensi.ajaxlist') }}`,
        columns: [
        { data: 'date' },
        { data: 'user.name' },
        { data: 'time_in' },
        { data: 'time_out' },
        { data: 'work_time' },
        { data: 'geolocation_in'},
        { data: 'geolocation_out'},
        { data: 'category.name'},
        { data: 'note'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection