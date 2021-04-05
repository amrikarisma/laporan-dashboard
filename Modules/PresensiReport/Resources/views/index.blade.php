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
                    <div class="col-md-2">
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Jabatan')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('hadir', $hadir, $request->hadir??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Kehadiran')) !!}
                    </div>
                    <div class="col-md-3">
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
                        <a href="{{ route('laporan.presensi.export') }}" class="btn btn-success">Export Presensi</a>
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
                    <table id="table" class="table" style="width: 100%">
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
                                    {{ _('Lokasi Masuk')}}
                                </th>
                                <th>
                                    {{ _('Lokasi Keluar')}}
                                </th>
                                <th>
                                    {{ _('Kategori')}}
                                </th>
                                <th>
                                    {{ _('Skor')}}
                                </th>
                                <th>
                                    {{ _('Status Presensi')}}
                                </th>
                                <th>
                                    {{ _('Status Jam Kerja')}}
                                </th>
                                <th>
                                    {{ _('Tidak Hadir Dengan Keterangan (Bulan ini)')}}
                                </th>
                                <th>
                                    {{ _('Tidak Hadir Tanpa Keterangan (Bulan ini)')}}
                                </th>
                                <th>
                                    {{ _('Keterangan')}}
                                </th>
                                <th>{{ _('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @foreach ($absents['data'] as $absent)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($absent['date'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                                <td><a href="{{ route('laporan.presensi.show', $absent['user']['anggota']['id']) }}">{{ $absent['user']['name']??'' }}</a></td>
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

        var start = $('[name=start]').val() != '' ? moment($('[name=start]').val()) : moment().startOf('month');
        var end = $('[name=end]').val() != '' ? moment($('[name=end]').val()) : moment().endOf('month');

        function cb(start, end) {
            $('#showdate').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('[name=start]').val(start.format('YYYY-MM-DD'));
            $('[name=end]').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: '+1m',
            maxDate: moment(start, 'YYYY-MM-DD').add(90, 'days'),
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
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
    $('#table').DataTable({
        searchDelay:350,
        processing: true,
        serverSide: true,
        scrollCollapse:true,
        scrollY:500,
        scrollX:true,
        ajax: {
            url: `{{ route('laporan.presensi.ajaxlist') }}`,
            data: {
                "start_date": "{{ $request->input('start')??'' }}",
                "end_date": "{{ $request->input('end')??'' }}",
                "jabatan": "{{ $request->input('jabatan')??'' }}",
                "anggota": "{{ $request->input('anggota')??'' }}",
                "hadir": "{{ $request->input('hadir')??'' }}"
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
        { 
            data: {
                  _: 'date.display',
                  sort: 'date.timestamp'
               },
            name: 'date.timestamp',

        },
        // { data: 'date' },
        { data: 'user.name' },
        { data: 'time_in' },
        { data: 'time_out' },
        { data: 'work_time' },
        { data: 'geolocation_in'},
        { data: 'geolocation_out'},
        { data: 'category.name'},
        { data: 'score'},
        { data: 'status_presensi.status_presensi_masuk'},
        { data: 'status_presensi.status_presensi_worktime'},
        { data: 'no_present.with_note.text'},
        { data: 'no_present.without_note.text'},
        { data: 'note'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection