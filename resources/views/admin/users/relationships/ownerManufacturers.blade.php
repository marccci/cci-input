@can('manufacturer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.manufacturers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.manufacturer.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.manufacturer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ownerManufacturers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.creator') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.owner') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.country_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.first_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.manufacturer.fields.last_year') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manufacturers as $key => $manufacturer)
                        <tr data-entry-id="{{ $manufacturer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $manufacturer->id ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->creator->name ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->owner->name ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->name ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->description ?? '' }}
                            </td>
                            <td>
                                @if($manufacturer->logo)
                                    <a href="{{ $manufacturer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $manufacturer->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($manufacturer->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $manufacturer->country ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->country_code ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->first_year ?? '' }}
                            </td>
                            <td>
                                {{ $manufacturer->last_year ?? '' }}
                            </td>
                            <td>
                                @can('manufacturer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.manufacturers.show', $manufacturer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('manufacturer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('manufacturer_delete')
                                    <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('manufacturer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.manufacturers.massDestroy') }}",
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
  let table = $('.datatable-ownerManufacturers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection