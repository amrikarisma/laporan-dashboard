<div style="display: inline-block">
    <a class="btn btn-sm btn-outline-primary"
    href="{{ route('kategori-presensi.edit', $id) }}">Edit</a>
</div>
<div style="display: inline-block">
    {{ Form::open(['route' => ['kategori-presensi.destroy', $id], 'method' => 'delete']) }}
    <button type="button" class="btn-delete btn btn-sm btn-outline-danger"
    href="{{ route('kategori-presensi.destroy', $id) }}">Hapus</button>
    {{ Form::close() }}
</div>

