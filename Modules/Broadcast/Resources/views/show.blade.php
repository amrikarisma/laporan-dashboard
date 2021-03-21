@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detail Broadcast</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <thead></thead>
                <tbody>
                    <tr>
                        <td>{{ 'Tanggal' }}</td>
                        <td>{{ \Carbon\Carbon::parse($broadcast['created_at'])->locale('id_ID')->isoFormat('dddd, D MMMM Y')??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Pengirim' }}</td>
                        <td>{{ $broadcast['user']['name']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Judul' }}</td>
                        <td>{{ $broadcast['title']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Deskripsi' }}</td>
                        <td>{!! $broadcast['description']??'' !!}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Tujuan' }}</td>
                        <td>{{  $broadcast['target_send']??'' }}</td>
                    </tr>
                    <tr>
                        <td>{{ 'Status' }}</td>
                        <td>{!! $broadcast['status'] == 'Terkirim' ? '<span class="badge badge-success">'. $broadcast['status'] .'</span>' : '<span class="badge badge-warning">'. $broadcast['status'] .'</span>'  !!}</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('css')
@endsection
@section('js')
    <script>

    </script>
@endsection