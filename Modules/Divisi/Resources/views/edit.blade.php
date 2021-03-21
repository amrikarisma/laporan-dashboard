@extends('adminlte::page')

@section('content')
<form action="{{ route('divisi.update', $divisi['id'] ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Edit Divisi</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')

            <div class="form-group row">
                {!! Form::label('divisi_parent', 'Divisi Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('divisi_parent', $divisi_parent , $divisi['parent']['id']??null, array( 'class' => 'form-control', 'placeholder' => 'Divisi Diatasnya') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $divisi['name'], array( 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'Nama') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('status', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('status', ['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'] , $divisi['status']??'', array( 'class' => 'form-control') ) !!}
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