@extends('adminlte::page')

@section('content')
<form action="{{ route('settings.update', $profile['anggota']['id']) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
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
                            {!! Form::select('cabang', $cabang, $profile['anggota']['cabang']['id']??'', array( 'class' => 'form-control', 'placeholder' => 'Pilih Cabang') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('divisi', 'Divisi',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('divisi', $divisi, $profile['anggota']['divisi']['id']??'', array( 'class' => 'form-control', 'placeholder' => 'Pilih Divisi') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('jabatan', 'Jabatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('jabatan', $jabatan, $profile['anggota']['jabatan']['id']??'', array( 'class' => 'form-control', 'placeholder' => 'Pilih Jabatan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('join_date', 'Tanggal Bergabung',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('join_date', $profile['anggota']['join_date'], array( 'class' => 'form-control', 'placeholder' => 'Tanggal Bergabung') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('sk_pengangkatan', 'SK Pengangkatan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('sk_pengangkatan', $profile['anggota']['sk_pengangkatan'], array( 'class' => 'form-control', 'placeholder' => 'SK Pengangkatan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nik', 'NIK',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nik', $profile['anggota']['nik'], array( 'class' => 'form-control', 'placeholder' => 'NIK') ) !!}
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
                            {!! Form::file('profile_photo' ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label"></div>
                        <div class="col-sm-9">
                            <img id="profile_photo_preview" src="{{ $profile['userdata']['profile_photo_url'] ?? asset('image/avatar-no-image.png') }}"
                            alt="preview image" style="max-height: 150px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('first_name', 'Nama Depan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('first_name', $profile['userdata']['first_name']??'', array( 'class' => 'form-control', 'placeholder' => 'Nama Depan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('last_name', 'Nama Belakang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('last_name', $profile['userdata']['last_name']??'', array( 'class' => 'form-control', 'placeholder' => 'Nama Belakang') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nick_name', 'Nama Panggilan',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('nick_name', $profile['userdata']['nick_name']??'', array( 'class' => 'form-control', 'placeholder' => 'Nama Panggilan') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('place_of_birth', 'Tempat Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('place_of_birth', $profile['userdata']['place_of_birth']??'', array( 'class' => 'form-control', 'placeholder' => 'Tempat Lahir') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('birthday', 'Tanggal Lahir',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('birthday', $profile['userdata']['birthday']??'', array( 'class' => 'form-control', 'placeholder' => 'Tanggal Lahir') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('address', 'Alamat',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('address', $profile['userdata']['address']??'', array( 'class' => 'form-control', 'placeholder' => 'Alamat') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('national_id', 'KTP',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('national_id', $profile['userdata']['national_id']??'', array( 'class' => 'form-control', 'placeholder' => 'No. KTP') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('license_id', 'SIM',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::text('license_id', $profile['userdata']['license_id']??'', array( 'class' => 'form-control', 'placeholder' => 'No. SIM') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('marriage', 'Status',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('marriage', array('Menikah' => 'Menikah','Belum Menikah' => 'Belum Menikah')  ,$profile['userdata']['marriage']??'', array( 'class' => 'form-control', 'placeholder' => 'Pilih Status') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'Email',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', $profile['email']??'', array( 'class' => 'form-control', 'placeholder' => 'Email') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password', 'Ganti Password',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::password('password', array( 'class' => 'form-control', 'placeholder' => 'Ganti Password' , 'autocomplete' => 'off') ) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('role', 'Wewenang',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('role', $roles, $profile['role_array'], array( 'class' => 'form-control', 'placeholder' => 'Pilih Wewenang') ) !!}
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
</form>
@endsection
@section('js')
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
    <script>
    $(function() {
        $('#password').empty();
        $('#password').val('');
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