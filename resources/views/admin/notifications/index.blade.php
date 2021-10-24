@extends('layouts.admin')
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-7">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-2 pb-7">
                    <div class="col-md-6 animated fadeInUp">
                        <h1 class="h1 text-white d-inline-block mb-2"><i class="fa fa fa-users mr-2"></i> {{ trans('global.notification.title') }}</h1>
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
                                    <input type="text" id="table-search" name="term" class="form-control" value="{{ request()->input('term') }}" placeholder="Search Name, Number...">
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
                                <th scope="col" data-orderable="false">{{ trans('global.notification.fields.name') }}</th>
                                <th scope="col" data-orderable="false">{{ trans('global.notification.fields.notification') }}</th>
                                <th scope="col" class="text-center" data-orderable="false">{{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $key => $notification)
                                <tr data-entry-id="{{ $notification->id }}">
                                    <td>
                                        {{ $notification->user->name }}
                                    </td>
                                    <td>
                                        {{ $notification->title ?? '' }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y H:i:s', strtotime($notification->created_at)) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
