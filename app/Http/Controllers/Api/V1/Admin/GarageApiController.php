<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGarageRequest;
use App\Http\Requests\UpdateGarageRequest;
use App\Http\Resources\Admin\GarageResource;
use App\Models\Garage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GarageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('garage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GarageResource(Garage::with(['user', 'team'])->get());
    }

    public function store(StoreGarageRequest $request)
    {
        $garage = Garage::create($request->all());

        if ($request->input('files', false)) {
            $garage->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        if ($request->input('images', false)) {
            $garage->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
        }

        return (new GarageResource($garage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Garage $garage)
    {
        abort_if(Gate::denies('garage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GarageResource($garage->load(['user', 'team']));
    }

    public function update(UpdateGarageRequest $request, Garage $garage)
    {
        $garage->update($request->all());

        if ($request->input('files', false)) {
            if (!$garage->files || $request->input('files') !== $garage->files->file_name) {
                if ($garage->files) {
                    $garage->files->delete();
                }

                $garage->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($garage->files) {
            $garage->files->delete();
        }

        if ($request->input('images', false)) {
            if (!$garage->images || $request->input('images') !== $garage->images->file_name) {
                if ($garage->images) {
                    $garage->images->delete();
                }

                $garage->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
            }
        } elseif ($garage->images) {
            $garage->images->delete();
        }

        return (new GarageResource($garage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Garage $garage)
    {
        abort_if(Gate::denies('garage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
