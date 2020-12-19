<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCarRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\Manufacturer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CarsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cars = Car::with(['creator', 'owner', 'manufacturer', 'media'])->get();

        $users = User::get();

        $manufacturers = Manufacturer::get();

        return view('frontend.cars.index', compact('cars', 'users', 'manufacturers'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.cars.create', compact('creators', 'owners', 'manufacturers'));
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file');
        }

        foreach ($request->input('image', []) as $file) {
            $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $car->id]);
        }

        return redirect()->route('frontend.cars.index');
    }

    public function edit(Car $car)
    {
        abort_if(Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $car->load('creator', 'owner', 'manufacturer');

        return view('frontend.cars.edit', compact('creators', 'owners', 'manufacturers', 'car'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->all());

        if (count($car->file) > 0) {
            foreach ($car->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }

        $media = $car->file->pluck('file_name')->toArray();

        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file');
            }
        }

        if (count($car->image) > 0) {
            foreach ($car->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $car->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $car->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('frontend.cars.index');
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->load('creator', 'owner', 'manufacturer');

        return view('frontend.cars.show', compact('car'));
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarRequest $request)
    {
        Car::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('car_create') && Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Car();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
