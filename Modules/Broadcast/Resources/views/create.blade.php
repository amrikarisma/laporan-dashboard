@extends('adminlte::page')

@section('content')
<form action="{{ route('broadcast.store' ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Kirim Broadcast Pengumuman</h3>
        </div>
        <div class="card-body">
            {{-- <div class="form-group row">
                {!! Form::label('logic', 'Logic',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('logic', $list_logic , $broadcast['logic']??null, array( 'class' => 'form-control', 'placeholder' => 'Pilih Logic') ) !!}
                </div>
            </div> --}}

            <div class="form-group row">
                {!! Form::label('title', 'Judul',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('title', '', array( 'class' => 'form-control', 'placeholder' => 'Judul') ) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('description', 'Deskripsi',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description','', array( 'class' => 'form-control', 'rows' => '4','placeholder' => 'Deskripsi') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('schedule', 'Jadwal Kirim',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('schedule','', array( 'class' => 'form-control','placeholder' => 'Jadwal Kirim') ) !!}
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