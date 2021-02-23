@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Indikator Nilai Akurasi Lokasi</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('akurasilokasi.create') }}">Tambah</a>
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
                    @foreach ($akurasilokasis as $akurasilokasi)
                        <tr>
                            <td>{{ $akurasilokasi['name'] }}</td>
                            <td>{{ $akurasilokasi['logic'] }} {{ $akurasilokasi['param'] }}</td>
                            <td>{{ $akurasilokasi['score'] }}</td>
                            <td>{{ $akurasilokasi['note'] }}</td>
                            <td>{!! $akurasilokasi['status'] == 'Aktif' ? '<span class="badge badge-success">'. $akurasilokasi['status'] .'</span>' : '<span class="badge badge-danger">'. $akurasilokasi['status'] .'</span>'  !!}</td>
                            <td>
                                {{-- <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('akurasilokasi.show', $akurasilokasi['id']) }}">Detail</a>
                                </div> --}}
                                <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('akurasilokasi.edit', $akurasilokasi['id']) }}">Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{ route('akurasilokasi.destroy', $akurasilokasi['id']) }}" method="post">
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