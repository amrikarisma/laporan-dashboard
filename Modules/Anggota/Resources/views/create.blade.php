@extends('adminlte::page')

@section('content')
<form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                            {!! Form::select('cabang', $cabang, old('cabang'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Cabang') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('divisi', 'Divisi',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('divisi', $divisi, old('divisi'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Divisi') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('jabatan', 'Jabatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('jabatan', $jabatan, old('jabatan'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Jabatan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('join_date', 'Tanggal Bergabung',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('join_date', old('join_date'), array( 'class' => 'form-control', 'placeholder' => 'Tanggal Bergabung') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('sk_pengangkatan', 'SK Pengangkatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('sk_pengangkatan', old('sk_pengangkatan'), array( 'class' => 'form-control', 'placeholder' => 'SK Pengangkatan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nik', 'NIK',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nik', old('nik'), array( 'class' => 'form-control', 'placeholder' => 'NIK') ) !!}
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
                            {!! Form::text('first_name', old('first_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Depan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('last_name', 'Nama Belakang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('last_name', old('last_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Belakang') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nick_name', 'Nama Panggilan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nick_name', old('nick_name'), array( 'class' => 'form-control', 'placeholder' => 'Nama Panggilan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('place_of_birth', 'Tempat Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('place_of_birth', old('place_of_birth'), array( 'class' => 'form-control', 'placeholder' => 'Tempat Lahir') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('birthday', 'Tanggal Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('birthday', old('birthday'), array( 'class' => 'form-control', 'placeholder' => 'Tanggal Lahir') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('address', 'Alamat',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('address', old('address'), array( 'class' => 'form-control', 'placeholder' => 'Alamat') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('national_id', 'KTP',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('national_id', old('national_id'), array( 'class' => 'form-control', 'placeholder' => 'No. KTP') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('license_id', 'SIM',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('license_id', old('license_id'), array( 'class' => 'form-control', 'placeholder' => 'No. SIM') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('marriage', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('marriage', array('Menikah' => 'Menikah','Belum Menikah' => 'Belum Menikah') ,old('marriage'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Status') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'Email',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', old('email'), array( 'class' => 'form-control', 'placeholder' => 'Email') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('role', 'Wewenang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('role', $roles, old('role'), array( 'class' => 'form-control', 'placeholder' => 'Pilih Wewenang') ) !!}
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
        </div>
    </div>
</form>
@endsection
@section('js')
    <script>
        $('#profile_photo').on('change', function () {
            let reader = new FileReader();
            console.log(reader);

            reader.onload = (e) => { 
                console.log('e');
                $('#profile_photo_preview').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 

        });
    </script>
@endsection