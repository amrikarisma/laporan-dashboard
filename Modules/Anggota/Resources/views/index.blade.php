@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Data Anggota</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('anggota.create') }}">Tambah</a>
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
                            {{ _('Jabatan')}}
                        </th>
                        <th>
                            {{ _('Divisi')}}
                        </th>
                        <th>
                            {{ _('Unit Cabang')}}
                        </th>
                        <th>
                            {{ _('Tanggal Bergabung')}}
                        </th>
                        <th>
                            {{ _('SK Pengangkatan')}}
                        </th>
                        <th>
                            {{ _('NIK')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotas as $anggota)
                    <tr>
                        <td>{{ $anggota['user']['name'] }}</td>
                        <td>{{ $anggota['jabatan']['name'] }}</td>
                        <td>{{ $anggota['divisi']['name'] }}</td>
                        <td>{{ $anggota['cabang']['name'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($anggota['join_date'])->locale('id_ID')->isoFormat('D MMMM Y')??'' }}</td>
                        <td>{{ $anggota['sk_pengangkatan'] }}</td>
                        <td>{{ $anggota['nik'] }}</td>
                        <td>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('anggota.show', $anggota['id']) }}">Detail</a>
                            </div>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary"
                                href="{{ route('anggota.edit', $anggota['id']) }}">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
