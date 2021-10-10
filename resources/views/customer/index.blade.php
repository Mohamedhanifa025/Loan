@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="">
                {{ trans('global.add') }} {{ trans('global.customer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.customer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.customer.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.mobile_number') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.address') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.city') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.pincode') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.referred_by') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr data-entry-id="{{ $customer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $customer->name ?? '' }}
                            </td>
                            <td>
                                {{ $customer->mobile_number ?? '' }}
                            </td>
                            <td>
                                {{ $customer->email ?? '' }}
                            </td>
                            <td>
                                {{ $customer->address ?? '' }}
                            </td>
                            <td>
                                {{ $customer->city ?? '' }}
                            </td>
                            <td>
                                {{ $customer->pincode ?? '' }}
                            </td>
                            <td>
                                {{ $customer->referred_by ?? '' }}
                            </td>
                            <td>
                                {{ $customer->status ?? '' }}
                            </td>
                            <td>
                                @can('customer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('customer.show', $customer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('customer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('customer.edit', $customer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('customer_delete')
                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('customer.massDestroy') }}",
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