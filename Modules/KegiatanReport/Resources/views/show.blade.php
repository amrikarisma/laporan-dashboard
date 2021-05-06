@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Detail Kegiatan</h4>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td>{{ 'Tanggal/Jam' }}</td>
                            <td>{{ \Carbon\Carbon::parse($kegiatan['created_at'])->isoFormat('dddd, D MMMM Y / HH:mm:ss')??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Nama' }}</td>
                            <td>{{ $kegiatan['user']['name']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Kategori' }}</td>
                            <td>{{ $kegiatan['category']['name']??'Tidak ada kategori' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Judul' }}</td>
                            <td>{{ $kegiatan['laporan_title']??'' }}</td>
                        </tr>
                        <tr style="white-space: pre-line;">
                            <td>{{ 'Deskripsi' }}</td>
                            <td>{!! $kegiatan['laporan_description']??'' !!}</td>
                        </tr>
                        <tr style="white-space: pre-line;">
                            <td>{{ 'Usulan' }}</td>
                            <td>{!! $kegiatan['recommendation']??'' !!}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Lokasi Laporan dari Anggota' }}</td>
                            <td>{{ $kegiatan['laporan_location']??'' }}</td>
                        </tr>
                        <tr>
                            <td>{{ 'Lokasi dari GPS' }}</td>
                            <td><a data-toggle="tooltip" data-placement="top" title="Tooltip on top" target="_blank" href="https://www.google.com/maps/place/{{ $kegiatan['laporan_geolocation']??'' }}">{{ $kegiatan['laporan_address_geo']??'' }}</a></td>
                        </tr>
                        <tr>
                            <td>{{ 'Performa' }}</td>
                            <td>{{ $kegiatan['laporan_performance']['persentase']??0 }} %</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Foto kegiatan</h4>
            </div>
            <div class="card-body">
                
                <div class="row">
                    @foreach ($kegiatan['image'] as $image)
                        <div class="col-lg-2 col-6">
                            <a href="{{ $image['image_url'] }}" data-toggle="lightbox" data-gallery="example-gallery">
                                <img class="img-thumbnail" width="280px" src="{{ $image['image_url'] }}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Tindak Lanjuti</h4>
            </div>
            <div class="card-body">
                
                <form action="{{ route('laporan.kegiatan.update', $kegiatan['id'] ) }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        {!! Form::label('penanganan', 'Penanganan / Upaya',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::textarea('penanganan',$kegiatan['penanganan']??'', array( 'class' => 'form-control summernote', 'readonly','rows' => '4','placeholder' => 'Penanganan/Upaya') ) !!}
                        </div>
                    </div>
                    <input type="hidden" name="status" value="{{'Ditidak Lanjuti'}}">
                    @if(in_array(1, session('roles')))
                    <div class="form-group row">
                        {!! Form::label('penanganan_oleh', 'Penanganan oleh',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                        <div class="col-sm-9">
                            {!! Form::select('penanganan_oleh', $anggota, $kegiatan['penanganan_oleh']??'', array( 'class' => 'form-control select2')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary"> Kirim</button>
                        </div>
                    </div>
                    @elseif (empty($kegiatan['penanganan']) || (!empty($kegiatan['penanganan']) && ($anggota['id'] == $kegiatan['penanganan_oleh'])))
                        <div class="form-group row">
                            {!! Form::label('anggota', 'Penanganan oleh',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                            <div class="col-sm-9">
                                {!! Form::text('anggota',$anggota['user']['name']??session('name'), array( 'class' => 'form-control', 'readonly') ) !!}
                            </div>
                        </div>
                        <input type="hidden" name="penanganan_oleh" value="{{ $kegiatan['penanganan_oleh']??$anggota['id'] }}">
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary"> Kirim</button>
                            </div>
                        </div>

                    @endif
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/id.min.js"></script>
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('.select2').select2({
            placeholder: "Pilih anggota",
            maximumInputLength: 50,
            minimumResultsForSearch: 20,
            allowClear: true,
            language: "id",
        });
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
        $('.summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 300,                 // set editor height
            focus:true
        });

    </script>
@endsection