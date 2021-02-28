@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Cabang</h3>
            </div>
            <div class="card-tools">
                <a class="btn btn-primary"
                href="{{ route('cabang.create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
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
                        </th>
                        <th>{{ _('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabangs['data'] as $cabang)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $cabang['name']??'' }}</td>
                            <td>{{ $cabang['branch']['name']??'' }}</td>
                            <td>{{ $cabang['anggota']['user']['name']??'' }}</td>
                            {{-- <td>
                                <div class="parent d-inline-flex">

                                    <a role="button" data-toggle="collapse" href="#{{ 'parent'.$cabang['id'] }}" aria-expanded="true" aria-controls="{{ 'parent'.$cabang['id'] }}" class="trigger-panel collapsed">
                                        <i class="more-less fas fa-fw fa-plus "></i>
                                    </a>
                                    <div class="name"> {{ $cabang['name']??'' }}</div>

                                </div>
                                <div id="{{ 'parent'.$cabang['id'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        @forelse ($cabang['children'] as $subcabang)
                                            <div class="children"> {{  $subcabang['name']??'' }}</div>
                                        @empty
                                        @endforelse
                                </div>
                            </td> --}}
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
                        @forelse ($cabang['children'] as $subcabang)
                            <tr class="expandable-body">
                                <td><div class="children"> {{  $subcabang['name']??'' }}</div></td>
                            </tr>
                        @empty
                        @endforelse
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
<style>
  .children {
      margin-left: 40px;
  }
</style>
@endsection
@section('js')
    <script>

    </script>
@endsection