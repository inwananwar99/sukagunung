@extends('layouts.main')

@section('container')
<div class="row">
  <div class="col-md-4 col-md-offset-4 container-signin">
      <div class="row">
        <div class="col-md-12">
        <h1 class="text-center"><span class="glyphicon glyphicon-log-in"></span> SIGN IN</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif (session('status'))
              <div class="alert alert-danger">
                {{ session('status') }}
              </div> 
        @endif
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal form-signup" role="form" method="post" action="{{ route('login') }}" novalidate="novalidate"> 
             {!! csrf_field() !!}
            <div class="form-group"> 
              <input type="text" class="form-control" id="" placeholder="Masukan Username" name="username" value="{!!old('username')!!}" autocomplete="off">
              <span class="text-danger">{{ $errors->first('username')}}</span>
            </div> 
            <div class="form-group mt-3"> 
              <input type="password" class="form-control" id="" placeholder="Masukan password" name="password" value="">
              <span class="text-danger">{{ $errors->first('password')}}</span>
            </div> 				
            <div class="form-group mt-3">
                <input class="btn btn-primary" type="submit">
            </div>
          </form>
        </div>
      </div>
      <div class="row" style="margin-top:30px;">
        <div class="col-md-12">
          <a href="login" class="alert-link" style="color:#fff;"><span class="glyphicon glyphicon-lock"></span> Forgot a password</a><br/>
          <a href="register" class="alert-link" style="color:#fff;"><span class="glyphicon glyphicon-user"></span> create an account</a>
        </div>
      </div>
  </div>
  <div class="row footer-signin">
    <div class="col-md-12">
      <small class="text-center">Copyright 2015 for <a href="">Hery's Official Website</a> By <a href="http://twitter.com/herysepty">@herysepty</a> <br/>Thank for Bootstrap and Codeigniter</small>

    </div>
  </div>
</div>
@endsection
