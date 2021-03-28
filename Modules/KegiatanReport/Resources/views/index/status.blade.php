@if ($status == 'Ditidak Lanjuti')
<span class="badge badge-success">{{ $status }}</span>
@elseif ($status == 'Menunggu')
<span class="badge badge-warning">{{ $status }}</span>
@else
<span class="badge badge-secondary">{{ $status }}</span>
@endif