@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.car.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.cars.update", [$car->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="creator_id">{{ trans('cruds.car.fields.creator') }}</label>
                            <select class="form-control select2" name="creator_id" id="creator_id" required>
                                @foreach($creators as $id => $creator)
                                    <option value="{{ $id }}" {{ (old('creator_id') ? old('creator_id') : $car->creator->id ?? '') == $id ? 'selected' : '' }}>{{ $creator }}</option>
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
                            <label class="required" for="owner_id">{{ trans('cruds.car.fields.owner') }}</label>
                            <select class="form-control select2" name="owner_id" id="owner_id" required>
                                @foreach($owners as $id => $owner)
                                    <option value="{{ $id }}" {{ (old('owner_id') ? old('owner_id') : $car->owner->id ?? '') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.owner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.car.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $car->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="carmodel">{{ trans('cruds.car.fields.carmodel') }}</label>
                            <input class="form-control" type="text" name="carmodel" id="carmodel" value="{{ old('carmodel', $car->carmodel) }}">
                            @if($errors->has('carmodel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('carmodel') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.carmodel_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="manufacturer_id">{{ trans('cruds.car.fields.manufacturer') }}</label>
                            <select class="form-control select2" name="manufacturer_id" id="manufacturer_id" required>
                                @foreach($manufacturers as $id => $manufacturer)
                                    <option value="{{ $id }}" {{ (old('manufacturer_id') ? old('manufacturer_id') : $car->manufacturer->id ?? '') == $id ? 'selected' : '' }}>{{ $manufacturer }}</option>
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
                            <input class="form-control" type="text" name="engine" id="engine" value="{{ old('engine', $car->engine) }}" required>
                            @if($errors->has('engine'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('engine') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.engine_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file">{{ trans('cruds.car.fields.file') }}</label>
                            <div class="needsclick dropzone" id="file-dropzone">
                            </div>
                            @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.car.fields.file_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.car.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
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

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('admin.cars.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($car) && $car->file)
          var files =
            {!! json_encode($car->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
            }
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
<script>
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.cars.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($car) && $car->image)
          var files =
            {!! json_encode($car->image) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
            }
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