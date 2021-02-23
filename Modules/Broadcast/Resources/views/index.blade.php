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
                            {{ _('Tanggal')}}
                        </th>
                        <th>
                            {{ _('Dari')}}
                        </th>
                        <th>
                            {{ _('Kepada')}}
                        </th>
                        <th>
                            {{ _('Judul')}}
                        </th>
                        <th>
                            {{ _('Isi')}}
                        </th>
                        <th>
                            {{ _('Status')}}
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($broadcasts as $broadcast)
                        <tr>
                            <td>{{ $broadcast['name'] }}</td>
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
                    @empty
                    <tr>
                        <td>23 Feb 2021</td>
                        <td>Admin Kodim</td>
                        <td>Anggota Cabang Koramil Sektor 2</td>
                        <td>Pengumuman: Membantu memantau masyarakat</td>
                        <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima, fugiat consequuntur mollitia eius quos nisi, repellendus rerum omnis ipsum dolorum aliquid consequatur voluptate, dolores odit. Quaerat, a? Aperiam, est expedita.</td>
                        <td><span class="badge badge-success">Terkirim</span></td>
                    </tr>
                    @endforelse
            
                </tbody>
            </table>
        </div>
    </div>
@endsection