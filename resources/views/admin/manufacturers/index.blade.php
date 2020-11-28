@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Manufacturer">
            <thead>
                <tr>
                    <th width="10">

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
                    </td>
                    <td>
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
@can('manufacturer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.manufacturers.massDestroy') }}",
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
    ajax: "{{ route('admin.manufacturers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'creator_name', name: 'creator.name' },
{ data: 'owner_name', name: 'owner.name' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'logo', name: 'logo', sortable: false, searchable: false },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'country', name: 'country' },
{ data: 'country_code', name: 'country_code' },
{ data: 'first_year', name: 'first_year' },
{ data: 'last_year', name: 'last_year' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Manufacturer').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection