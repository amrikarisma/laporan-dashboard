@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan GPS</h3>
        </div>
        <div class="card-body">
            <form action="" method="GET" class="form-horizontal">
                {{-- @csrf --}}
                <div class="form-group row">
                    <div class="col-md-2">
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control', 'placeholder' => 'Filter Jabatan')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('hadir', $hadir, $request->hadir??'',array('class' => 'form-control', 'placeholder' => 'Filter Kehadiran')) !!}
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
                    <h5>Tabel Laporan Presensi</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    {{ _('Date')}}
                                </th>
                                <th>
                                    {{ _('Nama')}}
                                </th>
                                <th>
                                    {{ _('Jumlah Aktifitas GPS')}}
                                </th>
                                <th>
                                    {{ _('Nilai')}}
                                </th>
                                {{-- <th>{{ _('Action')}}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td></td>
                            </tr> --}}
                            @foreach ($gpsReport['data']['data'] as $gps)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($gps['created_at'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                                <td>{{ $gps['name']??'' }}</td>
                                <td>{{ $gps['gps_activity']??0 }}</td>
                                <td>{{ $gps['score']??0 }} - {{ $gps['score_text']??'' }}</td>
                                {{-- <td>
                                    <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('laporan.gps.show', $gps['id']) }}">Detail</a>
                                    </div>
                                </td> --}}
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
                ['Kategori Presensi', 'Jumlah Anggota'],
            ];

        let countJson = @json($gpsReport['count']);

        $.each(countJson, function(index, element) {
            entry.push([index, element ]);
        });

        var data = google.visualization.arrayToDataTable(entry);

        var options = {
            title: 'Grafik Kategori Presensi Anggota',
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