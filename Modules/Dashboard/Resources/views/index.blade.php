@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <div style="display:flex;justify-content:center;wrap;flex-direction: column;">
                    <div class="box-logo my-4" style="display:flex;justify-content:center;align-self:center;align-items:center;flex-wrap: wrap;flex-direction: column;">
                        <img width="200" class="img-fluid" src="{{asset('image/logo-sikumbang.png') }}" alt="Logo SiKumbang">
                    </div>
                    <h2 style="text-align:center; margin-bottom: 40px">Sistem Informasi & Komunikasi Kesatuan Bangsa (SIKUMBANG)</h2>
                    <div style="text-align:center; margin-bottom: 40px;">
                        <div class="row">
                            <div class="col-6 text-right">Nama Lengkap</div>
                            <div class="col-auto">:</div>
                            <div class="col-5 text-left">{{ $profile['name']??'' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right">Jabatan</div>
                            <div class="col-auto">:</div>
                            <div class="col-5 text-left">{{ $profile['anggota']['jabatan']['name']??'' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right">Unit Cabang</div>
                            <div class="col-auto">:</div>
                            <div class="col-5 text-left">{{ $profile['anggota']['cabang']['name']??'' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right">Login Terakhir</div>
                            <div class="col-auto">:</div>
                            <div class="col-5 text-left">{{ $profile['last_login_date'] ? \Carbon\Carbon::parse($profile['last_login_date'])->isoFormat('dddd, D MMMM Y / HH:mm:ss') : '' }}</div>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
