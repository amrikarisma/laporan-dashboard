@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>History Anggota</h4>

        </div>
        <div class="card-body">
            <form action="" method="GET" class="form-horizontal">
                {{-- @csrf --}}
                <div class="form-group row">
                    <div class="col-md-3">
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control', 'placeholder' => 'Filter Jabatan')) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!}
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
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
            $.ajax({url: `{{ route('history.location') }}`, success: function(result){
                var viewmap = result[0].pin.split(',');
                var map = L.map('map').setView([viewmap[0], viewmap[1]], 13);
            
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
        
                var greenIcon = new LeafIcon({iconUrl: `{{ asset('image/tentara.png') }}`});
        
                result.forEach(el => {
                    var split = el.pin.split(',');
                    console.log(split)

                    L.marker([split[0],split[1]], {icon: greenIcon}).bindPopup(el.user.name).addTo(map);
                });
      
            }});
            
            // L.marker([-7.759130, 110.414314], {icon: greenIcon}).bindPopup("I am a red leaf.").addTo(map);
            // L.marker([-7.759452, 110.418285], {icon: greenIcon}).bindPopup("I am an orange leaf.").addTo(map);
        });
    </script>
@endsection