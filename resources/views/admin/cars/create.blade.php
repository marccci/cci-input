@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.car.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="creator_id">{{ trans('cruds.car.fields.creator') }}</label>
                <select class="form-control select2 {{ $errors->has('creator') ? 'is-invalid' : '' }}" name="creator_id" id="creator_id" required>
                    @foreach($creators as $id => $creator)
                        <option value="{{ $id }}" {{ old('creator_id') == $id ? 'selected' : '' }}>{{ $creator }}</option>
                    @endforeach
                </select>
                @if($errors->has('creator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('creator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.creator_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.car.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="carmodel">{{ trans('cruds.car.fields.carmodel') }}</label>
                <input class="form-control {{ $errors->has('carmodel') ? 'is-invalid' : '' }}" type="text" name="carmodel" id="carmodel" value="{{ old('carmodel', '') }}">
                @if($errors->has('carmodel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('carmodel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.carmodel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="manufacturer_id">{{ trans('cruds.car.fields.manufacturer') }}</label>
                <select class="form-control select2 {{ $errors->has('manufacturer') ? 'is-invalid' : '' }}" name="manufacturer_id" id="manufacturer_id" required>
                    @foreach($manufacturers as $id => $manufacturer)
                        <option value="{{ $id }}" {{ old('manufacturer_id') == $id ? 'selected' : '' }}>{{ $manufacturer }}</option>
                    @endforeach
                </select>
                @if($errors->has('manufacturer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manufacturer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.manufacturer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="engine">{{ trans('cruds.car.fields.engine') }}</label>
                <input class="form-control {{ $errors->has('engine') ? 'is-invalid' : '' }}" type="text" name="engine" id="engine" value="{{ old('engine', '') }}" required>
                @if($errors->has('engine'))
                    <div class="invalid-feedback">
                        {{ $errors->first('engine') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.engine_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.car.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.cars.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($car) && $car->image)
      var file = {!! json_encode($car->image) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection