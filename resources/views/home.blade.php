@extends('layouts.admin')
@section('content')
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-3">
                    <div class="col-lg-6 col-7 animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-3"><i class="fa fa-tachometer-alt mr-2"></i> Dashboard</h1>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-stats animated fadeInUp">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Contacts</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_contacts }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="fa fa-address-book"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <a href="{{ route('admin.contacts.index') }}" class="link">See All<i class="fa fa-chevron-right"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats animated fadeInUp">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Employees</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_employees }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <a href="{{ route('admin.users.index') }}" class="link">See All<i class="fa fa-chevron-right"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats animated fadeInUp">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Customers</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_customers }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <a href="{{ route('admin.customers.index') }}" class="link">See All<i class="fa fa-chevron-right"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 animated fadeInUp">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 h3">New Customers</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Register Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($recent_customers))
                            @foreach($recent_customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->mobile_number }}</td>
                                    <td>{{ date('d/m/Y', strtotime($customer->created_at)) }}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No Records Found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 animated fadeInUp">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="h3 mb-0">Notifications</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead>
                            <tr>
                                <th>Recent 10 Notifications</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($recent_notifications))
                                @foreach($recent_notifications as $notification)
                                    <tr>
                                        <td>
                                            <div class="notification">
                                                <i class="fa fa-user"></i>
                                                <h4><span>{{ $notification->user->name }}</span> <span>{{ $notification->created_at->diffForHumans() }}</span></h4>
                                                <p>{{ $notification->title }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No Records Found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
@parent

@endsection
