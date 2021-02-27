@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Laporan Presensi</h3>
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
                                    {{ _('Jam Masuk')}}
                                </th>
                                <th>
                                    {{ _('Jam Keluar')}}
                                </th>
                                <th>
                                    {{ _('Jam Kerja')}}
                                </th>
                                <th>
                                    {{ _('Nilai')}}
                                </th>
                                <th>
                                    {{ _('Kategori')}}
                                </th>
                                <th>{{ _('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($absents['data']['data'] as $absent)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($absent['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                                <td>{{ $absent['user']['name']??'' }}</td>
                                <td>{{ $absent['time_in']??'' }}</td>
                                <td>{{ $absent['time_out']??'' }}</td>
                                <td>{{ $absent['work_time']??0 }}</td>
                                <td>{{ $absent['score']??0 }} - {{ $absent['score_text']??'' }}</td>
                                <td>{{ $absent['category']['name']??0 }}</td>
                                <td>
                                    <a class="btn btn-primary"
                                    href="{{ route('presensi.show', $absent['id']) }}">Detail</a>
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
                ['Kategori Presensi', 'Jumlah Anggota'],
            ];

        let countJson = @json($absents['count']);

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