@extends('layouts.app')
@section('content')
    <!-- Header -->
    <div class="header py-4 pt-lg-7">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5 mb-2 animated fadeInDown">
                        <h1 class="text-white font-weight-light mb-3">Welcome To!</h1>
                        <img src="{{ asset('img/logo-white.svg') }}" alt="{{ trans('global.site_title') }}" width="260" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--7 pb-4">
        <div class="row justify-content-center">
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 mb-0 animated zoomIn">
                    <div class="card-body px-md-5 py-md-5">
                        <form role="form" action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-3 has-feedback">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('global.login_email') }}" type="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('global.login_password') }}" placeholder="Password" type="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block mt-3">{{ trans('global.login') }}</button>
                            </div>
                            <div class="text-center font-weight-600">
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
