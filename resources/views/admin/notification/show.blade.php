@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.notification.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.notification.fields.user_id') }}
                    </th>
                    <td>
                        {{ $notification->user_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.notification.fields.title') }}
                    </th>
                    <td>
                    {{ $notification->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.notification.fields.description') }}
                    </th>
                    <td>
                        {{ $notification->description }}
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>

@endsection