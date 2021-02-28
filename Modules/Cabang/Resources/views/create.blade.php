@extends('adminlte::page')

@section('content')
<form action="{{ route('cabang.create' ) }}" method="POST" class="form-horizontal">
    {{-- {!! Form::open(['action' => ['cabang.update', $cabang['id'], 'method' => 'PUT', 'files' => true ]]) !!} --}}

    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Cabang</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            <div class="form-group row">
                {!! Form::label('parent_id', 'Cabang Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('parent_id', $parent , null, array( 'class' => 'form-control select2', 'placeholder' => 'Tidak Ada',) ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $cabang['name']??'', array( 'class' => 'form-control', 'placeholder' => 'Nama', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('branch', 'Tingkat Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('branch', $branch , $cabang['branch']['id']??'', array( 'class' => 'form-control select2', 'placeholder' => 'Pilih Tingkat Cabang',) ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('anggota_id', 'Penanggung Jawab',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('anggota_id', $anggotas , $cabang['anggota']['id']??null, array( 'class' => 'form-control select2', 'placeholder' => 'Pilih Penanggung Jawab', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('phone_number', 'No. Telepon',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone_number', $cabang['phone_number']??'', array( 'class' => 'form-control', 'placeholder' => 'Masukan No. Telepon', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('cabang_photo', 'Upload Foto Unit Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::file('cabang_photo'); !!}
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary"> Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection