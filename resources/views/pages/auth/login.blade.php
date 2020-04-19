@extends('layouts.admin')

@section('navbar') <!-- nv --> @endsection
@section('sidebar') <!-- nv --> @endsection
@section('footer') <!-- nv --> @endsection


@section('page')
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="login-brand">
            <h1>Em-man</h1>
            <p style="font-size: 14px!important;">Employee Management</p>
          </div>

          @if (session('credentials'))
            <div class="alert alert-danger">
                {{ session('credentials') }}
            </div>              
          @endif

          <div class="card card-primary">
            <div class="card-header"><h4>Login</h4></div>

            <div class="card-body">
              <form method="POST" action="{{ url()->route('login.post') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                  <label for="username">Username</label>
                  <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                  <div class="invalid-feedback">
                    Please fill in your username
                  </div>
                </div>

                <div class="form-group">
                  <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  <div class="invalid-feedback">
                    please fill in your password
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                  </button>
                </div>
              </form>

            </div>
          </div>
          <div class="simple-footer">
            Copyright &copy; Em-man 2020
          </div>
        </div>
      </div>
    </div> 
@endsection


@push('js')
    <script>$('.main-wrapper').remove()</script>
@endpush