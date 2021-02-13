@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detail Jabatan</h3>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Jabatan Diatasnya' }}</td>
                        <td>:</td>
                        <td>{{ $jabatan['parent']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Nama' }}</td>
                        <td>:</td>
                        <td>{{ $jabatan['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Masuk' }}</td>
                        <td>:</td>
                        <td>{{ $jabatan['time_in']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Keluar' }}</td>
                        <td>:</td>
                        <td>{{ $jabatan['time_out']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Kerja' }}</td>
                        <td>:</td>
                        <td>{{ $jabatan['work_time']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ _('Laporan Harian Wajib')}}</td>
                        <td>:</td>
                        <td>{{ $jabatan['daily_report']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ _('Laporan Kunjungan Harian Wajib')}}</td>
                        <td>:</td>
                        <td>{{ $jabatan['daily_visit_report']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ _('Toleransi Presensi tanpa Keterangan')}}</td>
                        <td>:</td>
                        <td>{{ $jabatan['absent_without_note']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ _('Toleransi Presensi dengan Keterangan')}}</td>
                        <td>:</td>
                        <td>{{ $jabatan['absent_with_note']??'' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection