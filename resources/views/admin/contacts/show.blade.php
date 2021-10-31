@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header row">
        <div class="col-md-8 pt-2">{{ trans('global.show') }} {{ trans('global.contact.title') }}</div>
        <div class="col-md-4 breadcrumb float-right mb-0">
            <a class="breadcrumb-item" href="{{ route('home') }}">{{ trans('global.home') }}</a>
            <a class="breadcrumb-item"href="{{ route('admin.contacts.index') }}">{{ trans('global.contact.title') }}</a>
            <span class="breadcrumb-item">{{ trans('global.contact.title') }} #{{ $contact->id }}</span>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                    {{ trans('global.contact.fields.name') }}
                    </th>
                    <td>
                        {{ $contact->name }}
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
                <tr>
                    <th>
                        {{ trans('global.contact.fields.customer') }}
                    </th>
                    <td>
                        {{ $contact->customer_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.contact.fields.employee') }}
                    </th>
                    <td>
                        {{ $contact->user_name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
