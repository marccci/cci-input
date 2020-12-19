<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class CarsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Car::with(['creator', 'owner', 'manufacturer'])->select(sprintf('%s.*', (new Car)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'car_show';
                $editGate      = 'car_edit';
                $deleteGate    = 'car_delete';
                $crudRoutePart = 'cars';

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

            $table->addColumn('manufacturer_name', function ($row) {
                return $row->manufacturer ? $row->manufacturer->name : '';
            });

            $table->editColumn('carmodel', function ($row) {
                return $row->carmodel ? $row->carmodel : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('engine', function ($row) {
                return $row->engine ? $row->engine : "";
            });
            $table->editColumn('file', function ($row) {
                if (!$row->file) {
                    return '';
                }

                $links = [];

                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'creator', 'owner', 'manufacturer', 'file', 'image']);

            return $table->make(true);
        }

        $users         = User::get();
        $users         = User::get();
        $manufacturers = Manufacturer::get();

        return view('admin.cars.index', compact('users', 'users', 'manufacturers'));
    }

    public function create()
    {
        abort_if(Gate::denies('car_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cars.create', compact('creators', 'owners', 'manufacturers'));
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

        return redirect()->route('admin.cars.index');
    }

    public function edit(Car $car)
    {
        abort_if(Gate::denies('car_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $car->load('creator', 'owner', 'manufacturer');

        return view('admin.cars.edit', compact('creators', 'owners', 'manufacturers', 'car'));
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

        return redirect()->route('admin.cars.index');
    }

    public function show(Car $car)
    {
        abort_if(Gate::denies('car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $car->load('creator', 'owner', 'manufacturer');

        return view('admin.cars.show', compact('car'));
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
