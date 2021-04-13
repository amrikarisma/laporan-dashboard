@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Kunjungan</h3>
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
                    <div class="col-md-4">
                        <div id="reportrange" style="display:flex; justify-content:space-between; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <span style="align-self: center"><i class="fa fa-calendar"></i>&nbsp;</span>
                            <span id="showdate"></span>
                            <input type="hidden" name="start">
                            <input type="hidden" name="end">
                            <span style="align-self:center" ><i class="fa fa-caret-down"></i></span> 
                        </div>
                        {{-- {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!} --}}
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
            
                    <div id="piechart" style="width: 100%; height: 500px;"></div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tabel Laporan Kunjungan</h5>
                </div>
                <div class="card-body">
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    {{ _('Judul')}}
                                </th>
                                <th>
                                    {{ _('Kategori')}}
                                </th>
                                <th>
                                    {{ _('Deskripsi')}}
                                </th>
                                <th>
                                    {{ _('Lokasi Laporan')}}
                                </th>
                                <th>
                                    {{ _('Lokasi GPS')}}
                                </th>
                                <th>
                                    {{ _('Performa')}}
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
                            @foreach ($kunjungans['data']['data']??[] as $kunjungan)
                            
                            <tr>
                                <td>{{ $kunjungan['laporan_title'] }}</td>
                                <td>{{ $kunjungan['category']['title']??'Tidak Ada Kategori' }}</td>
                                <td>{{ strip_tags(Str::limit($kunjungan['laporan_description'],20) ) }}</td>
                                <td>{{ $kunjungan['laporan_location'] }}</td>
                                <td><a id="{{$loop->index}}" target="_blank" href="https://www.google.com/maps/place/{{ $kunjungan['laporan_geolocation']??'' }}">{{ $kunjungan['laporan_geolocation']??'' }}</a></td>
                                <td>{{ $kunjungan['laporan_performance'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($kunjungan['created_at'])->isoFormat('dddd, D MMMM Y')??'' }}</td>
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
        </div>
    </div>

@endsection

@section('js')
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
@section('plugins.Charts', true)

<script type="text/javascript"> 
    $(function () {
        var location =  @json($location);
        let i = 0;
        location.forEach(el => {
            var loc = el.split(', ');
            console.log(loc[1])
            if( typeof loc[1] != 'undefined') {
                $.get( "https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+loc[0]+"&lon="+loc[1], function( data ) {
                    console.log(data['features'][0]['properties']['display_name']);
                    $('#'+i).tooltip({
                        delay: 500,
                        placement: "top",
                        title: data['features'][0]['properties']['display_name'],
                        html: true
                    }); 
                });
            }
            i++;
        });
    })
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    

    function drawChart() {

        let param = {
            ajax : true,
        }

        let entry = [
                ['Kategori Kunjungan', 'Jumlah Anggota'],
            ];

        let countJson = @json($kunjungans['count']);

        $.each(countJson, function(index, element) {
            entry.push([index, element ]);
        });

        var data = google.visualization.arrayToDataTable(entry);

        var options = {
            title: 'Grafik Kategori Kunjungan Anggota',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
            
    }

    $(function() {
        moment.locale('id');
        var start = moment().startOf('month');
        var end = moment().endOf('month');

        function cb(start, end) {
            $('#showdate').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('[name=start]').val(start.format('YYYY-MM-DD'));
            $('[name=end]').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Hari ini': [moment(), moment()],
            'Kamrin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
            '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan sebelumnya': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                customRangeLabel : "Pilih Manual"
            }
        }, cb);

        cb(start, end);

    });
</script>
@endsection