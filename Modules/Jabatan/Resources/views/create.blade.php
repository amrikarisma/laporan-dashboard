@extends('adminlte::page')

@section('content')
<form action="{{ route('jabatan.store') }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            <div class="form-group row">
                {!! Form::label('jabatan_parent', 'Jabatan Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('jabatan_parent', $jabatan_parent ,old('jabatan'), array( 'class' => 'form-control', 'placeholder' => 'Jabatan Diatasnya') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', old('name'), array( 'class' => 'form-control', 'placeholder' => 'Nama') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('time_in', 'Jam Masuk',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('time_in', old('time_in'), array( 'class' => 'form-control', 'placeholder' => 'Jam Masuk') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('time_out', 'Jam Keluar',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('time_out', old('time_out'), array( 'class' => 'form-control', 'placeholder' => 'Jam Keluar') ) !!}
                </div>
            </div>
            {{-- <div class="form-group row">
                {!! Form::label('work_time', 'Jam Kerja',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('work_time', old('work_time'), array( 'class' => 'form-control', 'placeholder' => 'Jam Kerja') ) !!}
                </div>
            </div> --}}
            <div class="form-group row">
                {!! Form::label('daily_report', 'Laporan Harian Wajib',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::number('daily_report', old('daily_report'), array( 'class' => 'form-control', 'placeholder' => 'Laporan Harian Wajib') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('daily_visit_report', 'Laporan Kunjungan Harian Wajib',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::number('daily_visit_report', old('daily_visit_report'), array( 'class' => 'form-control', 'placeholder' => 'Laporan Kunjungan Harian Wajib') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('absent_without_note', 'Toleransi Presensi Tanpa Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::number('absent_without_note', old('absent_without_note'), array( 'class' => 'form-control', 'placeholder' => 'Toleransi Presensi Tanpa Keterangan') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('absent_with_note', 'Toleransi Presensi Dengan Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::number('absent_with_note', old('absent_with_note'), array( 'class' => 'form-control', 'placeholder' => 'Toleransi Presensi Dengan Keterangan') ) !!}
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary"> Kirim</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
<script>
    $(function() {
        $('input[name="time_in"], input[name="time_out"], input[name="work_time"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                datePicker:false,
                locale: {
                    format: 'HH:mm:ss',

                },
                timePicker :true,
                timePicker24Hour:true,
                timePickerSeconds:true
            }, function (start, end, label) { //callback
                start_time = start.format('HH:mm:ss');

                if(start_time == $('input[name="time_in"]').val()) {
                    $('input[name="work_time"]').val()
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide(); //Hide calendar
            });
    });
    </script>
@endsection