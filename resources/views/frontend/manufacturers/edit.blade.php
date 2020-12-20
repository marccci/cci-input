@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.manufacturer.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.manufacturers.update", [$manufacturer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="creator_id">{{ trans('cruds.manufacturer.fields.creator') }}</label>
                            <select class="form-control select2" name="creator_id" id="creator_id" required>
                                @foreach($creators as $id => $creator)
                                    <option value="{{ $id }}" {{ (old('creator_id') ? old('creator_id') : $manufacturer->creator->id ?? '') == $id ? 'selected' : '' }}>{{ $creator }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('creator'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('creator') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.creator_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="owner_id">{{ trans('cruds.manufacturer.fields.owner') }}</label>
                            <select class="form-control select2" name="owner_id" id="owner_id" required>
                                @foreach($owners as $id => $owner)
                                    <option value="{{ $id }}" {{ (old('owner_id') ? old('owner_id') : $manufacturer->owner->id ?? '') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.owner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.manufacturer.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $manufacturer->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.manufacturer.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $manufacturer->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="logo">{{ trans('cruds.manufacturer.fields.logo') }}</label>
                            <div class="needsclick dropzone" id="logo-dropzone">
                            </div>
                            @if($errors->has('logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.manufacturer.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="country">{{ trans('cruds.manufacturer.fields.country') }}</label>
                            <input class="form-control" type="text" name="country" id="country" value="{{ old('country', $manufacturer->country) }}" required>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country_code">{{ trans('cruds.manufacturer.fields.country_code') }}</label>
                            <input class="form-control" type="text" name="country_code" id="country_code" value="{{ old('country_code', $manufacturer->country_code) }}">
                            @if($errors->has('country_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.country_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="first_year">{{ trans('cruds.manufacturer.fields.first_year') }}</label>
                            <input class="form-control" type="number" name="first_year" id="first_year" value="{{ old('first_year', $manufacturer->first_year) }}" step="1" required>
                            @if($errors->has('first_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.first_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="last_year">{{ trans('cruds.manufacturer.fields.last_year') }}</label>
                            <input class="form-control" type="number" name="last_year" id="last_year" value="{{ old('last_year', $manufacturer->last_year) }}" step="1" required>
                            @if($errors->has('last_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manufacturer.fields.last_year_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.manufacturers.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($manufacturer) && $manufacturer->logo)
      var file = {!! json_encode($manufacturer->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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
<script>
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.manufacturers.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
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
@if(isset($manufacturer) && $manufacturer->image)
      var files = {!! json_encode($manufacturer->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
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