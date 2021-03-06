@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Cabang</h3>
        </div>
        <div class="card-body">
            <form action="" method="GET" class="form-horizontal">
                {{-- @csrf --}}
                <div class="form-group row">
                    <div class="col-md-3">
                        {!! Form::select('cabang', $cabang, $request->cabang??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Cabang')) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::select('branch', $branch, $request->branch??'',array('class' => 'form-control select2', 'placeholder' => 'Filter Tingkat')) !!}
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Table Daftar Cabang</h4>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('cabang.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table id="basic" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>
                            {{ _('Nama Cabang')}}
                        </th>
                        <th>
                            {{ _('Tingkat Cabang')}}
                        </th>
                        <th>
                            {{ _('Penanggung Jawab')}}
                        </th>
                        <th>
                            {{ _('No. Telepon Cabang')}}
                        </th>
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabangs['data'] as $cabang)

                    {{-- <tr data-node-id="1"> --}}
                    <tr data-node-id="{{$cabang['nested_level'] ? $cabang['nested_level'] .'.' : '' }}{{$cabang['id']}}" {{  $cabang['nested_level'] ? 'data-node-pid='.$cabang['nested_level'] : '' }}>
                        <td> {{ $cabang['name']??'' }}</td>
                        <td>{{ $cabang['branch']['name']??'' }}</td>
                        <td>{{ $cabang['anggota']['user']['name']??'' }}</td>
                        <td>{{ $cabang['phone_number']??'' }}</td>
                    
                        <td>
                            <div style="display: inline-block">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('cabang.show', $cabang['id']) }}">Detail</a>
                            </div>
                            <div style="display: inline-block">
                                    <a class="btn btn-sm btn-outline-primary"
                                    href="{{ route('cabang.edit', $cabang['id']) }}">Edit</a>
                            </div>
                            <div style="display: inline-block">
                                <form action="{{ route('cabang.destroy', $cabang['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Yakin menghapus data ini?')" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('plugins.Select2', true)

@section('css')
<style>
  .children {
      margin-left: 40px;
  }
</style>
  <link href="https://www.jqueryscript.net/demo/simple-tree-table/jquery-simple-tree-table.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
<script src="https://www.jqueryscript.net/demo/simple-tree-table/jquery-simple-tree-table.js"></script>
    <script>
        $('#basic').simpleTreeTable({
            expander: $('#expander'),
            collapser: $('#collapser')
        });
        $('.select2').select2();
    </script>
@endsection