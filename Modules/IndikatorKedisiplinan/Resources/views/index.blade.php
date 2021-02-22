@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Indikator Nilai</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('jabatan.create') }}">Tambah</a>
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
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kedisiplinans as $kedisiplinan)
                        <tr>
                            <td>{{ $kedisiplinan['name'] }}</td>
                            <td>{{ $kedisiplinan['param1'] }} {{ $kedisiplinan['logic'] }} {{ $kedisiplinan['param2'] }}</td>
                            <td>{{ $kedisiplinan['score'] }}</td>
                            <td>
                                <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('kedisiplinan.show', $kedisiplinan['id']) }}">Detail</a>
                                </div>
                                <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('kedisiplinan.edit', $kedisiplinan['id']) }}">Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{ route('kedisiplinan.destroy', $kedisiplinan['id']) }}" method="post">
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