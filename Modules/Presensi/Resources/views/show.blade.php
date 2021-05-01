@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detail Presensi</h3>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Tanggal' }}</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($absent['date'])->isoFormat('dddd, D MMMM Y')??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Nama' }}</td>
                        <td>:</td>
                        <td>{{ $absent['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Masuk' }}</td>
                        <td>:</td>
                        <td>{{ $absent['time_in']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Jam Keluar' }}</td>
                        <td>:</td>
                        <td>{{ $absent['time_out']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Total Jam Kerja' }}</td>
                        <td>:</td>
                        <td>{{ $absent['work_time']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Lokasi Presensi Masuk' }}</td>
                        <td>:</td>
                        <td id="loc_0"><a target="_blank" href="https://www.google.com/maps/place/{{ $absent['geolocation_in']??'' }}"> ({{ $absent['geolocation_in']??'' }})</a></td>
                    </tr>
                    <tr>
                        <td>{{ 'Lokasi Presensi Keluar' }}</td>
                        <td>:</td>
                        <td id="loc_1"><a target="_blank" href="https://www.google.com/maps/place/{{ $absent['geolocation_out']??'' }}"> ({{ $absent['geolocation_out']??'' }})</a></td>
                    </tr>
                    <tr>
                        <td>{{ 'Keterangan' }}</td>
                        <td>:</td>
                        <td>{{ $absent['category']['name']??'' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('presensi::maps');


@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <style>
        #mapMasuk, #mapKeluar {
			width: 100%;
			height: 500px;
		}
    </style>
@endsection
@section('js')
    <script>
        $(function(){
            var map = L.map('mapMasuk').setView([{{ $absent['geolocation_in'] }}], 13);
        
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
        
                var LeafIcon = L.Icon.extend({
                    options: {
                        shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                        iconSize:     [38, 38],
                        shadowSize:   [30, 30],
                        iconAnchor:   [22, 94],
                        shadowAnchor: [4, 62],
                        popupAnchor:  [-3, -76],
                    }
                });
                var masuk = new LeafIcon({iconUrl: '{{ asset('image/logo-sikumbang.png') }}'})
                var keluar = new LeafIcon({iconUrl: '{{ asset('image/logo-sikumbang.png') }}'})
        
                L.marker([{{ $absent['geolocation_in'] }}], {icon: masuk}).bindPopup("{{ $absent['user']['name']??'' }} Masuk<br />Jam {{ $absent['time_in']??'' }}").addTo(map);
                L.marker([{{ $absent['geolocation_out'] }}], {icon: keluar}).bindPopup("{{ $absent['user']['name']??'' }} Keluar<br />Jam {{ $absent['time_in']??'' }}").addTo(map);
        });
        $(function () {
            var loc = [
                @json($absent['geolocation_in']),
                @json($absent['geolocation_out'])
            ]
             loc.forEach(getAddress);
             function getAddress(geo, index) {
                 var arr = geo.split(', ');
                 if(typeof arr[1] != 'undefined') {
                     $.ajax({
                         type: 'GET',
                         url: "https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+arr[0]+"&lon="+arr[1],
                         success: function (x) {
                             console.log( x['features'][0]['properties']['display_name']);
                             $('#loc_'+index).prepend(x['features'][0]['properties']['display_name']);
                         },
                         error: function (jqXHR) {
                             console.log(jqXHR)
                         }
                     });
                 }
             }
        });
    </script>
@endsection