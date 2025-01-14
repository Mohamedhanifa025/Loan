@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                <h1 class="text-white font-weight-light mb-3">Welcome To!</h1>
                <img src="{{ asset('img/logo-white.svg') }}" alt="{{ trans('global.site_title') }}" />
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('global.login_email') }}" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('global.login_password') }}" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <input type="checkbox" name="remember"> {{ trans('global.remember_me') }}
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('global.login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <p class="mb-1">
                <a class="" href="{{ route('password.request') }}">
                    {{ trans('global.forgot_password') }}
                </a>
            </p>
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    <footer id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-12 mb-5">
                    <div class="copyright text-center text-white animated fadeInUp">
                        © 2020 Loanzspot All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
    <style>
        /*Login*/

        .login-page {
            min-height: 100vh;
            background: rgb(18, 168, 238);
            background: -moz-linear-gradient(129deg, rgba(18, 168, 238, 1) 0%, rgba(73, 15, 221, 1) 100%);
            background: -webkit-linear-gradient(129deg, rgba(18, 168, 238, 1) 0%, rgba(73, 15, 221, 1) 100%);
            background: linear-gradient(129deg, rgba(18, 168, 238, 1) 0%, rgba(73, 15, 221, 1) 100%);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#12a8ee", endColorstr="#490fdd", GradientType=1);
        }

        .login-page .card {
            background: #ecedf5;
        }
    </style>
@endsection
