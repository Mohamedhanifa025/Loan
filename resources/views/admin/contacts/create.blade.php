@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header row">
        <div class="col-md-8 pt-2">{{ trans('global.create') }} {{ trans('global.contact.title_singular') }}</div>
        <div class="col-md-4 breadcrumb float-right mb-0">
            <a class="breadcrumb-item" href="{{ route('home') }}">{{ trans('global.home') }}</a>
            <a class="breadcrumb-item"href="{{ route('admin.contacts.index') }}">{{ trans('global.contact.title_singular') }}</a>
            <span class="breadcrumb-item">{{ trans('global.create') }} {{ trans('global.contact.title_singular') }}</span>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route("admin.contacts.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.contact.fields.name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($contact) ? $contact->name : '') }}">
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
                <input type="number" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('name', isset($contact) ? $contact->mobile_number : '') }}">
                @if($errors->has('mobile_number'))
                    <p class="help-block">
                        {{ $errors->first('mobile_number') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.contact.fields.mobile_number_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
