@if ($status_presensi['status_presensi_masuk'] == 'Baik')
<span class="badge badge-success">{{ $status_presensi['status_presensi_masuk'] }}</span>
@else
<span class="badge badge-danger">{{ $status_presensi['status_presensi_masuk'] }}</span>
@endif