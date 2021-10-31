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
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="login-box-msg">{{ trans('global.reset_password') }}</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div>
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" required="required"="autofocus" placeholder="{{ trans('global.login_email') }}">
                                    @if($errors->has('email'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                                        {{ trans('global.reset_password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
