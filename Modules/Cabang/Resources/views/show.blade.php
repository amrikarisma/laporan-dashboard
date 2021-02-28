@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <img class="img-fluid" src="{{ $cabang['cabang_photo_url'] }}" />
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>Cabang Detail</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>Nama Cabang</td>
                        <td>:</td>
                        <td>{{ $cabang['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Cabang</td>
                        <td>:</td>
                        <td>{{ $cabang['branch']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>Penanggung Jawab</td>
                        <td>:</td>
                        <td>{{ $cabang['anggota']['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td>{{ $cabang['phone_number']??'' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection