@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Divisi</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('divisi.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Nama')}}
                        </th>
                        <th>
                            {{ _('Status')}}
                        </th>

                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($divisis['data'] as $divisi)
                    <tr>
                        <td>{{ $divisi['name']??'' }}</td>
                        <td>{!! $divisi['status'] == 'Aktif' ? '<span class="badge badge-success">'. $divisi['status'] .'</span>' : '<span class="badge badge-danger">'. $divisi['status'] .'</span>'  !!}</td>
                        <td>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('divisi.show', $divisi['id']) }}">Detail</a>
                            </div>
                            <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary"
                                    href="{{ route('divisi.edit', $divisi['id']) }}">Edit</a>
                            </div>
                            <div style="display: inline-block">
                                <form action="{{ route('divisi.destroy', $divisi['id']) }}" method="post">
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
@section('plugins.Sweetalert2', true)
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
        ajax: `{{ route('divisi.ajaxlist') }}`,
        columns: [
        { data: 'name' },
        { data: 'status' },
        { data: 'actions'},
    ]
    });
    $('#table').on('click','.btn-delete', function(e) {
        let $form = $(this).closest('form');
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#2ecc71',
            confirmButtonText: 'Ya, Saya yakin!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            console.log(result);
            if (result.value) {
                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // )
                $form.submit();
            }
        });
    });
    </script>
@endsection