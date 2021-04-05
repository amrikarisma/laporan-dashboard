<div style="display: inline-block">
    <a class="btn btn-sm btn-outline-primary" href="{{ route('divisi.show', $id) }}">Detail</a>
</div>
<div style="display: inline-block">
    <a class="btn btn-sm btn-outline-primary"
    href="{{ route('divisi.edit', $id) }}">Edit</a>
</div>
<div style="display: inline-block">
    {{ Form::open(['route' => ['divisi.destroy', $id], 'method' => 'delete']) }}
    <button type="button" class="btn-delete btn btn-sm btn-outline-danger"
    href="{{ route('divisi.destroy', $id) }}">Hapus</button>
    {{ Form::close() }}
</div>
