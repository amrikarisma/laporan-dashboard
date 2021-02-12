@extends('adminlte::page')

@section('content')
    <h1>Detail Anggota</h1>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Nama' }}</td>
                        <td>{{ $anggota['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jabatan' }}</td>
                        <td>{{ $anggota['jabatan']['name'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Divisi' }}</td>
                        <td>{{ $anggota['divisi']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Unit Cabang' }}</td>
                        <td>{{ $anggota['cabang']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'SK Pengangkatan' }}</td>
                        <td>{{ $anggota['sk_pengangkatan'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'NIK' }}</td>
                        <td>{{ $anggota['nik']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Tanggal Bergabung' }}</td>
                        <td>{{ \Carbon\Carbon::parse($anggota['join_date'])->locale('id_ID')->isoFormat('D MMMM Y')??'' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection