@extends('adminlte::page')

@section('content')
<form action="{{ route('kedisiplinan.store' ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Indikator Kedisiplinan</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name','', array( 'class' => 'form-control', 'placeholder' => 'Nama') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logic', 'Logic',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('logic', $list_logic , $kedisiplinan['logic']??null, array( 'class' => 'form-control', 'placeholder' => 'Pilih Logic') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('param', 'Parameter',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('param', old('param'), array( 'class' => 'form-control', 'placeholder' => 'Parameter') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('score', 'Nilai',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('score', '', array( 'class' => 'form-control', 'placeholder' => 'Nilai') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('note', 'Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('note','', array( 'class' => 'form-control', 'rows' => '2','placeholder' => 'Keterangan') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('status', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('status', ['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'] , '', array( 'class' => 'form-control') ) !!}
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
        $('input[name="param"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                datePicker:false,
                locale: {
                    format: 'hh:mm:ss',

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