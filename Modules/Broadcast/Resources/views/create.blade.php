@extends('adminlte::page')

@section('content')
{{ Form::open(['route' => 'broadcast.store',  'method' => 'post', 'files' => true, 'class' => 'form-horizontal needs-validation', 'novalidate']) }}

    @csrf
    <div class="card">
        <div class="card-header">
            <h3>Kirim Broadcast Pengumuman</h3>
        </div>
        <div class="card-body">
            @include('layouts.notification')
            {{-- <div class="form-group row">
                {!! Form::label('logic', 'Logic',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('logic', $list_logic , $broadcast['logic']??null, array( 'class' => 'form-control', 'placeholder' => 'Pilih Logic') ) !!}
                </div>
            </div> --}}

            <div class="form-group row">
                {!! Form::label('title', 'Judul',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::text('title', '', array( 'class' => 'form-control', 'placeholder' => 'Judul', 'required') ) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('description', 'Deskripsi',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('description','', array( 'class' => 'form-control', 'rows' => '4','placeholder' => 'Deskripsi','required') ) !!}
                </div>
            </div>
            {{-- <div class="form-group row">
                {!! Form::label('schedule', 'Jadwal Kirim',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('schedule','', array( 'class' => 'form-control','placeholder' => 'Jadwal Kirim') ) !!}
                </div>
            </div> --}}
            <div class="form-group row">
                {!! Form::label('target_send', 'Tujuan Broadcast',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::select('target_send', $targetSend , null, array( 'class' => 'form-control select2', 'placeholder' => 'Pilih Tujuan') ) !!}
                    
                </div>
            </div>
            <div class="form-group ml-3 row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <input class="form-check-input" type="checkbox" value="1" id="target_send_with_children" name="target_send_with_children">
                    <label class="form-check-label" for="target_send_with_children">
                      Kirim juga ke cabang dibawahnya.
                    </label>
                </div>
              </div>
            <div class="form-group row">
                {!! Form::label('image', 'Upload Foto',  array( 'class' => 'col-sm-3 col-form-label') ) !!}
                <div class="col-sm-9">
                    {!! Form::file('image', array('accept' => 'image/*')) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label"></div>
                <div class="col-sm-9">
                    <img id="image_preview" src="{{ asset('image/avatar-no-image.png') }}"
                    alt="preview image" style="max-height: 150px;">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary"> Kirim</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection
@section('plugins.Momentjs', true)
@section('plugins.Daterangepicker', true)
@section('plugins.Select2', true)
@section('js')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
        $(function() {
            $('.select2').select2();

            $('#image').on('change', function () {
                let reader = new FileReader();
                console.log(reader);

                reader.onload = (e) => { 
                    console.log('e');
                    $('#image_preview').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 

            });
            $('input[name="birthday"], input[name="schedule"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10),
                locale: {
                format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                console.log("You are " + years + " years old!");
            });
        });
    </script>
@endsection