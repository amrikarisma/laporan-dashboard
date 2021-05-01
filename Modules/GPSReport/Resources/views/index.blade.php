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
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control select2' , 'placeholder' => 'Filter Jabatan')) !!}
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
                        <a href="{{ route('laporan.gps.export') }}" class="btn btn-success">Export Laporan GPS</a>
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
                    <h5>Tabel Laporan Aktivitas GPS</h5>
                </div>
                <div class="card-body">
                    <table id="table" class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>
                                    {{ _('Tanggal')}}
                                </th>
                                <th>
                                    {{ _('Nama')}}
                                </th>
                                <th>
                                    {{ _('Jabatan')}}
                                </th>
                                <th>
                                    {{ _('Jumlah Aktivitas GPS')}}
                                </th>
                                <th>
                                    {{ _('Nilai')}}
                                </th>
                                <th>
                                    {{ _('Keterangan Nilai')}}
                                </th>
                                <th>{{ _('')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td></td>
                            </tr> --}}
                            {{-- @foreach ($gpsReport as $gps)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($gps['created_at'])->isoFormat('dddd, D MMMM Y')??'' }}</td>
                                <td>{{ $gps['name']??'' }}</td>
                                <td><a href="{{ route('history.index') }}">{{ $gps['gps_activity']??0 }}</a></td>
                                <td>{{ $gps['score']??0 }} - {{ $gps['score_text']??'' }}</td>
                                <td>
                                    <div style="display: inline-block">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('laporan.gps.show', $gps['id']) }}">Detail</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
    }
</style>
@endsection
@section('js')
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
@section('plugins.Charts', true)
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript"> 
    $('.select2').select2();

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {

        let param = {
            ajax : true,
        }

        let entry = [
                ['Aktivitas GPS', 'Jumlah Anggota'],
            ];

        let countJson = @json($gpsReport['count']);

        $.each(countJson, function(index, element) {
            entry.push([index, element ]);
        });

        var data = google.visualization.arrayToDataTable(entry);

        var options = {
            title: 'Grafik Aktivitas GPS Anggota',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
            
    }

    $(function() {
        moment.locale('id');
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
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse:true,
        scrollY:500,
        scrollX:true,
        ajax: {
            url: `{{ route('laporan.gps.ajaxlist') }}`,
            data: {
                "start_date": "{{ $request->input('start')??'' }}",
                "end_date": "{{ $request->input('end')??'' }}",
                "jabatan": "{{ $request->input('jabatan')??'' }}",
                "anggota": "{{ $request->input('anggota')??'' }}"
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
        { 
            data: {
                  _: 'created_at.display',
                  sort: 'created_at.timestamp'
               },
            name: 'created_at.timestamp',

        },
        { data: 'user.name'},
        { data: 'user.anggota.jabatan.name'},
        { data: 'gps_activity'},
        { data: 'score'},
        { data: 'score_text'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection