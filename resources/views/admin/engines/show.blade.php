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
                            {{ trans('cruds.engine.fields.creator') }}
                        </th>
                        <td>
                            {{ $engine->creator->name ?? '' }}
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