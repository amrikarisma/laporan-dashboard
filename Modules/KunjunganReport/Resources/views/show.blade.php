@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail Kunjungan</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Tanggal' }}</td>
                        <td>{{ !empty($kunjungan['created_at']) ? \Carbon\Carbon::parse($kunjungan['created_at'])->isoFormat('dddd, D MMMM Y') : '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Nama' }}</td>
                        <td>{{ $kunjungan['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Kategori' }}</td>
                        <td>{{ isset($kunjungan['category']['title']) ? $kunjungan['category']['title'] : 'Tidak ada kategori' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Judul' }}</td>
                        <td>{{ $kunjungan['laporan_title']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Deskripsi' }}</td>
                        <td>{!! $kunjungan['laporan_description']??'' !!}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Lokasi Laporan' }}</td>
                        <td>{{ $kunjungan['laporan_location']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Alamat dari GPS' }}</td>
                        <td><a data-toggle="tooltip" data-placement="top" title="Tooltip on top" target="_blank" href="https://www.google.com/maps/place/{{ $kunjungan['laporan_geolocation']??'' }}">{{ $kunjungan['laporan_address_geo']??'' }}</a></td>
                    </tr>
                    <tr>
                        <td>{{ 'Performa' }}</td>
                        <td>{{ $kunjungan['laporan_performance']['laporan_performance']??0 }}%</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Foto Kunjungan</h4>
        </div>
        <div class="card-body">
            
            <div class="row">
                @foreach ($kunjungan['image']??[] as $image)
                    <div class="col-lg-2 col-6">
                        <a href="{{ $image['image_url'] }}" data-toggle="lightbox" data-gallery="example-gallery">
                            <img class="img-thumbnail" width="280px" src="{{ $image['image_url'] }}" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection