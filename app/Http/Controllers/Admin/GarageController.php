<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGarageRequest;
use App\Http\Requests\StoreGarageRequest;
use App\Http\Requests\UpdateGarageRequest;
use App\Models\Garage;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GarageController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('garage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garages = Garage::all();

        $users = User::get();

        $teams = Team::get();

        return view('admin.garages.index', compact('garages', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('garage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.garages.create', compact('users'));
    }

    public function store(StoreGarageRequest $request)
    {
        $garage = Garage::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        foreach ($request->input('images', []) as $file) {
            $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $garage->id]);
        }

        return redirect()->route('admin.garages.index');
    }

    public function edit(Garage $garage)
    {
        abort_if(Gate::denies('garage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $garage->load('user', 'team');

        return view('admin.garages.edit', compact('users', 'garage'));
    }

    public function update(UpdateGarageRequest $request, Garage $garage)
    {
        $garage->update($request->all());

        if (count($garage->files) > 0) {
            foreach ($garage->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $garage->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        if (count($garage->images) > 0) {
            foreach ($garage->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $garage->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.garages.index');
    }

    public function show(Garage $garage)
    {
        abort_if(Gate::denies('garage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garage->load('user', 'team');

        return view('admin.garages.show', compact('garage'));
    }

    public function destroy(Garage $garage)
    {
        abort_if(Gate::denies('garage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garage->delete();

        return back();
    }

    public function massDestroy(MassDestroyGarageRequest $request)
    {
        Garage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('garage_create') && Gate::denies('garage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Garage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
