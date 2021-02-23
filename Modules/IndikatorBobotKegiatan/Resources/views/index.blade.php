@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Indikator Nilai Bobot Kegiatan</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('bobotkegiatan.create') }}">Tambah</a>
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
                    @foreach ($bobotkegiatans as $bobotkegiatan)
                        <tr>
                            <td>{{ $bobotkegiatan['name'] }}</td>
                            <td>{{ $bobotkegiatan['logic'] }} {{ $bobotkegiatan['param'] }}</td>
                            <td>{{ $bobotkegiatan['score'] }}</td>
                            <td>{{ $bobotkegiatan['note'] }}</td>
                            <td>{!! $bobotkegiatan['status'] == 'Aktif' ? '<span class="badge badge-success">'. $bobotkegiatan['status'] .'</span>' : '<span class="badge badge-danger">'. $bobotkegiatan['status'] .'</span>'  !!}</td>
                            <td>
                                {{-- <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('bobotkegiatan.show', $bobotkegiatan['id']) }}">Detail</a>
                                </div> --}}
                                <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('bobotkegiatan.edit', $bobotkegiatan['id']) }}">Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{ route('bobotkegiatan.destroy', $bobotkegiatan['id']) }}" method="post">
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