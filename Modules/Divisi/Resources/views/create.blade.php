@extends('adminlte::page')

@section('content')
<form action="{{ route('divisi.store') }}" method="POST" class="form-horizontal needs-validation" novalidate>
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Tambah Divisi</h3>
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
                    {!! Form::text('name', '', array( 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'Nama', 'required') ) !!}
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
    </script>
@endsection