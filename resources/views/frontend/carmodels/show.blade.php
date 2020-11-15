@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.carmodel.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.carmodels.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.creator') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->creator->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.owner') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->owner->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.manufacturer') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->manufacturer->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.car') }}
                                    </th>
                                    <td>
                                        @foreach($carmodel->cars as $key => $car)
                                            <span class="label label-info">{{ $car->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.first_year') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->first_year }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carmodel.fields.last_year') }}
                                    </th>
                                    <td>
                                        {{ $carmodel->last_year }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.carmodels.index') }}">
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