@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("customer.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.customer.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($customer) ? $customer->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
                <label for="mobile_number">{{ trans('global.product.fields.mobile_number') }}</label>
                <input type="number" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('name', isset($customer) ? $customer->mobile_number : '') }}">
                @if($errors->has('mobile_number'))
                    <p class="help-block">
                        {{ $errors->first('mobile_number') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.mobile_number_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.customer.fields.email') }}</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($customer) ? $customer->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">{{ trans('global.customer.fields.email') }}</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($customer) ? $customer->address : '') }}">
                @if($errors->has('address'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.address_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                <label for="city">{{ trans('global.customer.fields.city') }}</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($customer) ? $customer->city : '') }}">
                @if($errors->has('city'))
                    <p class="help-block">
                        {{ $errors->first('city') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.city_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
                <label for="pincode">{{ trans('global.customer.fields.pincode') }}</label>
                <input type="text" id="pincode" name="pincode" class="form-control" value="{{ old('pincode', isset($customer) ? $customer->pincode : '') }}">
                @if($errors->has('pincode'))
                    <p class="help-block">
                        {{ $errors->first('pincode') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.pincode_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('referred_by') ? 'has-error' : '' }}">
                <label for="referred_by">{{ trans('global.customer.fields.referred_by') }}</label>
                <input type="text" id="referred_by" name="referred_by" class="form-control" value="{{ old('referred_by', isset($customer) ? $customer->referred_by : '') }}">
                @if($errors->has('referred_by'))
                    <p class="help-block">
                        {{ $errors->first('referred_by') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">{{ trans('global.customer.fields.status') }}</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ old('status', isset($customer) ? $customer->status : '') }}">
                @if($errors->has('status'))
                    <p class="help-block">
                        {{ $errors->first('status') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.customer.fields.status_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection