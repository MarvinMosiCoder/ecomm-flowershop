@extends('user-frontend.components.login-content')

@section('content')
<section class="register-form">
<div class="container">
  <div class="row">
    <div class="col-md-6" style="margin:auto">
        <div class="box">
            <h6 class="text-center" style="font-size:20px; font-weight:bold">Armani Flowershop.</h6>
            <form method="post" action="{{ route('register.perform') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <label for="floatingPassword" style="font-size:14px; font-weight:bold">Register</label>
                <div class="form-group form-floating mb-3">
                    <label for="floatingEmail">Email address</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <label for="floatingName">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required">
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="text-center mb-4 fw-light" style="font-size:14px">
                    Already registered ? <a href="{{ route('login.perform') }}">Log-in</a>
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                
            </form>
        </div>
    </div>
  </div>
<!-- page-body-wrapper ends -->
</div>
</section>
    
@endsection