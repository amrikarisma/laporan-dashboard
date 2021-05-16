@extends('adminlte::page')

@section('content')
<form action="{{ route('cabang.create' ) }}" method="POST" enctype="multipart/form-data" class="form-horizontal needs-validation" novalidate >
    {{-- {!! Form::open(['action' => ['cabang.update', $cabang['id'], 'method' => 'PUT', 'files' => true ]]) !!} --}}

    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Cabang</h3>
        </div>
        <div class="card-body">
            {{-- @include('layouts.notification') --}}
            <div class="form-group row">
                {!! Form::label('parent_id', 'Cabang Diatasnya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('parent_id', $parent , null, array( 'class' => 'form-control select2 '.($errors->has('parent_id') ? ' is-invalid' : null), 'placeholder' => 'Tidak Ada',) ) !!}
                    @error('parent_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', 'Nama Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $cabang['name']??'', array( 'class' => 'form-control ' .($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'Nama', 'required') ) !!}
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('branch', 'Tingkat Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('branch', $branch , $cabang['branch']['id']??'', array( 'class' => 'form-control select2 ' .($errors->has('branch') ? ' is-invalid' : null), 'placeholder' => 'Pilih Tingkat Cabang','required') ) !!}
                    @error('branch')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('anggota_id', 'Penanggung Jawab',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('anggota_id', $anggotas , $cabang['anggota']['id']??null, array( 'class' => 'form-control select2 ' .($errors->has('anggota_id') ? ' is-invalid' : null), 'placeholder' => 'Pilih Penanggung Jawab') ) !!}
                    @error('anggota_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>
            <div class="form-group row">
                {!! Form::label('phone_number', 'No. Telepon',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone_number', $cabang['phone_number']??'', array( 'class' => 'form-control ' .($errors->has('phone_number') ? ' is-invalid' : null), 'placeholder' => 'Masukan No. Telepon', 'required') ) !!}
                    @error('phone_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('cabang_photo', 'Upload Foto Unit Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::file('cabang_photo'); !!}
                    @error('cabang_photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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

@section('plugins.Select2', true)

@section('css')

@endsection
@section('js')
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
    $('.select2').select2();
    </script>
@endsection