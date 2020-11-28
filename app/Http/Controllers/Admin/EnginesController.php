<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEngineRequest;
use App\Http\Requests\StoreEngineRequest;
use App\Http\Requests\UpdateEngineRequest;
use App\Models\Engine;
use App\Models\Manufacturer;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EnginesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('engine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Engine::with(['creator', 'owner', 'manufacturer', 'team'])->select(sprintf('%s.*', (new Engine)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'engine_show';
                $editGate      = 'engine_edit';
                $deleteGate    = 'engine_delete';
                $crudRoutePart = 'engines';

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
            $table->addColumn('manufacturer_name', function ($row) {
                return $row->manufacturer ? $row->manufacturer->name : '';
            });

            $table->editColumn('cylinder_number', function ($row) {
                return $row->cylinder_number ? $row->cylinder_number : "";
            });
            $table->editColumn('engine_power', function ($row) {
                return $row->engine_power ? $row->engine_power : "";
            });
            $table->editColumn('engine_power_units', function ($row) {
                return $row->engine_power_units ? Engine::ENGINE_POWER_UNITS_RADIO[$row->engine_power_units] : '';
            });
            $table->editColumn('engine_size', function ($row) {
                return $row->engine_size ? $row->engine_size : "";
            });
            $table->editColumn('engine_size_units', function ($row) {
                return $row->engine_size_units ? Engine::ENGINE_SIZE_UNITS_RADIO[$row->engine_size_units] : '';
            });
            $table->editColumn('bore', function ($row) {
                return $row->bore ? $row->bore : "";
            });
            $table->editColumn('stroke', function ($row) {
                return $row->stroke ? $row->stroke : "";
            });
            $table->editColumn('files', function ($row) {
                return $row->files ? '<a href="' . $row->files->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
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
            $table->editColumn('block_config', function ($row) {
                return $row->block_config ? Engine::BLOCK_CONFIG_RADIO[$row->block_config] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'creator', 'owner', 'manufacturer', 'files', 'images']);

            return $table->make(true);
        }

        $users         = User::get();
        $users         = User::get();
        $manufacturers = Manufacturer::get();
        $teams         = Team::get();

        return view('admin.engines.index', compact('users', 'users', 'manufacturers', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('engine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.engines.create', compact('creators', 'owners', 'manufacturers'));
    }

    public function store(StoreEngineRequest $request)
    {
        $engine = Engine::create($request->all());

        if ($request->input('files', false)) {
            $engine->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        foreach ($request->input('images', []) as $file) {
            $engine->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $engine->id]);
        }

        return redirect()->route('admin.engines.index');
    }

    public function edit(Engine $engine)
    {
        abort_if(Gate::denies('engine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $creators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manufacturers = Manufacturer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $engine->load('creator', 'owner', 'manufacturer', 'team');

        return view('admin.engines.edit', compact('creators', 'owners', 'manufacturers', 'engine'));
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

        if (count($engine->images) > 0) {
            foreach ($engine->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $engine->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $engine->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.engines.index');
    }

    public function show(Engine $engine)
    {
        abort_if(Gate::denies('engine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->load('creator', 'owner', 'manufacturer', 'team');

        return view('admin.engines.show', compact('engine'));
    }

    public function destroy(Engine $engine)
    {
        abort_if(Gate::denies('engine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->delete();

        return back();
    }

    public function massDestroy(MassDestroyEngineRequest $request)
    {
        Engine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('engine_create') && Gate::denies('engine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Engine();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
