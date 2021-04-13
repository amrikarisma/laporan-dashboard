@extends('adminlte::page')

@section('content')
    {{ Form::open(['route' => 'anggota.store',  'method' => 'post', 'files' => true, 'class' => 'form-horizontal needs-validation', 'novalidate']) }}

    @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Data Keanggotaan</h3>
                </div>
                <div class="card-body">
                    @include('layouts.notification')
                    <div class="form-group row">
                        {!! Form::label('cabang', 'Cabang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('cabang', $cabang, old('cabang'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Cabang' , 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('divisi', 'Divisi',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('divisi', $divisi, old('divisi'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Divisi', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('jabatan', 'Jabatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('jabatan', $jabatan, old('jabatan'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Jabatan', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('join_date', 'Tanggal Bergabung',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('join_date', old('join_date'), array( 'class' => 'form-control', 'placeholder' => 'Tanggal Bergabung', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('sk_pengangkatan', 'SK Pengangkatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('sk_pengangkatan', old('sk_pengangkatan'), array( 'class' => 'form-control', 'placeholder' => 'SK Pengangkatan', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nik', 'NIK',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nik', old('nik'), array( 'class' => 'form-control', 'placeholder' => 'NIK', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('status', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            <input type="hidden" name="status" value="Tidak Aktif">
                            <input type="checkbox" checked name="status" value="Aktif" data-toggle="toggle" data-on="Aktif" data-off="Tidak Aktif" data-onstyle="success" data-offstyle="danger">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Data Pribadi</h3>
                </div>
                <div class="card-body">
                    @include('layouts.notification')
                    <div class="form-group row">
                        {!! Form::label('profile_photo', 'Upload Foto',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::file('profile_photo', array('accept' => 'image/*')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label"></div>
                        <div class="col-sm-9">
                            <img id="profile_photo_preview" src="{{ asset('image/avatar-no-image.png') }}"
                            alt="preview image" style="max-height: 150px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('first_name', 'Nama Depan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('first_name', old('first_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Depan', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('last_name', 'Nama Belakang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('last_name', old('last_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Belakang', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nick_name', 'Nama Panggilan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nick_name', old('nick_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Panggilan', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('place_of_birth', 'Tempat Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('place_of_birth', old('place_of_birth'), array( 'class' => 'form-control', 'placeholder' => 'Tempat Lahir', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('birthday', 'Tanggal Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('birthday', old('birthday'), array( 'class' => 'form-control', 'placeholder' => 'Tanggal Lahir', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('address', 'Alamat',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('address', old('address'), array( 'class' => 'form-control', 'placeholder' => 'Alamat', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('national_id', 'KTP',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('national_id', old('national_id'), array( 'class' => 'form-control', 'placeholder' => 'No. KTP', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('license_id', 'SIM',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('license_id', old('license_id'), array( 'class' => 'form-control', 'placeholder' => 'No. SIM', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('marriage', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('marriage', array('Menikah' => 'Menikah','Belum Menikah' => 'Belum Menikah') ,old('marriage'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Status', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'Email',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', old('email'), array( 'class' => 'form-control', 'placeholder' => 'Email', 'required') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('role', 'Wewenang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('role', $roles, old('role'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Wewenang', 'required') ) !!}
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
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
    <script>
        $(function() {
            $('#profile_photo').on('change', function () {
                let reader = new FileReader();
                console.log(reader);

                reader.onload = (e) => { 
                    console.log('e');
                    $('#profile_photo_preview').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 

            });
            moment.locale('id');
            $('input[name="birthday"], input[name="join_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10),
                locale: {
                format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                console.log("You are " + years + " years old!");
            });
        });
    </script>
@endsection