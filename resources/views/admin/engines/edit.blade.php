@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.engine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.engines.update", [$engine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="creator_id">{{ trans('cruds.engine.fields.creator') }}</label>
                <select class="form-control select2 {{ $errors->has('creator') ? 'is-invalid' : '' }}" name="creator_id" id="creator_id" required>
                    @foreach($creators as $id => $creator)
                        <option value="{{ $id }}" {{ (old('creator_id') ? old('creator_id') : $engine->creator->id ?? '') == $id ? 'selected' : '' }}>{{ $creator }}</option>
                    @endforeach
                </select>
                @if($errors->has('creator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('creator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.creator_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="owner_id">{{ trans('cruds.engine.fields.owner') }}</label>
                <select class="form-control select2 {{ $errors->has('owner') ? 'is-invalid' : '' }}" name="owner_id" id="owner_id" required>
                    @foreach($owners as $id => $owner)
                        <option value="{{ $id }}" {{ (old('owner_id') ? old('owner_id') : $engine->owner->id ?? '') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                    @endforeach
                </select>
                @if($errors->has('owner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.owner_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.engine.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $engine->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.engine.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $engine->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="manufacturer_id">{{ trans('cruds.engine.fields.manufacturer') }}</label>
                <select class="form-control select2 {{ $errors->has('manufacturer') ? 'is-invalid' : '' }}" name="manufacturer_id" id="manufacturer_id" required>
                    @foreach($manufacturers as $id => $manufacturer)
                        <option value="{{ $id }}" {{ (old('manufacturer_id') ? old('manufacturer_id') : $engine->manufacturer->id ?? '') == $id ? 'selected' : '' }}>{{ $manufacturer }}</option>
                    @endforeach
                </select>
                @if($errors->has('manufacturer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manufacturer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.manufacturer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cylinder_number">{{ trans('cruds.engine.fields.cylinder_number') }}</label>
                <input class="form-control {{ $errors->has('cylinder_number') ? 'is-invalid' : '' }}" type="number" name="cylinder_number" id="cylinder_number" value="{{ old('cylinder_number', $engine->cylinder_number) }}" step="1" required>
                @if($errors->has('cylinder_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cylinder_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.cylinder_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="engine_power">{{ trans('cruds.engine.fields.engine_power') }}</label>
                <input class="form-control {{ $errors->has('engine_power') ? 'is-invalid' : '' }}" type="number" name="engine_power" id="engine_power" value="{{ old('engine_power', $engine->engine_power) }}" step="1" required>
                @if($errors->has('engine_power'))
                    <div class="invalid-feedback">
                        {{ $errors->first('engine_power') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.engine_power_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.engine.fields.engine_power_units') }}</label>
                @foreach(App\Models\Engine::ENGINE_POWER_UNITS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('engine_power_units') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="engine_power_units_{{ $key }}" name="engine_power_units" value="{{ $key }}" {{ old('engine_power_units', $engine->engine_power_units) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="engine_power_units_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('engine_power_units'))
                    <div class="invalid-feedback">
                        {{ $errors->first('engine_power_units') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.engine_power_units_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="engine_size">{{ trans('cruds.engine.fields.engine_size') }}</label>
                <input class="form-control {{ $errors->has('engine_size') ? 'is-invalid' : '' }}" type="number" name="engine_size" id="engine_size" value="{{ old('engine_size', $engine->engine_size) }}" step="1" required>
                @if($errors->has('engine_size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('engine_size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.engine_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.engine.fields.engine_size_units') }}</label>
                @foreach(App\Models\Engine::ENGINE_SIZE_UNITS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('engine_size_units') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="engine_size_units_{{ $key }}" name="engine_size_units" value="{{ $key }}" {{ old('engine_size_units', $engine->engine_size_units) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="engine_size_units_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('engine_size_units'))
                    <div class="invalid-feedback">
                        {{ $errors->first('engine_size_units') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.engine_size_units_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bore">{{ trans('cruds.engine.fields.bore') }}</label>
                <input class="form-control {{ $errors->has('bore') ? 'is-invalid' : '' }}" type="number" name="bore" id="bore" value="{{ old('bore', $engine->bore) }}" step="0.001" required>
                @if($errors->has('bore'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bore') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.bore_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="stroke">{{ trans('cruds.engine.fields.stroke') }}</label>
                <input class="form-control {{ $errors->has('stroke') ? 'is-invalid' : '' }}" type="number" name="stroke" id="stroke" value="{{ old('stroke', $engine->stroke) }}" step="0.01" required>
                @if($errors->has('stroke'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stroke') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.stroke_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.engine.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images">{{ trans('cruds.engine.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.images_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.engine.fields.block_config') }}</label>
                @foreach(App\Models\Engine::BLOCK_CONFIG_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('block_config') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="block_config_{{ $key }}" name="block_config" value="{{ $key }}" {{ old('block_config', $engine->block_config) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="block_config_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('block_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('block_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.block_config_helper') }}</span>
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
    Dropzone.options.filesDropzone = {
    url: '{{ route('admin.engines.storeMedia') }}',
    maxFilesize: 15, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').find('input[name="files"]').remove()
      $('form').append('<input type="hidden" name="files" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="files"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($engine) && $engine->files)
      var file = {!! json_encode($engine->files) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="files" value="' + file.file_name + '">')
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
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.engines.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($engine) && $engine->images)
      var files = {!! json_encode($engine->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
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