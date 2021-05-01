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
            <table id="table" class="table table-hover dataTable dtr-inline">
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
        // scrollCollapse:true,
        // scrollY:500,
        // scrollX:true,
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