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
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nilai Kedisiplinan (Jam Masuk dan Jam Keluar)</td>
                    </tr>
                    <tr>
                        <td>Nilai Akurasi Lokasi (Aktif/Tidak GPS)</td>
                    </tr>
                    <tr>
                        <td>Nilai Bobot Kegiatan (jumlah kegiatan)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection