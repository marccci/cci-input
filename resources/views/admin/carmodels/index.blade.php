@extends('layouts.admin')
@section('content')
@can('carmodel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.carmodels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.carmodel.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.carmodel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Carmodel">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.creator') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.owner') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.manufacturer') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.car') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.first_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.carmodel.fields.last_year') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($manufacturers as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($cars as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carmodels as $key => $carmodel)
                        <tr data-entry-id="{{ $carmodel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $carmodel->id ?? '' }}
                            </td>
                            <td>
                                {{ $carmodel->creator->name ?? '' }}
                            </td>
                            <td>
                                {{ $carmodel->owner->name ?? '' }}
                            </td>
                            <td>
                                {{ $carmodel->name ?? '' }}
                            </td>
                            <td>
                                {{ $carmodel->manufacturer->name ?? '' }}
                            </td>
                            <td>
                                @foreach($carmodel->cars as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $carmodel->first_year ?? '' }}
                            </td>
                            <td>
                                {{ $carmodel->last_year ?? '' }}
                            </td>
                            <td>
                                @can('carmodel_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.carmodels.show', $carmodel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('carmodel_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.carmodels.edit', $carmodel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('carmodel_delete')
                                    <form action="{{ route('admin.carmodels.destroy', $carmodel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('carmodel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.carmodels.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Carmodel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
})

</script>
@endsection