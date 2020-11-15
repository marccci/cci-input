@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.carmodel.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.carmodels.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="creator_id">{{ trans('cruds.carmodel.fields.creator') }}</label>
                            <select class="form-control select2" name="creator_id" id="creator_id" required>
                                @foreach($creators as $id => $creator)
                                    <option value="{{ $id }}" {{ old('creator_id') == $id ? 'selected' : '' }}>{{ $creator }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('creator'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('creator') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.creator_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="owner_id">{{ trans('cruds.carmodel.fields.owner') }}</label>
                            <select class="form-control select2" name="owner_id" id="owner_id" required>
                                @foreach($owners as $id => $owner)
                                    <option value="{{ $id }}" {{ old('owner_id') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.owner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.carmodel.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="manufacturer_id">{{ trans('cruds.carmodel.fields.manufacturer') }}</label>
                            <select class="form-control select2" name="manufacturer_id" id="manufacturer_id">
                                @foreach($manufacturers as $id => $manufacturer)
                                    <option value="{{ $id }}" {{ old('manufacturer_id') == $id ? 'selected' : '' }}>{{ $manufacturer }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('manufacturer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('manufacturer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.manufacturer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cars">{{ trans('cruds.carmodel.fields.car') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="cars[]" id="cars" multiple>
                                @foreach($cars as $id => $car)
                                    <option value="{{ $id }}" {{ in_array($id, old('cars', [])) ? 'selected' : '' }}>{{ $car }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cars'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cars') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.car_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="first_year">{{ trans('cruds.carmodel.fields.first_year') }}</label>
                            <input class="form-control date" type="text" name="first_year" id="first_year" value="{{ old('first_year') }}" required>
                            @if($errors->has('first_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.first_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="last_year">{{ trans('cruds.carmodel.fields.last_year') }}</label>
                            <input class="form-control date" type="text" name="last_year" id="last_year" value="{{ old('last_year') }}" required>
                            @if($errors->has('last_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carmodel.fields.last_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection