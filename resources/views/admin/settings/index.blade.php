@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7">
                    <div class="col-md-12 text-center animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-cogs mr-2"></i> {{ trans('global.setting.title') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--9">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card animated fadeInUp">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" aria-selected="true">
                                    <i class="fa fa-envelope"></i>SMTP Setting
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab2" aria-selected="false">
                                    <i class="fa fa-mobile"></i>App Setting
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab3" aria-selected="false">
                                    <i class="fa fa-coins"></i>Rewards
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card no-shadow">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('global.setting.smtp_title_singular') }}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route("admin.settings.store") }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="type" value="smtp">
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="smtp_host">{{ trans('global.setting.fields.smtp_host') }}*</label>
                                                    <input type="text" id="smtp_host" name="smtp_host" class="form-control" value="{{ old('smtp_host', isset($setting) ? $setting->smtp_host : '') }}">
                                                    @if($errors->has('smtp_host'))
                                                        <p class="help-block">
                                                            {{ $errors->first('smtp_host') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.smtp_host_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="smtp_host">{{ trans('global.setting.fields.smtp_port') }}*</label>
                                                    <input type="text" id="smtp_port" name="smtp_port" class="form-control" value="{{ old('smtp_port', isset($setting) ? $setting->smtp_port : '') }}">
                                                    @if($errors->has('smtp_port'))
                                                        <p class="help-block">
                                                            {{ $errors->first('smtp_port') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.smtp_port_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="smtp_username">{{ trans('global.setting.fields.smtp_username') }}*</label>
                                                    <input type="text" id="smtp_username" name="smtp_username" class="form-control" value="{{ old('smtp_username', isset($setting) ? $setting->smtp_username : '') }}">
                                                    @if($errors->has('smtp_username'))
                                                        <p class="help-block">
                                                            {{ $errors->first('smtp_username') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.smtp_username_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="smtp_password">{{ trans('global.setting.fields.smtp_password') }}*</label>
                                                    <input type="text" id="smtp_password" name="smtp_password" class="form-control" value="{{ old('smtp_password', isset($setting) ? $setting->smtp_password : '') }}">
                                                    @if($errors->has('smtp_password'))
                                                        <p class="help-block">
                                                            {{ $errors->first('smtp_password') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.smtp_password_helper') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('global.setting.app_title_singular') }}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route("admin.settings.store") }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="type" value="app">
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="app_id">{{ trans('global.setting.fields.app_id') }}*</label>
                                                    <input type="text" id="app_id" name="app_id" class="form-control" value="{{ old('app_id', isset($setting) ? $setting->app_id : '') }}">
                                                    @if($errors->has('app_id'))
                                                        <p class="help-block">
                                                            {{ $errors->first('app_id') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.app_id_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="app_secret">{{ trans('global.setting.fields.app_secret') }}*</label>
                                                    <input type="text" id="app_secret" name="app_secret" class="form-control" value="{{ old('app_secret', isset($setting) ? $setting->app_secret : '') }}">
                                                    @if($errors->has('app_secret'))
                                                        <p class="help-block">
                                                            {{ $errors->first('app_secret') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.app_secret_helper') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('global.setting.reward_title_singular') }}
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route("admin.settings.store") }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="type" value="rewards">
                                                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                    <label for="rewards_value">{{ trans('global.setting.fields.reward_value') }}*</label>
                                                    <input type="text" id="rewards_value" name="reward_value" class="form-control" value="{{ old('reward_value', isset($setting) ? $setting->reward_value : '') }}">
                                                    @if($errors->has('reward_value'))
                                                        <p class="help-block">
                                                            {{ $errors->first('reward_value') }}
                                                        </p>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.setting.fields.reward_value_helper') }}
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
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
@parent
@endsection
