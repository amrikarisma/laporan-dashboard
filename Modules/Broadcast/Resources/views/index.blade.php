@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Broadcast Pengumuman</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('broadcast.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Tanggal')}}
                        </th>
                        <th>
                            {{ _('Pengirim')}}
                        </th>
                        <th>
                            {{ _('Judul')}}
                        </th>
                        <th>
                            {{ _('Terjadwal')}}
                        </th>
                        <th>
                            {{ _('Status')}}
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($broadcasts['data'] as $broadcast)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($broadcast['created_at'])->isoFormat('DD MMM YYYY') }}</td>
                            <td>{{ $broadcast['user']['name'] }}</td>
                            <td>{{ $broadcast['title'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($broadcast['schedule'])->isoFormat('DD MMM YYYY HH:ss') }}</td>
                            <td>{!! $broadcast['status'] == 'Terkirim' ? '<span class="badge badge-success">'. $broadcast['status'] .'</span>' : '<span class="badge badge-warning">'. $broadcast['status'] .'</span>'  !!}</td>
                            <td>
                                <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('broadcast.show', $broadcast['slug']) }}">Detail</a>
                                </div>
                                <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('broadcast.edit', $broadcast['slug']) }}">Edit</a>
                                </div>
                                @if (\App\MyHelper::hasAccess())
                                    <div style="display: inline-block">
                                        <form action="{{ route('broadcast.destroy', $broadcast['slug']) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty

                    @endforelse --}}
            
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
        ajax: `{{ route('broadcast.ajaxlist') }}`,
        columns: [
        { data: 'created_at' },
        { data: 'user.name' },
        { data: 'title'},
        { data: 'schedule'},
        { data: 'status'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection