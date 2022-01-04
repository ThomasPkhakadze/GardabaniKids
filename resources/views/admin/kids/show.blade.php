@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kid.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.id') }}
                        </th>
                        <td>
                            {{ $kid->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.name') }}
                        </th>
                        <td>
                            {{ $kid->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.lastname') }}
                        </th>
                        <td>
                            {{ $kid->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.id_number') }}
                        </th>
                        <td>
                            {{ $kid->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $kid->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.parent_guardian') }}
                        </th>
                        <td>
                            {{ $kid->parent_guardian->id_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.branch') }}
                        </th>
                        <td>
                            {{ $kid->branch->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kid.fields.group') }}
                        </th>
                        <td>
                            {{ $kid->group->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection