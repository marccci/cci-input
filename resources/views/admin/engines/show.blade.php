@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.engine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.engines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.id') }}
                        </th>
                        <td>
                            {{ $engine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.name') }}
                        </th>
                        <td>
                            {{ $engine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.creator') }}
                        </th>
                        <td>
                            {{ $engine->creator->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.owner') }}
                        </th>
                        <td>
                            {{ $engine->owner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.description') }}
                        </th>
                        <td>
                            {{ $engine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.manufacturer') }}
                        </th>
                        <td>
                            {{ $engine->manufacturer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.cylinder_number') }}
                        </th>
                        <td>
                            {{ $engine->cylinder_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.block_config') }}
                        </th>
                        <td>
                            {{ $engine->block_config }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.power_units') }}
                        </th>
                        <td>
                            {{ $engine->power_units }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.engine_power') }}
                        </th>
                        <td>
                            {{ $engine->engine_power }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.engine_size') }}
                        </th>
                        <td>
                            {{ $engine->engine_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.engine_size_units') }}
                        </th>
                        <td>
                            {{ $engine->engine_size_units }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.bore') }}
                        </th>
                        <td>
                            {{ $engine->bore }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.stroke') }}
                        </th>
                        <td>
                            {{ $engine->stroke }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.files') }}
                        </th>
                        <td>
                            @if($engine->files)
                                <a href="{{ $engine->files->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.engine.fields.images') }}
                        </th>
                        <td>
                            @foreach($engine->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.engines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection