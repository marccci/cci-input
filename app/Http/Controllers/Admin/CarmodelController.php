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
use Yajra\DataTables\Facades\DataTables;

class CarmodelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('carmodel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Carmodel::with(['manufacturer', 'cars', 'team'])->select(sprintf('%s.*', (new Carmodel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'carmodel_show';
                $editGate      = 'carmodel_edit';
                $deleteGate    = 'carmodel_delete';
                $crudRoutePart = 'carmodels';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('manufacturer_name', function ($row) {
                return $row->manufacturer ? $row->manufacturer->name : '';
            });

            $table->editColumn('car', function ($row) {
                $labels = [];

                foreach ($row->cars as $car) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $car->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'manufacturer', 'car']);

            return $table->make(true);
        }

        $manufacturers = Manufacturer::get();
        $cars          = Car::get();
        $teams         = Team::get();

        return view('admin.carmodels.index', compact('manufacturers', 'cars', 'teams'));
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
