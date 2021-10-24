@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.referral.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.referral.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                <label for="points">{{ trans('global.referral.fields.points') }}*</label>
                <input type="number" id="points" name="points" class="form-control" value="{{ old('points', isset($referral) ? $referral->points : '') }}">
                @if($errors->has('points'))
                    <p class="help-block">
                        {{ $errors->first('points') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.referral.fields.points_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">{{ trans('global.referral.fields.status') }}</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ old('status', isset($referral) ? $referral->status : '') }}">
                @if($errors->has('status'))
                    <p class="help-block">
                        {{ $errors->first('status') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.referral.fields.status_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection