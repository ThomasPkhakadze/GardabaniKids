@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.parentGuardian.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parent-guardians.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.id') }}
                        </th>
                        <td>
                            {{ $parentGuardian->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.name') }}
                        </th>
                        <td>
                            {{ $parentGuardian->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.lastname') }}
                        </th>
                        <td>
                            {{ $parentGuardian->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.email') }}
                        </th>
                        <td>
                            {{ $parentGuardian->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.id_number') }}
                        </th>
                        <td>
                            {{ $parentGuardian->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.guardian_type') }}
                        </th>
                        <td>
                            {{ $parentGuardian->guardian_type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parent-guardians.index') }}">
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
            <a class="nav-link" href="#parent_guardian_kids" role="tab" data-toggle="tab">
                {{ trans('cruds.kid.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_guardian_kids">
            @includeIf('admin.parentGuardians.relationships.parentGuardianKids', ['kids' => $parentGuardian->parentGuardianKids])
        </div>
    </div>
</div>

@endsection