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
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Nama')}}
                        </th>
                        <th>
                            {{ _('Logic')}}
                        </th>
                        <th>
                            {{ _('Nilai')}}
                        </th>
                        <th>
                            {{ _('Keterangan')}}
                        </th>
                        <th>
                            {{ _('Status')}}
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($broadcasts as $broadcast)
                        <tr>
                            <td>{{ $broadcast['name'] }}</td>
                            <td>{{ $broadcast['logic'] }} {{ $broadcast['param'] }}</td>
                            <td>{{ $broadcast['score'] }}</td>
                            <td>{{ $broadcast['note'] }}</td>
                            <td>{!! $broadcast['status'] == 'Aktif' ? '<span class="badge badge-success">'. $broadcast['status'] .'</span>' : '<span class="badge badge-danger">'. $broadcast['status'] .'</span>'  !!}</td>
                            <td>
                                {{-- <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('broadcast.show', $broadcast['id']) }}">Detail</a>
                                </div> --}}
                                <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('broadcast.edit', $broadcast['id']) }}">Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{ route('broadcast.destroy', $broadcast['id']) }}" method="post">
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