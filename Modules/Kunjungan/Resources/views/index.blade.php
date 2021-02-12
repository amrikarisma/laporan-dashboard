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
                        <th>
                            {{ _('')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                    <tr>
                        <td>{{ $kunjungan['laporan_title'] }}</td>
                        <td>{{ strip_tags(Str::limit($kunjungan['laporan_description'],20) ) }}</td>
                        <td>{{ $kunjungan['laporan_geolocation'] }}</td>
                        <td>{{ $kunjungan['laporan_performance'] }}</td>
                        <td>{{ $kunjungan['laporan_category'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($kunjungan['created_at'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                        <td>{{ $kunjungan['user']['name'] }}</td>
                        <td>
                            <a class="btn btn-primary"
                            href="{{ route('kunjungan.show', $kunjungan['id']) }}">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
