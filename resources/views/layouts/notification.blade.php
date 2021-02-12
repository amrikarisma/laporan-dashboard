@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>Error!</strong> <br/>
   @foreach($errors->all() as $e)
    - {{$e}} <br/>
   @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>

@endif

@if(Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!</strong><br/>

   @foreach(Session::get('success') as $s)
     - {{$s}} <br/>
   @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>
 <?php Session::forget('success'); ?>
@endif

@if(Session::has('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> <br/>
    @foreach(Session::get('warning') as $w)
        - {{$w}} <br/>
    @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 </div>
 <?php Session::forget('warning'); ?>
@endif