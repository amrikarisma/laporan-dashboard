@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>History Anggota</h4>

        </div>
        <div class="card-body">

            <div id='map'></div>

        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <style>
        #map {
			width: 100%;
			height: 500px;
		}
    </style>
@endsection
@section('js')

    <script>
        $(function(){
            var map = L.map('map').setView([-7.75913, 110.414314], 13);
        
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
        
                var LeafIcon = L.Icon.extend({
                    options: {
                        shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                        iconSize:     [38, 95],
                        shadowSize:   [50, 64],
                        iconAnchor:   [22, 94],
                        shadowAnchor: [4, 62],
                        popupAnchor:  [-3, -76]
                    }
                });
        
                var greenIcon = new LeafIcon({iconUrl: '{{ asset('image/tentara.png') }}'}),
                    redIcon = new LeafIcon({iconUrl: '{{ asset('image/tentara.png') }}'}),
                    orangeIcon = new LeafIcon({iconUrl: '{{ asset('image/tentara.png') }}'});
        
                L.marker([-7.748591, 110.386664], {icon: greenIcon}).bindPopup("I am a green leaf.").addTo(map);
                L.marker([-7.759130, 110.414314], {icon: redIcon}).bindPopup("I am a red leaf.").addTo(map);
                L.marker([-7.759452, 110.418285], {icon: orangeIcon}).bindPopup("I am an orange leaf.").addTo(map);
        });
    </script>
@endsection