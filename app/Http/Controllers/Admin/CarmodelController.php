<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarmodelRequest;
use App\Http\Requests\StoreCarmodelRequest;
use App\Http\Requests\UpdateCarmodelRequest;
use App\Models\Car;
use App\Models\Carmodel;
use App\Models\Manufacturer;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarmodelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carmodel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodels = Carmodel::all();

        $manufacturers = Manufacturer::get();

        $cars = Car::get();

        $teams = Team::get();

        return view('admin.carmodels.index', compact('carmodels', 'manufacturers', 'cars', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('carmodel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        return view('admin.carmodels.create', compact('manufacturers', 'cars'));
    }

    public function store(StoreCarmodelRequest $request)
    {
        $carmodel = Carmodel::create($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return redirect()->route('admin.carmodels.index');
    }

    public function edit(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        $carmodel->load('manufacturer', 'cars', 'team');

        return view('admin.carmodels.edit', compact('manufacturers', 'cars', 'carmodel'));
    }

    public function update(UpdateCarmodelRequest $request, Carmodel $carmodel)
    {
        $carmodel->update($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return redirect()->route('admin.carmodels.index');
    }

    public function show(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodel->load('manufacturer', 'cars', 'team');

        return view('admin.carmodels.show', compact('carmodel'));
    }

    public function destroy(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodel->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarmodelRequest $request)
    {
        Carmodel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
