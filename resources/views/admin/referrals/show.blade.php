@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.referral.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.referral.fields.customer_id') }}
                    </th>
                    <td>
                        {{ $referral->customer_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.referral.fields.refered_id') }}
                    </th>
                    <td>
                        {{ $referral->refered_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.referral.fields.points') }}
                    </th>
                    <td>
                        {{ $referral->points }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.referral.fields.status') }}
                    </th>
                    <td>
                        {{ $referral->status }}
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>

@endsection