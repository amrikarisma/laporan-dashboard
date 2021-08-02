@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Data Anggota</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('anggota.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.notification')

            <table id="anggota-table" class="table ">
                <thead>
                    <tr>
                        <th>
                            {{ _('Foto')}}
                        </th>
                        <th>
                            {{ _('Nama')}}
                        </th>
                        <th>
                            {{ _('Jabatan')}}
                        </th>
                        <th>
                            {{ _('Divisi')}}
                        </th>
                        <th>
                            {{ _('Unit Cabang')}}
                        </th>
                        <th>
                            {{ _('Tanggal Bergabung')}}
                        </th>
                        <th>
                            {{ _('SK Pengangkatan')}}
                        </th>
                        <th>
                            {{ _('NIK')}}
                        </th>
                        <th>
                            {{ _('Email')}}
                        </th>
                        <th>
                            {{ _('No. Telepon')}}
                        </th>
                        <th>
                            {{ _('Aksi')}}
                        </th>
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
<style>

</style>
@endsection
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
    $('#anggota-table').DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse:true,
        // scrollY:500,
        scrollX:true,
        ajax: "{{ route('anggota.listanggota') }}",
        columns: [
        { data: 'user.userdata.profile_photo_url' },
        { data: 'user.name' },
        { data: 'jabatan.name' },
        { data: 'divisi.name' },
        { data: 'cabang.name' },
        { data: 'join_date'},
        { data: 'sk_pengangkatan'},
        { data: 'nik'},
        { data: 'user.email'},
        { data: 'user.userdata.phone'},
        { data: 'actions'},
    ]
    });

    </script>
@endsection