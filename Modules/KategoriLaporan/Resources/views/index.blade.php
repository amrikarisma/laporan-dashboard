@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Kategori Laporan</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('kategori-laporan.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Nama')}}
                        </th>
                        <th>{{ _('')}}</th>
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
        ajax: `{{ route('kategori-laporan.ajaxlist') }}`,
        columns: [
        { data: 'name' },
        { data: 'actions'},
    ]
    });
    </script>

@endsection