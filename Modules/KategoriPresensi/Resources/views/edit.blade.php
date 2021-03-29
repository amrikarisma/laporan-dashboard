@extends('adminlte::page')

@section('content')
<form action="{{ route('kategori-presensi.update', $kategori['id'] ) }}" method="POST" class="form-horizontal">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Edit Kategori Presensi</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                {!! Form::label('name', 'Nama',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $kategori['name'], array( 'class' => 'form-control', 'placeholder' => 'Nama') ) !!}
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
@endsection