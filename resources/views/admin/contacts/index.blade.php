@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7">
                    <div class="col-md-6 animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i> {{ trans('global.contact.title') }}</h1>
                    </div>
                    <div class="col-md-6 animated fadeInUp text-md-right">
                        @can('contact_create')
                            <a class="btn btn-sm btn-white mt-2" href="{{ route("admin.contacts.create") }}">
                                <i class="fa fa-plus mr-2"></i>{{ trans('global.add') }} {{ trans('global.new') }}
                            </a>
                            <a class="btn btn-sm btn-white mt-2" data-toggle="modal" data-target="#bulk-import"><i class="fa fa-plus mr-2"></i>{{ trans('global.bulk_import') }}</a>
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
                                    <select class="form-control" name="employee_id">
                                        <option value="">All Employee</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (isset(request()->employee_id) && request()->employee_id == $user->id)?'selected="selected"':'' }}>{{ $user->name }}</option>
                                        @endforeach
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
                                <th scope="col" data-orderable="false">{{ trans('global.contact.fields.name') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.contact.fields.mobile_number') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.contact.fields.customer') }}</th>
                                <th scope="col" class="text-center" data-orderable="false">{{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key => $contact)
                                <tr data-entry-id="{{ $contact->id }}">
                                    <td>
                                        {{ $contact->employee_id }}
                                    </td>
                                    <td>
                                        {{ $contact->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $contact->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $contact->mobile_number ?? '' }}
                                    </td>
                                    <td class="font-weight-bold text-center">
                                        <span class="py-1 text-uppercase px-2 rounded small {{ $contact->status == 1 ? 'bg-success':'bg-danger' }} text-white">{{ $contact->status_text ?? '' }}</span>
                                    </td>
                                    <td class="actions text-center">
                                        {{--<a href="view-contact" class="edit"><i class="fa fa-eye"></i></a>
                                        <a class="edit" data-toggle="modal" data-target="#edit-form"><i class="fa fa-pen"></i></a>
                                        <a class="delete" data-toggle="modal" data-target="#delete-form"><i class="fa fa-trash-alt"></i></a>--}}
                                        @can('contact_show')
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}"class="edit"><i class="fa fa-eye"></i></a>
                                        @endcan
                                        @can('contact_edit')
                                            <a class="edit" href="{{ route('admin.contacts.edit', $contact->id) }}"><i class="fa fa-pen"></i></a>
                                        @endcan
                                        @can('contact_delete')
                                            <a class="delete" data-toggle="modal" data-target="#delete-form" data-id="{{ $contact->id }}"><i class="fa fa-trash-alt"></i></a>
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
        <div class="modal fade modal-form" id="bulk-import" tabindex="-1" role="dialog">
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
                                    <h3>Bulk Import</h3>
                                    <p class="mb-0">Upload format should be (.csv, .xls)</p>
                                    <p>Download sample format <a href="#!">Click here</a></p>
                                </div>
                                <form role="form">
                                    <div class="form-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="en">
                                            <label class="custom-file-label" for="customFileLang">Select file</label>
                                        </div>
                                    </div>
                                    <div class="text-center pb-lg-3">
                                        <button type="button" class="btn btn-primary btn-block my-3">Import Contacts</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-form" id="send-sms" tabindex="-1" role="dialog">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card border-0 mb-0">
                            <div class="text-right">
                                <button type="button" class="close mt-3 mr-3" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="card-body px-lg-5 py-lg-2">
                                <div class="text-muted mb-4">
                                    <h3>Send SMS</h3>
                                    <p>Found <b>50</b> contacts has not received SMS.</p>
                                </div>
                                <form role="form">
                                    <div class="text-center pb-lg-3">
                                        <button type="button" class="btn btn-primary btn-block my-3">Send Bulk SMS</button>
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
                                    <h3>Edit Contact</h3>
                                </div>
                                <form role="form">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Contact Name" value="Arun Kumar" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Mobile Number" value="9876543210" type="text" />
                                        </div>
                                    </div>
                                    <div class="text-center pb-lg-3">
                                        <button type="button" class="btn btn-primary btn-block my-3">Update Contact</button>
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
                            <p>Do you really want to delete this contact? <br>This process cannot be undone.</p>
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
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            $('#delete-form').on('shown.bs.modal', function (e) {
                var id = $('.delete').data('id');
                let url = "{{ route('admin.contacts.destroy', '') }}";
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
