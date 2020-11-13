@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.manufacturer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manufacturers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.id') }}
                        </th>
                        <td>
                            {{ $manufacturer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.creator') }}
                        </th>
                        <td>
                            {{ $manufacturer->creator->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.name') }}
                        </th>
                        <td>
                            {{ $manufacturer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.description') }}
                        </th>
                        <td>
                            {{ $manufacturer->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.image') }}
                        </th>
                        <td>
                            @foreach($manufacturer->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.country') }}
                        </th>
                        <td>
                            {{ $manufacturer->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.logo') }}
                        </th>
                        <td>
                            @if($manufacturer->logo)
                                <a href="{{ $manufacturer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $manufacturer->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.first_year') }}
                        </th>
                        <td>
                            {{ $manufacturer->first_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.last_year') }}
                        </th>
                        <td>
                            {{ $manufacturer->last_year }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manufacturers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#manufacturer_engines" role="tab" data-toggle="tab">
                {{ trans('cruds.engine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#manufacturer_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="manufacturer_engines">
            @includeIf('admin.manufacturers.relationships.manufacturerEngines', ['engines' => $manufacturer->manufacturerEngines])
        </div>
        <div class="tab-pane" role="tabpanel" id="manufacturer_cars">
            @includeIf('admin.manufacturers.relationships.manufacturerCars', ['cars' => $manufacturer->manufacturerCars])
        </div>
    </div>
</div>

@endsection