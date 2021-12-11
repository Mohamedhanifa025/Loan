@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7 animated fadeInUp">
                    <div class="col-md-8">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i>
                            {{ trans('global.create') }} {{ trans('global.contact.title_singular') }}
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
                        <form action="{{ route("admin.contacts.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-12 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ trans('global.contact.fields.name') }}</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name', isset($contact) ? $contact->name : '') }}">
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.contact.fields.name_helper') }}
                                </p>
                            </div>
                            <div class="col-md-12 form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
                                <label for="mobile_number">{{ trans('global.contact.fields.mobile_number') }}</label>
                                <input type="number" id="mobile_number" name="mobile_number" class="form-control"
                                       value="{{ old('name', isset($contact) ? $contact->mobile_number : '') }}">
                                @if($errors->has('mobile_number'))
                                    <p class="help-block">
                                        {{ $errors->first('mobile_number') }}
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.contact.fields.mobile_number_helper') }}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                            </div>
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
