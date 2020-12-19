<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEngineRequest;
use App\Http\Requests\UpdateEngineRequest;
use App\Http\Resources\Admin\EngineResource;
use App\Models\Engine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnginesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('engine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EngineResource(Engine::with(['creator', 'owner', 'manufacturer'])->get());
    }

    public function store(StoreEngineRequest $request)
    {
        $engine = Engine::create($request->all());

        if ($request->input('files', false)) {
            $engine->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        if ($request->input('images', false)) {
            $engine->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
        }

        return (new EngineResource($engine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Engine $engine)
    {
        abort_if(Gate::denies('engine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EngineResource($engine->load(['creator', 'owner', 'manufacturer']));
    }

    public function update(UpdateEngineRequest $request, Engine $engine)
    {
        $engine->update($request->all());

        if ($request->input('files', false)) {
            if (!$engine->files || $request->input('files') !== $engine->files->file_name) {
                if ($engine->files) {
                    $engine->files->delete();
                }

                $engine->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($engine->files) {
            $engine->files->delete();
        }

        if ($request->input('images', false)) {
            if (!$engine->images || $request->input('images') !== $engine->images->file_name) {
                if ($engine->images) {
                    $engine->images->delete();
                }

                $engine->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
            }
        } elseif ($engine->images) {
            $engine->images->delete();
        }

        return (new EngineResource($engine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Engine $engine)
    {
        abort_if(Gate::denies('engine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
