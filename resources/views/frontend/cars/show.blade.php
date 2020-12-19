@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.car.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.cars.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $car->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.creator') }}
                                    </th>
                                    <td>
                                        {{ $car->creator->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.owner') }}
                                    </th>
                                    <td>
                                        {{ $car->owner->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.manufacturer') }}
                                    </th>
                                    <td>
                                        {{ $car->manufacturer->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.carmodel') }}
                                    </th>
                                    <td>
                                        {{ $car->carmodel }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $car->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.engine') }}
                                    </th>
                                    <td>
                                        {{ $car->engine }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.file') }}
                                    </th>
                                    <td>
                                        @foreach($car->file as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.image') }}
                                    </th>
                                    <td>
                                        @foreach($car->image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.cars.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection