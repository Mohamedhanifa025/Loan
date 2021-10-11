@extends('layouts.admin')
@section('content')
@can('referral_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.referral.create") }}">
                {{ trans('global.add') }} {{ trans('global.referral.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.referral.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.referral.fields.customer_id') }}
                        </th>
                        <th>
                            {{ trans('global.referral.fields.refered_id') }}
                        </th>
                        <th>
                            {{ trans('global.referral.fields.points') }}
                        </th>
                        <th>
                            {{ trans('global.referral.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($referrals as $key => $referral)
                        <tr data-entry-id="{{ $referral->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $referral->customer_id ?? '' }}
                            </td>
                            <td>
                                {{ $referral->refered_id ?? '' }}
                            </td>
                            <td>
                                {{ $referral->points ?? '' }}
                            </td>
                            <td>
                                {{ $referral->status ?? '' }}
                            </td>
                            <td>
                                @can('referral_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.referral.show', $referral->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('referral_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.referral.edit', $referral->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('referral_delete')
                                    <form action="{{ route('admin.referral.destroy', $referral->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.referral.massDestroy') }}",
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