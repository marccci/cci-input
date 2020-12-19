<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\Admin\CarResource;
use App\Models\Car;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarResource(Car::with(['creator', 'owner', 'manufacturer'])->get());
    }

    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->all());

        if ($request->input('file', false)) {
            $car->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
        }

        if ($request->input('image', false)) {
            $car->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarResource($car->load(['creator', 'owner', 'manufacturer']));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->all());

        if ($request->input('file', false)) {
            if (!$car->file || $request->input('file') !== $car->file->file_name) {
                if ($car->file) {
                    $car->file->delete();
                }

                $car->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
            }
        } elseif ($car->file) {
            $car->file->delete();
        }

        if ($request->input('image', false)) {
            if (!$car->image || $request->input('image') !== $car->image->file_name) {
                if ($car->image) {
                    $car->image->delete();
                }

                $car->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($car->image) {
            $car->image->delete();
        }

        return (new CarResource($car))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Car $car)
    {
        abort_if(Gate::denies('car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
