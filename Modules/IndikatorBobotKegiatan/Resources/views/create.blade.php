@extends('adminlte::page')

@section('content')
<form action="{{ route('bobotkegiatan.store' ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Indikator Bobot Kegiatan</h3>
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
                    {!! Form::select('logic', $list_logic , $bobotkegiatan['logic']??null, array( 'class' => 'form-control', 'placeholder' => 'Pilih Logic') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('param', 'Parameter',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('param', '', array( 'class' => 'form-control', 'placeholder' => 'Parameter') ) !!}
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