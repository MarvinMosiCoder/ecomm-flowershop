@extends('user-frontend.components.login-content')
@section('css')
<style>
    .field-icon {
        float: right;
        margin-right: 10px;
        margin-top: -30px;
        position: relative;
        z-index: 2;
    }
</style>
@section('content')

<section class="login-form">
    <div class="container" >
        <div class="row">
            <div class="col-md-5" style="margin:auto">
                <div class="box">
                    <div class="brand-logo text-center">
                    </div>
                    <h6 class="text-center" style="font-size:20px; font-weight:bold">Armani Flowershop.</h6>
                    <form class="pt-3" method="post" action="{{ route('login.perform') }}" autocomplete="off">
                        @csrf
                        @include('user-frontend.views.error.messages')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <label for="floatingPassword" style="font-size:14px; font-weight:bold">Log in</label>
                        <div class="form-group form-floating">
                            {{-- <label for="floatingEmail">Email</label> --}}
                            <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" role="presentation" autocomplete="off">
                        </div>
                        {{-- @if ($errors->has('email'))
                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif --}}
                        <div class="form-group form-floating mb-3">
                            {{-- <label for="floatingPassword">Password</label> --}}
                            <input type="password" id="password-field" class="form-control form-control-lg" name="password" placeholder="Password" role="presentation" autocomplete="off">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            
                        </div>
                        {{-- @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif --}}
                        <div class="mt-3">
                        <button type="submit" class="w-100 btn btn-primary btn-block btn-lg font-weight-medium auth-form-btn">LOG IN</button>
                        </div>
                        <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input">
                            <span style="font-size:12px">Keep me signed in</span> 
                            </label>
                        </div>
                        <a href="#" class="auth-link text-black" style="font-size:12px">Forgot password?</a>
                        </div>
                        {{-- <div class="mb-2">
                        <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                            <i class="ti-facebook me-2"></i>Connect using facebook
                        </button>
                        </div> --}}
                        <div class="text-center mt-3 fw-light" style="font-size:14px">
                        Don't have an account? <a href="{{ route('register.perform') }}">Sign-up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@section('script-js')
<script type="text/javascript">
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection