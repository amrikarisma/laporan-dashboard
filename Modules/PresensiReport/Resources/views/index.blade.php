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
                    <div class="col-md-3">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                        {{-- {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!} --}}
                    </div>
                    <div class="col-md-3">
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
                            @foreach ($absents as $absent)
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript"> 


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        let array = ['Tanggal', 'DD (Dinas Dalam)', 'DL (Dinas Luar)','BP Dim (Bawa Perintah)', 'BP Luar Dim', 'Satgas', 'Siaga', 'LF (Luar Formasi)'];
        let entry = [
            ['Kategori Presensi', 'Jumlah Anggota'],
        ];

        for (let index = 1; index < array.length; index++) {
            entry.push([array[index], Math.floor(Math.random() * 500) ]);
        }

        console.log(entry);

        var data = google.visualization.arrayToDataTable(entry);

        var options = {
            title: 'Grafik Kategori Presensi Anggota',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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