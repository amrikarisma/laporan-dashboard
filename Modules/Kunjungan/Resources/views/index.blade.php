@extends('adminlte::page')

@section('content')
    <h1>Laporan Kunjungan</h1>
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <input type="date" name="date" class="form-control"/>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            {{ _('Judul')}}
                        </th>
                        <th>
                            {{ _('Deskripsi')}}
                        </th>
                        <th>
                            {{ _('Lokasi')}}
                        </th>
                        <th>
                            {{ _('Performa')}}
                        </th>
                        <th>
                            {{ _('Kategori')}}
                        </th>
                        <th>
                            {{ _('Tanggal Laporan')}}
                        </th>
                        <th>
                            {{ _('Pengirim')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>{{ $kunjungan['laporan_title'] }}</td>
                        <td>{{ $kunjungan['laporan_description'] }}</td>
                        <td>{{ $kunjungan['laporan_geolocation'] }}</td>
                        <td>{{ $kunjungan['laporan_performance'] }}</td>
                        <td>{{ $kunjungan['laporan_category'] }}</td>
                        <td>{{ $kunjungan['created_at'] }}</td>
                        <td>{{ $kunjungan['user']['name'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
