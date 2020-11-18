@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_garages" role="tab" data-toggle="tab">
                {{ trans('cruds.garage.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#creator_manufacturers" role="tab" data-toggle="tab">
                {{ trans('cruds.manufacturer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#creator_engines" role="tab" data-toggle="tab">
                {{ trans('cruds.engine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#creator_cars" role="tab" data-toggle="tab">
                {{ trans('cruds.car.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_garages">
            @includeIf('admin.users.relationships.userGarages', ['garages' => $user->userGarages])
        </div>
        <div class="tab-pane" role="tabpanel" id="creator_manufacturers">
            @includeIf('admin.users.relationships.creatorManufacturers', ['manufacturers' => $user->creatorManufacturers])
        </div>
        <div class="tab-pane" role="tabpanel" id="creator_engines">
            @includeIf('admin.users.relationships.creatorEngines', ['engines' => $user->creatorEngines])
        </div>
        <div class="tab-pane" role="tabpanel" id="creator_cars">
            @includeIf('admin.users.relationships.creatorCars', ['cars' => $user->creatorCars])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection