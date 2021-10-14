@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.setting.update", [$setting->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                <label for="type">{{ trans('global.setting.fields.type') }}*</label>
                <input type="text" id="type" name="type" class="form-control" value="{{ old('type', isset($setting) ? $setting->type : '') }}">
                @if($errors->has('type'))
                    <p class="help-block">
                        {{ $errors->first('type') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.setting.fields.type_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                <label for="value">{{ trans('global.setting.fields.value') }}</label>
                <input type="number" id="value" name="value" class="form-control" value="{{ old('name', isset($setting) ? $setting->value : '') }}">
                @if($errors->has('value'))
                    <p class="help-block">
                        {{ $errors->first('value') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.setting.fields.value_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection