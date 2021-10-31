@extends('layouts.app')
@section('content')
    <!-- Header -->
    <div class="header py-4 pt-lg-7">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5 mb-2 animated fadeInDown">
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
                        <p class="login-box-msg">{{ __('Verify Your Email Address') }}</p>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
