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
            <table class="table">
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
                    @foreach ($divisis['data'] as $divisi)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection