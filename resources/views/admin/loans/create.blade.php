@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7 animated fadeInUp">
                    <div class="col-md-8">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i>
                            {{ trans('global.create') }} {{ trans('global.loan.title_singular') }}
                        </h1>
                    </div>
                    {{--                    <div class="col-md-4 breadcrumb float-right mb-0">--}}
                    {{--                        <a class="breadcrumb-item" href="{{ route('home') }}">{{ trans('global.home') }}</a>--}}
                    {{--                        <a class="breadcrumb-item"--}}
                    {{--                           href="{{ route('admin.contacts.index') }}">{{ trans('global.contact.title_singular') }}</a>--}}
                    {{--                        <span--}}
                    {{--                            class="breadcrumb-item">{{ trans('global.create') }} {{ trans('global.contact.title_singular') }}</span>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-body">

                        <form action="{{ route("admin.loan.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                                <label for="company_name">{{ trans('global.loan.fields.company_name') }}*</label>
                                <input type="text" id="company_name" name="company_name" class="form-control"
                                       value="{{ old('company_name', isset($loan) ? $loan->company_name : '') }}">
                                @if($errors->has('company_name'))
                                    <p class="help-block">
                                        {{ $errors->first('company_name') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.loan.fields.company_name_helper') }}
                                </p>
                            </div>
                            <div class="form-group {{ $errors->has('salary') ? 'has-error' : '' }}">
                                <label for="salary">{{ trans('global.loan.fields.salary') }}</label>
                                <input type="number" id="salary" name="salary" class="form-control"
                                       value="{{ old('salary', isset($loan) ? $loan->salary : '') }}">
                                @if($errors->has('salary'))
                                    <p class="help-block">
                                        {{ $errors->first('salary') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.loan.fields.salary_helper') }}
                                </p>
                            </div>
                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                <label for="location">{{ trans('global.loan.fields.location') }}</label>
                                <input type="text" id="location" name="location" class="form-control"
                                       value="{{ old('location', isset($loan) ? $loan->location : '') }}">
                                @if($errors->has('location'))
                                    <p class="help-block">
                                        {{ $errors->first('location') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.loan.fields.location_helper') }}
                                </p>
                            </div>
                            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                                <label for="message">{{ trans('global.loan.fields.message') }}</label>
                                <input type="text" id="message" name="message" class="form-control"
                                       value="{{ old('message', isset($loan) ? $loan->message : '') }}">
                                @if($errors->has('message'))
                                    <p class="help-block">
                                        {{ $errors->first('message') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.loan.fields.message_helper') }}
                                </p>
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{ trans('global.loan.fields.status') }}</label>
                                <input type="text" id="status" name="status" class="form-control"
                                       value="{{ old('status', isset($loan) ? $loan->status : '') }}">
                                @if($errors->has('status'))
                                    <p class="help-block">
                                        {{ $errors->first('status') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.loan.fields.status_helper') }}
                                </p>
                            </div>
                            <div>
                                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style type="text/css">
        .form-group {
            margin-bottom: 0;
        }
    </style>
@endsection
