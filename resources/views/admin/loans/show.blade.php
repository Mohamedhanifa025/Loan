@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7 animated fadeInUp">
                    <div class="col-md-8">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i>
                            {{ trans('global.show') }} {{ trans('global.loan.title') }}
                        </h1>
                    </div>
                    {{--<div class="col-md-4 breadcrumb float-right mb-0">
                        <a class="breadcrumb-item" href="{{ route('home') }}">{{ trans('global.home') }}</a>
                        <a class="breadcrumb-item"href="{{ route('admin.contacts.index') }}">{{ trans('global.customer.title') }}</a>
                        <span class="breadcrumb-item">{{ trans('global.customer.title') }} #{{ $customer->id }}</span>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card animated fadeInUp">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('global.loan.fields.id') }}
                                </th>
                                <td>
                                    {{ $loan->id }}
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
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        tbody td {
            border-color: #e9ecef !important;
        }
    </style>
@endsection
