@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.setting.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.setting.fields.type') }}
                    </th>
                    <td>
                        {{ $setting->type }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.setting.fields.value') }}
                    </th>
                    <td>
                    {{ $setting->value }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection