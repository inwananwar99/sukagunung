@extends('layouts.main')

@section('container')
      <div class="row">
        <h1 class="text-center"><span class="glyphicon glyphicon-log-in"></span> Home</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @else
              <div class="alert alert-danger">
                {{ session('status') }}
              </div> 
        @endif
        @foreach ($gunung as $item)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Jumlah Gunung</h3><br>
                    <h4 class="text-center">{{$gn}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Jumlah Rute</h3><br>
                    <h4 class="text-center">{{$rute}}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Kuota Pendakian</h3><br>
                    <h4 class="text-center">{{$item->kuota}}</h4>
                </div>
            </div>
        </div>
    </div>
    @endforeach
  <div class="row footer-signin fixed-bottom">
    <div class="col-md-12">
      <small class="text-center">Copyright 2015 for <a href="">Hery's Official Website</a> By <a href="http://twitter.com/herysepty">@herysepty</a> <br/>Thank for Bootstrap and Codeigniter</small>

    </div>
  </div>
</div>
@endsection
