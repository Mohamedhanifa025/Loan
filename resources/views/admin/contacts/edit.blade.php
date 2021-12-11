@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7">
                    <div class="col-md-6 animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i>
                            {{ trans('global.edit') }} {{ trans('global.contact.title_singular') }}
                        </h1>
                    </div>
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
                        <form action="{{ route("admin.contacts.update", [$contact->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
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
                            <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    .form-group {
        margin-bottom: 0;
    }
@endsection
