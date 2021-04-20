@if(isset($user['anggota']['id']))
<a href="{{ route('anggota.show', $user['anggota']['id']) }}" target="_blank">{{ $user['name']??'' }}</a>
@else
{{ $user['name']??'' }}
@endif