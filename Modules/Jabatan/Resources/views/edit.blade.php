@extends('adminlte::page')

@section('content')
<form action="{{ route('jabatan.update', $jabatan['id'] ) }}" method="POST" class="form-horizontal needs-validation" novalidate>
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Edit Jabatan</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            <div class="form-group row">
                {!! Form::label('jabatan_parent', 'Jabatan Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('jabatan_parent', $jabatan_parent , $jabatan['parent']['id']??null, array( 'class' => 'form-control', 'placeholder' => 'Jabatan Diatasnya') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $jabatan['name'], array( 'class' => 'form-control', 'placeholder' => 'Nama', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('time_in', 'Jam Masuk',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('time_in', $jabatan['time_in'], array( 'class' => 'form-control', 'placeholder' => 'Jam Masuk', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('time_out', 'Jam Keluar',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('time_out', $jabatan['time_out'] , array( 'class' => 'form-control', 'placeholder' => 'Jam Keluar', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('daily_report', 'Laporan Harian Wajib',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('daily_report', $jabatan['daily_report'] , array( 'class' => 'form-control', 'placeholder' => 'Laporan Harian Wajib', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('daily_visit_report', 'Laporan Kunjungan Harian Wajib',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('daily_visit_report', $jabatan['daily_visit_report'] , array( 'class' => 'form-control', 'placeholder' => 'Laporan Kunjungan Harian Wajib', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('absent_without_note', 'Toleransi Presensi Tanpa Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('absent_without_note', $jabatan['absent_without_note'] , array( 'class' => 'form-control', 'placeholder' => 'Toleransi Presensi Tanpa Keterangan', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('absent_with_note', 'Toleransi Presensi Dengan Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('absent_with_note', $jabatan['absent_with_note'] , array( 'class' => 'form-control', 'placeholder' => 'Toleransi Presensi Dengan Keterangan', 'required') ) !!}
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
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();
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
                end_time = end.format('HH:mm:ss');
                console.log(start_time, end_time);
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide(); //Hide calendar
            });
    });
    </script>
@endsection