<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGarageRequest;
use App\Http\Requests\StoreGarageRequest;
use App\Http\Requests\UpdateGarageRequest;
use App\Models\Car;
use App\Models\Garage;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GarageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('garage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Garage::with(['user', 'car'])->select(sprintf('%s.*', (new Garage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'garage_show';
                $editGate      = 'garage_edit';
                $deleteGate    = 'garage_delete';
                $crudRoutePart = 'garages';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('files', function ($row) {
                if (!$row->files) {
                    return '';
                }

                $links = [];

                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('images', function ($row) {
                if (!$row->images) {
                    return '';
                }

                $links = [];

                foreach ($row->images as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->addColumn('car_name', function ($row) {
                return $row->car ? $row->car->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'files', 'images', 'car']);

            return $table->make(true);
        }

        $users = User::get();
        $cars  = Car::get();

        return view('admin.garages.index', compact('users', 'cars'));
    }

    public function create()
    {
        abort_if(Gate::denies('garage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.garages.create', compact('users', 'cars'));
    }

    public function store(StoreGarageRequest $request)
    {
        $garage = Garage::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        foreach ($request->input('images', []) as $file) {
            $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $garage->id]);
        }

        return redirect()->route('admin.garages.index');
    }

    public function edit(Garage $garage)
    {
        abort_if(Gate::denies('garage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $garage->load('user', 'car');

        return view('admin.garages.edit', compact('users', 'cars', 'garage'));
    }

    public function update(UpdateGarageRequest $request, Garage $garage)
    {
        $garage->update($request->all());

        if (count($garage->files) > 0) {
            foreach ($garage->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $garage->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        if (count($garage->images) > 0) {
            foreach ($garage->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $garage->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $garage->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.garages.index');
    }

    public function show(Garage $garage)
    {
        abort_if(Gate::denies('garage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garage->load('user', 'car');

        return view('admin.garages.show', compact('garage'));
    }

    public function destroy(Garage $garage)
    {
        abort_if(Gate::denies('garage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $garage->delete();

        return back();
    }

    public function massDestroy(MassDestroyGarageRequest $request)
    {
        Garage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('garage_create') && Gate::denies('garage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Garage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
