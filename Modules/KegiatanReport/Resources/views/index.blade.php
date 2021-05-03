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
                    <div class="col-md-2 order-md-1">
                        {!! Form::select('cabang', $cabang, $request->cabang??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Cabang')) !!}
                    </div>
                    <div class="col-md-2 order-md-2" >
                        {!! Form::select('anggota', $anggota, $request->anggota??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Anggota')) !!}
                    </div>
                    <div class="col-md-2 order-md-3">
                        {!! Form::select('jabatan', $jabatan, $request->jabatan??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Jabatan')) !!}
                    </div>
                    <div class="col-md-2 order-md-8">
                        {!! Form::select('divisi', $divisi, $request->divisi??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Divisi')) !!}
                    </div>
                    <div class="col-md-2 order-md-9">
                        {!! Form::select('category', $categories, $request->category??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Kategori')) !!}
                    </div>
                    <div class="col-md-2 order-md-10">
                        {!! Form::select('branch', $branch, $request->branch??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Level')) !!}
                    </div>
                    <div class="col-md-3 order-md-4">
                        <div id="reportrange" style="display:flex; justify-content:space-between; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <span style="align-self: center"><i class="fa fa-calendar"></i>&nbsp;</span>
                            <span id="showdate"></span>
                            <input type="hidden" name="start" value="{{ $request->start??''}}">
                            <input type="hidden" name="end" value="{{ $request->end??''}}">
                            <span style="align-self:center" ><i class="fa fa-caret-down"></i></span> 
                        </div>
                        {{-- {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!} --}}
                    </div>


                    <div class="col-md-2 order-md-5 mb-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-md-2 order-md-11" >
                        <a href="{{ route('laporan.kegiatan.export') }}" class="btn btn-success">Export Laporan</a>
                    </div>
                    <div class="col-md-2 order-md-12">
                        <a href="{{ route('laporan.kegiatan.export') .'?simple=1' }}" class="btn btn-success">Export Resume</a>
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
                    <table id="table" class="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>
                                    {{ _('Tanggal')}}
                                </th>
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
                                    {{ _('Usulan')}}
                                </th>
                                <th>
                                    {{ _('Lokasi Laporan')}}
                                </th>
                                <th>
                                    {{ _('Lokasi dari GPS')}}
                                </th>
                                <th>
                                    {{ _('Performa (Jumlah laporan)')}}
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
                            {{-- @foreach ($kegiatans['data']['data']??[] as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan['laporan_title']??'Loading' }}</td>
                                <td>{{ $kegiatan['category']['title']??'Tidak Ada Kategori' }}</td>
                                <td>{{ strip_tags(Str::limit($kegiatan['laporan_description'],20) ) }}</td>
                                <td>{{ $kegiatan['laporan_location']??'' }}</td>
                                <td><a id="{{$loop->index}}" target="_blank" href="https://www.google.com/maps/place/{{ $kunjungan['laporan_geolocation']??'' }}">{{ $kunjungan['laporan_geolocation']??'' }}</a></td>
                                <td>{{ $kegiatan['laporan_performance']??'' }}</td>
                                <td>{{ $kegiatan['created_at'] ? \Carbon\Carbon::parse($kegiatan['created_at'])->isoFormat('dddd, D MMMM Y')??'' : ''}}</td>
                                <td>{{ $kegiatan['user']['name']??'' }}</td>
                                <td>{{ $kegiatan['status']??''}}</td>
                                <td>
                                    <a class="btn btn-primary"
                                    href="{{ route('laporan.kegiatan.show', $kegiatan['id']) }}">Detail</a>
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
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
@section('plugins.Charts', true)
@section('plugins.Select2', true)
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
    }
</style>
@endsection
@section('js')

<script type="text/javascript"> 
    $('.select2').select2();

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
            url: `{{ route('laporan.kegiatan.ajaxlist') }}`,
            data: {
                "start_date": "{{ $request->input('start')??'' }}",
                "end_date": "{{ $request->input('end')??'' }}",
                "jabatan": "{{ $request->input('jabatan')??'' }}",
                "anggota": "{{ $request->input('anggota')??'' }}",
                "cabang": "{{ $request->input('cabang')??'' }}",
                "divisi": "{{ $request->input('divisi')??'' }}",
                "category": "{{ $request->input('category')??'' }}",
                "branch": "{{ $request->input('branch')??'' }}",
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
        // { data: 'date' },
        { data: 'laporan_title' },
        { data: 'category.name' },
        { data: 'laporan_description' },
        { data: 'recommendation' },
        { data: 'laporan_location' },
        { data: 'laporan_address_geo' },
        { data: 'laporan_performance.persentase'},
        // { data: 'created_at'},
        { data: 'user.name'},
        { data: 'status'},
        { data: 'actions'},
    ]
    });
    </script>
@endsection