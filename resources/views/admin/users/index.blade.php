@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7">
                    <div class="col-md-6 animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i> {{ trans('global.user.title') }}</h1>
                    </div>
                    <div class="col-md-6 animated fadeInUp text-md-right">
                        @can('user_create')
                            <a class="btn btn-sm btn-white mt-2" href="{{ route("admin.users.create") }}">
                                <i class="fa fa-plus mr-2"></i>{{ trans('global.add') }} {{ trans('global.new') }}
                            </a>
                            {{--<a class="btn btn-sm btn-white mt-2" data-toggle="modal" data-target="#add-form"><i class="fa fa-plus mr-2"></i>Add New</a>--}}
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-xl-12">
                <div class="card animated fadeInUp">
                    <div class="card-header border-0">
                        <form action="" method="GET">
                            <div class="row align-items-center">
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <input type="text" id="table-search" name="term" class="form-control" {{ request()->input('term') }} placeholder="Search Name, Number...">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="status">
                                        <option value="">All Status</option>
                                        <option value="1" {{ (isset(request()->status) && request()->status == 1)?'selected="selected"':'' }}>Approved</option>
                                        <option value="0" {{ (isset(request()->status) && request()->status == 0)?'selected="selected"':'' }}>Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-sm btn-white mt-2">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="datatable table align-items-center table-flush">
                            <thead>
                            <tr>
                                <th scope="col" data-orderable="false">{{ trans('global.user.fields.emp_id') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.user.fields.name') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.user.fields.email') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.user.fields.mobile_number') }}</th>
                                <th scope="col" class="text-center">{{ trans('global.status') }}</th>
                                <th scope="col" class="text-center" data-orderable="false">{{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td>
                                        {{ $user->employee_id }}
                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->mobile_number ?? '' }}
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <span class="py-1 text-uppercase px-2 rounded small {{ $user->status == 1 ? 'bg-success':'bg-danger' }} text-white">{{ $user->status_text ?? '' }}</span>
                                    </td>
                                    <td class="actions text-center">
                                        {{--<a href="view-user" class="edit"><i class="fa fa-eye"></i></a>
                                        <a class="edit" data-toggle="modal" data-target="#edit-form"><i class="fa fa-pen"></i></a>
                                        <a class="delete" data-toggle="modal" data-target="#delete-form"><i class="fa fa-trash-alt"></i></a>--}}
                                        @can('user_show')
                                            <a href="{{ route('admin.users.show', $user->id) }}"class="edit"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('user_edit')
                                            <a class="edit" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-pen"></i></a>
                                        @endcan
                                        @can('user_delete')
                                            <a class="delete" data-toggle="modal" data-target="#delete-form" data-id="{{ $user->id }}"><i class="fa fa-trash-alt"></i></a>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-form" id="add-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-form border-0 mb-0">
                            <div class="text-right">
                                <button type="button" class="close mt-3 mr-3" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="card-body px-lg-5 py-lg-2">
                                <div class="text-muted mb-4">
                                    <h3>Add New Employee</h3>
                                </div>
                                <form role="form">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Employee Name" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Email Address" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Mobile Number" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Password" type="password" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select class="form-control">
                                                <option value="0">Status</option>
                                                <option value="0">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group-alternative">
                                            <textarea class="form-control" placeholder="Employee Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <div class="input-group-alternative">
                                                <input type="text" class="form-control" placeholder="City" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <div class="input-group-alternative">
                                                <input type="text" class="form-control" placeholder="Pin Code" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pb-lg-3">
                                        <button type="button" class="btn btn-primary btn-block my-3">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-form" id="edit-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-form border-0 mb-0">
                            <div class="text-right">
                                <button type="button" class="close mt-3 mr-3" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="card-body px-lg-5 py-lg-2">
                                <div class="text-muted mb-4">
                                    <h3>Edit Employee</h3>
                                </div>
                                <form role="form">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Employee Name" value="Arun Kumar" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Email Address" value="emailaddress@gmail.com" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Mobile Number" value="+91 9876543210" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Password" type="password" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select class="form-control">
                                                <option value="0">Status</option>
                                                <option value="0" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group-alternative">
                                            <textarea class="form-control">42, Balaji Bldg, Naya Nagar, Opp Laxmi Park, Mira Road</textarea>
                                        </div>
                                    </div>
                                    <div class="text-center pb-lg-3">
                                        <button type="button" class="btn btn-primary btn-block my-3">Update Employee</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-form" id="delete-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-danger modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content bg-gradient-danger">
                    <div class="modal-body p-0 text-center">
                        <div class="text-right">
                            <button type="button" class="close mt-3 mr-3" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="mt-5 mb-4 pl-4 pr-4 text-white">
                            <i class="fa fa-exclamation-triangle" style="font-size: 35px"></i>
                            <h3 class="heading mt-3">Are you sure?</h3>
                            <p>Do you really want to delete this employee? <br>This process cannot be undone.</p>
                            <form class="delete-popup" action="" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-white my-3">{{ trans('global.yes') }}, {{ trans('global.delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
{{--@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('global.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.email_verified_at') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.roles') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->email_verified_at ?? '' }}
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>--}}
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        $('#delete-form').on('shown.bs.modal', function (e) {
            var id = $('.delete').data('id');
            let url = "{{ route('admin.users.destroy', '') }}";
            $('.delete-popup').attr('action', url + '/' + id);
        });
  /*let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })*/
})

</script>
@endsection
