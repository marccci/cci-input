<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManufacturerRequest;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManufacturersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('manufacturer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Manufacturer::with(['creator', 'owner', 'team'])->select(sprintf('%s.*', (new Manufacturer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'manufacturer_show';
                $editGate      = 'manufacturer_edit';
                $deleteGate    = 'manufacturer_delete';
                $crudRoutePart = 'manufacturers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }

                $links = [];

                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : "";
            });
            $table->editColumn('first_year', function ($row) {
                return $row->first_year ? $row->first_year : "";
            });
            $table->editColumn('last_year', function ($row) {
                return $row->last_year ? $row->last_year : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'creator', 'owner', 'logo', 'image']);

            return $table->make(true);
        }

        $users = User::get();
        $users = User::get();
        $teams = Team::get();

        return view('admin.manufacturers.index', compact('users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('manufacturer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.manufacturers.create', compact('creators', 'owners'));
    }

    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        if ($request->input('logo', false)) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        foreach ($request->input('image', []) as $file) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $manufacturer->id]);
        }

        return redirect()->route('admin.manufacturers.index');
    }

    public function edit(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturer->load('creator', 'owner', 'team');

        return view('admin.manufacturers.edit', compact('creators', 'owners', 'manufacturer'));
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());

        if ($request->input('logo', false)) {
            if (!$manufacturer->logo || $request->input('logo') !== $manufacturer->logo->file_name) {
                if ($manufacturer->logo) {
                    $manufacturer->logo->delete();
                }

                $manufacturer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($manufacturer->logo) {
            $manufacturer->logo->delete();
        }

        if (count($manufacturer->image) > 0) {
            foreach ($manufacturer->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $manufacturer->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $manufacturer->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.manufacturers.index');
    }

    public function show(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->load('creator', 'owner', 'team', 'manufacturerEngines', 'manufacturerCars');

        return view('admin.manufacturers.show', compact('manufacturer'));
    }

    public function destroy(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->delete();

        return back();
    }

    public function massDestroy(MassDestroyManufacturerRequest $request)
    {
        Manufacturer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('manufacturer_create') && Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Manufacturer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
