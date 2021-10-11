@extends('layouts.admin')
@section('content')
@can('notification_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.notification.create") }}">
                {{ trans('global.add') }} {{ trans('global.notification.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.notification.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.notification.fields.user_id') }}
                        </th>
                        <th>
                            {{ trans('global.notification.fields.title') }}
                        </th>
                        <th>
                            {{ trans('global.notification.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $key => $notification)
                        <tr data-entry-id="{{ $notifications->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $notification->user_id ?? '' }}
                            </td>
                            <td>
                                {{ $notification->title ?? '' }}
                            </td>
                            <td>
                                {{ $notification->description ?? '' }}
                            </td>
                            <td>
                                @can('notification_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.notification.show', $notification->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('notification_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.notification.edit', $notification->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('notification_delete')
                                    <form action="{{ route('admin.notification.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.notification.massDestroy') }}",
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
@can('customer_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection