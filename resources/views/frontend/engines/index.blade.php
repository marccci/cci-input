@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('engine_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.engines.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Engine">
                            <thead>
                                <tr>
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
                                                <option value="{{ $item }}">{{ $item }}</option>
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
                                                <option value="{{ $item }}">{{ $item }}</option>
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
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($engines as $key => $engine)
                                    <tr data-entry-id="{{ $engine->id }}">
                                        <td>
                                            {{ $engine->creator->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->owner->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->manufacturer->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->cylinder_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->engine_power ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Engine::ENGINE_POWER_UNITS_RADIO[$engine->engine_power_units] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->engine_size ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Engine::ENGINE_SIZE_UNITS_RADIO[$engine->engine_size_units] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->bore ?? '' }}
                                        </td>
                                        <td>
                                            {{ $engine->stroke ?? '' }}
                                        </td>
                                        <td>
                                            @if($engine->files)
                                                <a href="{{ $engine->files->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($engine->images as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\Engine::BLOCK_CONFIG_RADIO[$engine->block_config] ?? '' }}
                                        </td>
                                        <td>
                                            @can('engine_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.engines.show', $engine->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('engine_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.engines.edit', $engine->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('engine_delete')
                                                <form action="{{ route('frontend.engines.destroy', $engine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('engine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.engines.massDestroy') }}",
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
  let table = $('.datatable-Engine:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
})

</script>
@endsection