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
                        {!! Form::date('date', $request->date??'' ,array('class' => 'form-control', 'placeholder' => 'Filter Tanggal')) !!}
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
    
            <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

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
@endsection

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
        let array = [
            ['Tanggal', 'DD (Dinas Dalam)', 'DL (Dinas Luar)','BP Dim (Bawa Perintah)', 'BP Luar Dim', 'Satgas', 'Siaga', 'LF (Luar Formasi)']
        ];
      for (let index = 1; index <= 7; index++) {
        array.push([index, Math.floor(Math.random() * 500), Math.floor(Math.random() * 500), Math.floor(Math.random() * 500), Math.floor(Math.random() * 500), Math.floor(Math.random() * 500), Math.floor(Math.random() * 500), Math.floor(Math.random() * 500)]);
      }
      console.log(array);
    var data = google.visualization.arrayToDataTable(array);

    var options = {
      chart: {
        title: 'Grafik Performa Presensi Anggota',
        subtitle: 'Performa presensi anggota selama 7 hari terakhir',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
@endsection