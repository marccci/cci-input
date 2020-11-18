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
use App\Models\User;
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
            $query = Carmodel::with(['creator', 'owner', 'manufacturer', 'cars', 'team'])->select(sprintf('%s.*', (new Carmodel)->table));
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
            $table->addColumn('creator_name', function ($row) {
                return $row->creator ? $row->creator->name : '';
            });

            $table->addColumn('owner_name', function ($row) {
                return $row->owner ? $row->owner->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'creator', 'owner', 'manufacturer', 'car']);

            return $table->make(true);
        }

        $users         = User::get();
        $users         = User::get();
        $manufacturers = Manufacturer::get();
        $cars          = Car::get();
        $teams         = Team::get();

        return view('admin.carmodels.index', compact('users', 'users', 'manufacturers', 'cars', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('carmodel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        return view('admin.carmodels.create', compact('creators', 'owners', 'manufacturers', 'cars'));
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

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id');

        $carmodel->load('creator', 'owner', 'manufacturer', 'cars', 'team');

        return view('admin.carmodels.edit', compact('creators', 'owners', 'manufacturers', 'cars', 'carmodel'));
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

        $carmodel->load('creator', 'owner', 'manufacturer', 'cars', 'team');

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
