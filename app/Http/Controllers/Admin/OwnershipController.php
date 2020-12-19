<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOwnershipRequest;
use App\Http\Requests\StoreOwnershipRequest;
use App\Http\Requests\UpdateOwnershipRequest;
use App\Models\Ownership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnershipController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ownership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownerships = Ownership::all();

        return view('admin.ownerships.index', compact('ownerships'));
    }

    public function create()
    {
        abort_if(Gate::denies('ownership_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownerships.create');
    }

    public function store(StoreOwnershipRequest $request)
    {
        $ownership = Ownership::create($request->all());

        return redirect()->route('admin.ownerships.index');
    }

    public function edit(Ownership $ownership)
    {
        abort_if(Gate::denies('ownership_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownerships.edit', compact('ownership'));
    }

    public function update(UpdateOwnershipRequest $request, Ownership $ownership)
    {
        $ownership->update($request->all());

        return redirect()->route('admin.ownerships.index');
    }

    public function show(Ownership $ownership)
    {
        abort_if(Gate::denies('ownership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ownerships.show', compact('ownership'));
    }

    public function destroy(Ownership $ownership)
    {
        abort_if(Gate::denies('ownership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownership->delete();

        return back();
    }

    public function massDestroy(MassDestroyOwnershipRequest $request)
    {
        Ownership::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
