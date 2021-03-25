<div style="display: inline-block">
    <a class="btn btn-sm btn-outline-primary"
    href="{{ route('kategori-laporan.edit', $id) }}">Edit</a>
</div>
<div style="display: inline-block">
    {{ Form::open(['route' => ['kategori-laporan.destroy', $id], 'method' => 'delete']) }}
    <button type="button" class="btn-delete btn btn-sm btn-outline-danger"
    href="{{ route('kategori-laporan.destroy', $id) }}">Hapus</button>
    {{ Form::close() }}
</div>

