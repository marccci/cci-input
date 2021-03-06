@extends('layouts.admin')
@section('content')
@can('engine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.engines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.engine.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.engine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Engine">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.creator') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.owner') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.manufacturer') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.cylinder_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.engine_power') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.engine_power_units') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.engine_size') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.engine_size_units') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.bore') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.stroke') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.files') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.images') }}
                    </th>
                    <th>
                        {{ trans('cruds.engine.fields.block_config') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Engine::ENGINE_POWER_UNITS_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Engine::ENGINE_SIZE_UNITS_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Engine::BLOCK_CONFIG_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('engine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.engines.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.engines.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'creator_name', name: 'creator.name' },
{ data: 'owner_name', name: 'owner.name' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'manufacturer_name', name: 'manufacturer.name' },
{ data: 'cylinder_number', name: 'cylinder_number' },
{ data: 'engine_power', name: 'engine_power' },
{ data: 'engine_power_units', name: 'engine_power_units' },
{ data: 'engine_size', name: 'engine_size' },
{ data: 'engine_size_units', name: 'engine_size_units' },
{ data: 'bore', name: 'bore' },
{ data: 'stroke', name: 'stroke' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'images', name: 'images', sortable: false, searchable: false },
{ data: 'block_config', name: 'block_config' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Engine').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection