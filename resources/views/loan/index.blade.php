@extends('layouts.admin')
@section('content')
@can('loan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("loan.create") }}">
                {{ trans('global.add') }} {{ trans('global.loan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.loan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.loan.fields.customer_id') }}
                        </th>
                        <th>
                            {{ trans('global.loan.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('global.loan.fields.salary') }}
                        </th>
                        <th>
                            {{ trans('global.loan.fields.location') }}
                        </th>
                        <th>
                            {{ trans('global.loan.fields.message') }}
                        </th>
                        <th>
                            {{ trans('global.loan.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $key => $loan)
                        <tr data-entry-id="{{ $loan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loan->customer_id ?? '' }}
                            </td>
                            <td>
                                {{ $loan->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $loan->salary ?? '' }}
                            </td>
                            <td>
                                {{ $loan->location ?? '' }}
                            </td>
                            <td>
                                {{ $loan->message ?? '' }}
                            </td>
                            <td>
                                {{ $loan->status ?? '' }}
                            </td>

                            <td>
                                @can('loan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('loan.show', $loan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('loan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('loan.edit', $loan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('loan_delete')
                                    <form action="{{ route('loan.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('loan.massDestroy') }}",
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