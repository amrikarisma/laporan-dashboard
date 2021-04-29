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
                    <div class="col-md-2">
                        {!! Form::select('cabang', $cabang, $request->cabang??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Cabang')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Jabatan')) !!}
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
                        <a href="{{ route('laporan.kunjungan.export') }}" class="btn btn-success">Export Kunjungan</a>
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
        
                    <table id="table" class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>
                                    {{ _('Judul')}}
                                </th>
                                <th>
                                    {{ _('Lokasi Manual')}}
                                </th>
                                <th>
                                    {{ _('Lokasi GPS')}}
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
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json",
        },
    });
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse:true,
        scrollY:500,
        scrollX:true,
        ajax: {
            url: `{{ route('laporan.kunjungan.ajaxlist') }}`,
            data: {
                "start_date": "{{ $request->input('start')??'' }}",
                "end_date": "{{ $request->input('end')??'' }}",
                "jabatan": "{{ $request->input('jabatan')??'' }}",
                "anggota": "{{ $request->input('anggota')??'' }}",
                "cabang": "{{ $request->input('cabang')??'' }}"
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
        // { 
        //     data: {
        //           _: 'date.display',
        //           sort: 'date.timestamp'
        //        },
        //     name: 'date.timestamp',

        // },
        // { data: 'date' },
        { data: 'laporan_title' },
        { data: 'laporan_location' },
        // { data: 'address' },
        // { 
        //     data: 'laporan_geolocation',
        //     render: function (data, type, full, meta) {
        //         if (type === 'display') {
        //             var arr = data.split(', ');
        //             if(typeof arr[1] != 'undefined') {
        //                 var currentCell = $("#table").DataTable().cells({"row":meta.row, "column":meta.col}).nodes(0);
        //                 var delay = Math.random() * (120000 - 7000) + 7000;
        //                 setTimeout(function() {
        //                     $.ajax({
        //                         type: 'GET',
        //                         url: "https://nominatim.openstreetmap.org/reverse?format=geojson&lat="+arr[0]+"&lon="+arr[1],
        //                         success: function (x) {
        //                                 console.log( x['features'][0]['properties']['display_name']);
        //                                 $(currentCell).text(x['features'][0]['properties']['display_name']);
        //                         },
        //                         error: function (jqXHR) {
        //                             console.log(jqXHR)
        //                         }
        //                     });
        //                 }, delay);
        //             }
        //         }

        //         return data;
        //     }, 
        // },
        { data: 'laporan_address_geo' },
        { data: 'created_at'},
        { data: 'user.name'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection