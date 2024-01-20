@extends('admin.main.main')

@section('admin-content')
<style>


a.small-box-footer {
    background:#313b64;
    display: flex;
    /* text-align: center; */
    color: white;
    text-decoration: none;
    justify-content: center;
    margin-top:30px;
}
    i.fas.fa-arrow-circle-right {
    /* margin: auto; */
    margin-top: 5px;
    margin-left:5px;
}




</style>
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@elseif(Session::has('fail'))
<div id="success-message" class="alert alert-danger " role="alert">
    {{ Session::get('fail') }}
</div>
@endif
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box"  style="background-color:#e0fbfc;">
          <div class="inner justify-content-center">
            <h4 style="text-align:center; color:black;height:80px; padding-top: 41px;">Reading</h4>
          </div>
          <div class="icon">
            <p class="text-white"></p>
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('paragraph')}}" class="small-box-footer" style="margin-top:30px;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-4 col-6" style="">
        <!-- small box -->
        <div class="small-box bg-navy" style="  background:#98c1d9
; ">
          <div class="inner">
            <h4 style="text-align:center; color:black;height:80px;padding-top: 41px;" >Written</h4>


          </div>
          <div class="icon">
            <p class="text-white"></p class="text-white">

            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('test_write')}}" class="small-box-footer"  style="margin-top:30px;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

       <div class="col-lg-4 col-6">

        <div class="small-box " style="background-color:#c1d8f0; ">
          <div class="inner">
            <h4 style="text-align:center;color:black;height:80px;padding-top: 41px;">Listeing</h4>
          </div>
          <div class="icon">
            <p class="text-white"></p class="text-white">

            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('listening')}}" class="small-box-footer"  style="margin-top:30px;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

       <div class="col-lg-4 col-6 mt-4">

        <div class="small-box " style="background-color:#e1f1fd
; ">
          <div class="inner">
            <h4 style="text-align:center; color:black;height:80px;padding-top: 41px;">Speaking</h4>
          </div>
          <div class="icon">
            <p class="text-white"></p class="text-white">

            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('speak')}}" class="small-box-footer"  style="margin-top:30px;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6 mt-4">

        <div class="small-box " style="background-color:#d2deeb
; ">
          <div class="inner">
            <h4 style="text-align:center; color:black;height:80px;padding-top: 41px;">Total Test</h4>
          </div>
          <div class="icon">
            <p class="text-white"></p class="text-white">

            <i class="ion ion-bag"></i>
          </div>
          <a href="{{url('all_test_panel')}}" class="small-box-footer"  style="margin-top:30px;">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
        </div>
      </div>
<table class="responsive">
  
</table>


</div>


@endsection
