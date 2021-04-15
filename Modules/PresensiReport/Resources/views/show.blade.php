@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Presensi : {{ $anggota['user']['name'] }}</h3>
        </div>
        <div class="card-body">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Date')}}
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
                            {{ _('Skor')}}
                        </th>
                        <th>
                            {{ _('Hasil')}}
                        </th>
                        <th>
                            {{ _('Keterangan')}}
                        </th>
                        <th>{{ _('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
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
        scrollCollapse:true,
        scrollY:500,
        scrollX:true,
        ajax: `{{ route('laporan.presensi.ajaxlist') }}`,
        columns: [
        { data: 'date' },
        { data: 'time_in' },
        { data: 'time_out' },
        { data: 'work_time' },
        { data: 'geolocation_in'},
        { data: 'geolocation_out'},
        { data: 'category.name'},
        { data: 'score'},
        { data: 'score_text'},
        { data: 'note'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection