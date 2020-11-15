<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarmodelRequest;
use App\Http\Requests\UpdateCarmodelRequest;
use App\Http\Resources\Admin\CarmodelResource;
use App\Models\Carmodel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarmodelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carmodel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarmodelResource(Carmodel::with(['manufacturer', 'cars', 'team'])->get());
    }

    public function store(StoreCarmodelRequest $request)
    {
        $carmodel = Carmodel::create($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return (new CarmodelResource($carmodel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarmodelResource($carmodel->load(['manufacturer', 'cars', 'team']));
    }

    public function update(UpdateCarmodelRequest $request, Carmodel $carmodel)
    {
        $carmodel->update($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return (new CarmodelResource($carmodel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
