@if ($status_presensi['status_presensi_worktime'] == 'Baik')
<span class="badge badge-success">{{ $status_presensi['status_presensi_worktime'] }}</span>
@else
<span class="badge badge-danger">{{ $status_presensi['status_presensi_worktime'] }}</span>
@endif