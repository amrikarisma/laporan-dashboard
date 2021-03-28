@if (isset($laporan_performance['persentase']) && $laporan_performance['persentase'] >= 90)
<span class="badge badge-success">{{ $laporan_performance['persentase']??0 }}% ({{ $laporan_performance['count']??0}})</span>
@else
<span class="badge badge-warning">{{ $laporan_performance['persentase']??0 }}% ({{ $laporan_performance['count']??0}})</span>
@endif
