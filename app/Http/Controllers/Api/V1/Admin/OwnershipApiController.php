<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOwnershipRequest;
use App\Http\Requests\UpdateOwnershipRequest;
use App\Http\Resources\Admin\OwnershipResource;
use App\Models\Ownership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnershipApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ownership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnershipResource(Ownership::all());
    }

    public function store(StoreOwnershipRequest $request)
    {
        $ownership = Ownership::create($request->all());

        return (new OwnershipResource($ownership))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ownership $ownership)
    {
        abort_if(Gate::denies('ownership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnershipResource($ownership);
    }

    public function update(UpdateOwnershipRequest $request, Ownership $ownership)
    {
        $ownership->update($request->all());

        return (new OwnershipResource($ownership))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ownership $ownership)
    {
        abort_if(Gate::denies('ownership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownership->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
