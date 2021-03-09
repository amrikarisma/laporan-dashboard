@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-3">
        <div class="img-thumbnail">
        <img src="{{ $anggota['user']['userdata']['profile_photo_url'] ?? asset('image/avatar-no-image.png') }}"  class="img-fluid"/>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Data Diri</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td>{{ 'Nama Panggilan' }}</td>
                            <td>{{ $anggota['user']['userdata']['nick_name']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Tempat Lahir' }}</td>
                            <td>{{ $anggota['user']['userdata']['place_of_birth']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Tanggal Lahir' }}</td>
                            <td>{{ \Carbon\Carbon::parse($anggota['user']['userdata']['birthday'])->locale('id_ID')->isoFormat('D MMMM Y')??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Alamat' }}</td>
                            <td>{{ $anggota['user']['userdata']['address']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'No. Kartu Tanda Penduduk' }}</td>
                            <td>{{ $anggota['user']['userdata']['national_id']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'No. Surat Ijin Mengemudi' }}</td>
                            <td>{{ $anggota['user']['userdata']['license_id']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Status Pernikahan' }}</td>
                            <td>{{ $anggota['user']['userdata']['marriage']??'' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Data Keanggotaan</h3>
                </div>
            </div>
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
    </div>
</div>
@endsection