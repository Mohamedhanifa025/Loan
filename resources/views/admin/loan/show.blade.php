@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.loan.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.customer_id') }}
                    </th>
                    <td>
                        {{ $loan->customer_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.company_name') }}
                    </th>
                    <td>
                    {{  $loan->company_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.salary') }}
                    </th>
                    <td>
                        {{ $loan->salary }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.location') }}
                    </th>
                    <td>
                        {{  $loan->location }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.message') }}
                    </th>
                    <td>
                        {{  $loan->message }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.loan.fields.status') }}
                    </th>
                    <td>
                        {{   $loan->status }}
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
</div>

@endsection