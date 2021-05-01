@extends('adminlte::page')

@section('content')
{{ Form::open(['route' => ['cabang.update', $cabang['id']],  'method' => 'post', 'files' => true, 'class' => 'form-horizontal needs-validation', 'novalidate']) }}
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Edit Cabang</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')

            <div class="form-group row">
                {!! Form::label('parent_id', 'Cabang Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('parent_id', $parent , $cabang['parent']['id']??null, array( 'class' => 'form-control select2', 'placeholder' => 'Tidak Ada',) ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $cabang['name'], array( 'class' => 'form-control', 'placeholder' => 'Nama', 'required') ) !!}
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
                <div class="col-sm-3 col-form-label"></div>
                <div class="col-sm-9">
                    <img id="cabang_photo_preview" src="{{ $cabang['cabang_photo_url'] ?? asset('image/avatar-no-image.png') }}"
                    alt="preview image" style="max-height: 150px;">
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
    {!! Form::close() !!}
@endsection
@section('plugins.Select2', true)

@section('css')

@endsection
@section('js')
    <script>
        $('.select2').select2();
        $('#cabang_photo').on('change', function () {
            let reader = new FileReader();
            console.log(reader);

            reader.onload = (e) => { 
                console.log('e');
                $('#cabang_photo_preview').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 

        });
    </script>
@endsection