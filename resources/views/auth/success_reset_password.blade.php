@extends('adminlte::master')
@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')
    <div style="
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    "> 
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Kata sandi berhasil direset!</h4>
            <p>Silakan masuk menggunakan email dan kata sandi baru.</p>
            <hr>
            <small class="mb-0">www.kesbangpoldki.id</small>
        </div>
    </div>

@stop
@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
