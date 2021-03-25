@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Kegiatan</h3>
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
                    <div class="col-md-auto">
                        <a href="{{ route('laporan.kegiatan.export') }}" class="btn btn-success">Export Laporan</a>
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
                    <h5>Tabel Laporan Kegiatan</h5>
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
                                    {{ _('Lokasi dari GPS')}}
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
                                    {{ _('Status')}}
                                </th>
                                <th>
                                    {{ _('')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatans['data']['data']??[] as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan['laporan_title'] }}</td>
                                <td>{{ $kegiatan['category']['title']??'Tidak Ada Kategori' }}</td>
                                <td>{{ strip_tags(Str::limit($kegiatan['laporan_description'],20) ) }}</td>
                                <td>{{ $kegiatan['laporan_location'] }}</td>
                                <td><a id="{{$loop->index}}" target="_blank" href="https://www.google.com/maps/place/{{ $kunjungan['laporan_geolocation']??'' }}">{{ $kunjungan['laporan_geolocation']??'' }}</a></td>
                                <td>{{ $kegiatan['laporan_performance'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($kegiatan['created_at'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                                <td>{{ $kegiatan['user']['name'] }}</td>
                                <td>{{ $kegiatan['status']}}</td>
                                <td>
                                    <a class="btn btn-primary"
                                    href="{{ route('laporan.kegiatan.show', $kegiatan['id']) }}">Detail</a>
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

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    

    function drawChart() {

        let param = {
            ajax : true,
        }

        let entry = [
                ['Kategori Kegiatan', 'Jumlah Anggota'],
            ];

        let countJson = @json($kegiatans['count']);

        $.each(countJson, function(index, element) {
            entry.push([index, element ]);
        });

        var data = google.visualization.arrayToDataTable(entry);

        var options = {
            title: 'Grafik Kategori Kegiatan Anggota',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
            
    }

    $(function() {

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