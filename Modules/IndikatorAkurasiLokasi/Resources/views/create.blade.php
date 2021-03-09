@extends('adminlte::page')

@section('content')
<form action="{{ route('akurasilokasi.store' ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Indikator Akurasi Lokasi</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name','', array( 'class' => 'form-control '.($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'Nama') ) !!}
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logic', 'Logic',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('logic', $list_logic , $akurasilokasi['logic']??null, array( 'class' => 'form-control '.($errors->has('logic') ? ' is-invalid' : null), 'placeholder' => 'Pilih Logic') ) !!}
                    @error('logic')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('param', 'Parameter',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('param', '', array( 'class' => 'form-control '.($errors->has('param') ? ' is-invalid' : null), 'placeholder' => 'Parameter') ) !!}
                    @error('param')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('score', 'Nilai',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('score', '', array( 'class' => 'form-control '.($errors->has('score') ? ' is-invalid' : null), 'placeholder' => 'Nilai') ) !!}
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('note', 'Keterangan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('note','', array( 'class' => 'form-control '.($errors->has('note') ? ' is-invalid' : null), 'rows' => '2','placeholder' => 'Keterangan') ) !!}
                    @error('note')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('status', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('status', ['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'] , '', array( 'class' => 'form-control') ) !!}
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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