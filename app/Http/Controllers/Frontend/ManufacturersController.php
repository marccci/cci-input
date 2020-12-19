<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManufacturerRequest;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ManufacturersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('manufacturer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = Manufacturer::with(['creator', 'owner', 'team', 'media'])->get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.manufacturers.index', compact('manufacturers', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('manufacturer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.manufacturers.create', compact('creators', 'owners'));
    }

    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        if ($request->input('logo', false)) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        foreach ($request->input('image', []) as $file) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $manufacturer->id]);
        }

        return redirect()->route('frontend.manufacturers.index');
    }

    public function edit(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturer->load('creator', 'owner', 'team');

        return view('frontend.manufacturers.edit', compact('creators', 'owners', 'manufacturer'));
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());

        if ($request->input('logo', false)) {
            if (!$manufacturer->logo || $request->input('logo') !== $manufacturer->logo->file_name) {
                if ($manufacturer->logo) {
                    $manufacturer->logo->delete();
                }

                $manufacturer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($manufacturer->logo) {
            $manufacturer->logo->delete();
        }

        if (count($manufacturer->image) > 0) {
            foreach ($manufacturer->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $manufacturer->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $manufacturer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('frontend.manufacturers.index');
    }

    public function show(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->load('creator', 'owner', 'team', 'manufacturerEngines', 'manufacturerCars');

        return view('frontend.manufacturers.show', compact('manufacturer'));
    }

    public function destroy(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->delete();

        return back();
    }

    public function massDestroy(MassDestroyManufacturerRequest $request)
    {
        Manufacturer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('manufacturer_create') && Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Manufacturer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
