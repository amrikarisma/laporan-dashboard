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
                    <div class="col-md-2">
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Jabatan')) !!}
                    </div>
                    <div class="col-md-4">
                        <div id="reportrange" style="display:flex; justify-content:space-between; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <span style="align-self: center"><i class="fa fa-calendar"></i>&nbsp;</span>
                            <span id="showdate"></span>
                            <input type="hidden" name="start" value="{{ $request->start??''}}">
                            <input type="hidden" name="end" value="{{ $request->end??''}}">
                            <span style="align-self:center" ><i class="fa fa-caret-down"></i></span> 
                        </div>
                        {{-- {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!} --}}
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-md-auto">
                        <a href="{{ route('history.export') }}" class="btn btn-success">Export History GPS</a>
                    </div>
                </div>
            </form>
            <div id='map'></div>

        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
        }
    </style>
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
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function(){
            $('.select2').select2();
            var param = {
                'start_date' : @json($request->start),
                'end_date' : @json($request->end),
                'anggota' : @json($request->anggota),
            }
            console.log(param);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: `{{ route('history.location') }}`,
                data: param,
                success: function(result){
                    if(typeof result[0] != 'undefined') {
                        var viewmap = result[0].pin.split(',');
                        var map = L.map('map').setView([viewmap[0], viewmap[1]], 13);
                    
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
                                popupAnchor:  [-3, -76]
                            }
                        });
                
                        var greenIcon = new LeafIcon({iconUrl: `{{ asset('image/logo-sikumbang.png') }}`});
                
                        result.forEach(el => {
                            var split = el.pin.split(',');
                            console.log(split)
        
                            L.marker([split[0],split[1]], {icon: greenIcon}).bindPopup(el.user.name).addTo(map);
                        });
                    } else {
                        $('#map').html('Tidak ada map ditemukan.');
                    }
                }
            });
            
            // L.marker([-7.759130, 110.414314], {icon: greenIcon}).bindPopup("I am a red leaf.").addTo(map);
            // L.marker([-7.759452, 110.418285], {icon: greenIcon}).bindPopup("I am an orange leaf.").addTo(map);
        });
        $(function() {

            var start = $('[name=start]').val() != '' ? moment($('[name=start]').val()) : moment().startOf('month');
            var end = $('[name=end]').val() != '' ? moment($('[name=end]').val()) : moment().endOf('month');

            function cb(start, end) {
                $('#showdate').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('[name=start]').val(start.format('YYYY-MM-DD'));
                $('[name=end]').val(end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    </script>
@endsection