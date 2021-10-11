@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.customer.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.name') }}
                    </th>
                    <td>
                        {{ $customer->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.mobile_number') }}
                    </th>
                    <td>
                    {{ $customer->mobile_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.email') }}
                    </th>
                    <td>
                        {{ $customer->email }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.address') }}
                    </th>
                    <td>
                        {{ $customer->address }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.city') }}
                    </th>
                    <td>
                        {{ $customer->city }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.pincode') }}
                    </th>
                    <td>
                        {{  $customer->pincode }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.referred_by') }}
                    </th>
                    <td>
                        {{  $customer->referred_by }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.customer.fields.status') }}
                    </th>
                    <td>
                        {{ $customer->status }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection