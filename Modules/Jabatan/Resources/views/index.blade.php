@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Jabatan</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('jabatan.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-hover dataTable dtr-inline">
                <thead>
                    <tr>
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
                            {{ _('Laporan Harian Wajib')}}
                        </th>
                        <th>
                            {{ _('Laporan Kunjungan Harian Wajib')}}
                        </th>
                        <th>
                            {{ _('Toleransi Presensi tanpa Keterangan')}}
                        </th>
                        <th>
                            {{ _('Toleransi Presensi dengan Keterangan')}}
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($jabatans['data'] as $jabatan)
                    <tr>
                        <td>{{ $jabatan['name']??'' }}</td>
                        <td>{{ $jabatan['time_in']??'' }}</td>
                        <td>{{ $jabatan['time_out']??'' }}</td>
                        <td>{{ $jabatan['work_time']??0 }}</td>
                        <td>{{ $jabatan['daily_report']??'' }}</td>
                        <td>{{ $jabatan['daily_visit_report']??'' }}</td>
                        <td>{{ $jabatan['absent_without_note']??'' }}</td>
                        <td>{{ $jabatan['absent_with_note']??'' }}</td>
                        <td>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('jabatan.show', $jabatan['id']) }}">Detail</a>
                            </div>
                            <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary"
                                    href="{{ route('jabatan.edit', $jabatan['id']) }}">Edit</a>
                            </div>
                            <div style="display: inline-block">
                                <form action="{{ route('jabatan.destroy', $jabatan['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
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
        ajax: `{{ route('jabatan.ajaxlist') }}`,
        columns: [
        { data: 'name' },
        { data: 'time_in' },
        { data: 'time_out' },
        { data: 'work_time' },
        { data: 'daily_report'},
        { data: 'daily_visit_report'},
        { data: 'absent_without_note'},
        { data: 'absent_with_note'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection