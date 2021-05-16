@extends('adminlte::page')

@section('content')
<form action="{{ route('kategori-presensi.store' ) }}" method="POST" class="form-horizontal needs-validation" novalidate>
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Buat Kategori Presensi</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', '', array( 'class' => 'form-control', 'placeholder' => 'Nama', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('group', 'Grup',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('group', array('1' => 'Hadir', '2' => 'Tidak Hadir'), '', array( 'class' => 'form-control', 'required') ) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('status', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    <input type="hidden" name="status" value="Tidak Aktif">
                    <input type="checkbox" name="status" value="Aktif" data-toggle="toggle" data-on="Aktif" data-off="Tidak Aktif" data-onstyle="success" data-offstyle="danger" data-size="small">
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
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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