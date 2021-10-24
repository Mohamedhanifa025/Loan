@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.contact.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.contact.fields.customer_id') }}
                    </th>
                    <td>
                        {{ $contact->customer_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                    {{ trans('global.contact.fields.mobile_number') }}
                    </th>
                    <td>
                    {{ $contact->mobile_number }}
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@endsection