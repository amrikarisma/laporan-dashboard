<div style="display: inline-block">
    {{ Form::open(['route' => ['broadcast.repush'], 'method' => 'POST']) }}
    <input type="hidden" name="title" value="{{ $title }}">
    <input type="hidden" name="description" value="{{ $description }}">
    <input type="hidden" name="image" value="{{ $image_url }}">
    <input type="hidden" name="cabang" value="{{ $target_send['id']??null }}">
    <input type="hidden" name="cabang_with_children" value="{{ $target_send_with_children??null }}">
    <button type="submit" class="btn btn-sm btn-outline-secondary"  {{ session('repush') == "1" ? 'disabled' : '' }}>Kirim Ulang Notifikasi</button>
    {{ Form::close() }}
</div>
<div style="display: inline-block">
    <a class="btn btn-sm btn-outline-primary" href="{{ route('broadcast.show', $slug) }}">Detail</a>
</div>
