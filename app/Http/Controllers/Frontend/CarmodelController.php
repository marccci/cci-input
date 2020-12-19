<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarmodelRequest;
use App\Http\Requests\StoreCarmodelRequest;
use App\Http\Requests\UpdateCarmodelRequest;
use App\Models\Car;
use App\Models\Carmodel;
use App\Models\Manufacturer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarmodelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carmodel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodels = Carmodel::with(['creator', 'owner', 'manufacturer', 'cars'])->get();

        $users = User::get();

        $manufacturers = Manufacturer::get();

        $cars = Car::get();

        return view('frontend.carmodels.index', compact('carmodels', 'users', 'manufacturers', 'cars'));
    }

    public function create()
    {
        abort_if(Gate::denies('carmodel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        return view('frontend.carmodels.create', compact('creators', 'owners', 'manufacturers', 'cars'));
    }

    public function store(StoreCarmodelRequest $request)
    {
        $carmodel = Carmodel::create($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return redirect()->route('frontend.carmodels.index');
    }

    public function edit(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        $carmodel->load('creator', 'owner', 'manufacturer', 'cars');

        return view('frontend.carmodels.edit', compact('creators', 'owners', 'manufacturers', 'cars', 'carmodel'));
    }

    public function update(UpdateCarmodelRequest $request, Carmodel $carmodel)
    {
        $carmodel->update($request->all());
        $carmodel->cars()->sync($request->input('cars', []));

        return redirect()->route('frontend.carmodels.index');
    }

    public function show(Carmodel $carmodel)
    {
        abort_if(Gate::denies('carmodel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carmodel->load('creator', 'owner', 'manufacturer', 'cars');

        return view('frontend.carmodels.show', compact('carmodel'));
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
