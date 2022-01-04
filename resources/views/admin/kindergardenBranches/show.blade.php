@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kindergardenBranch.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kindergarden-branches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.id') }}
                        </th>
                        <td>
                            {{ $kindergardenBranch->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.name') }}
                        </th>
                        <td>
                            {{ $kindergardenBranch->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.address') }}
                        </th>
                        <td>
                            {{ $kindergardenBranch->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.branch_manager') }}
                        </th>
                        <td>
                            {{ $kindergardenBranch->branch_manager }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.phone') }}
                        </th>
                        <td>
                            {{ $kindergardenBranch->phone }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kindergarden-branches.index') }}">
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
            <a class="nav-link" href="#kindergarden_branch_kindergarden_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.kindergardenGroup.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#branch_kids" role="tab" data-toggle="tab">
                {{ trans('cruds.kid.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kindergarden_branch_kindergarden_groups">
            @includeIf('admin.kindergardenBranches.relationships.kindergardenBranchKindergardenGroups', ['kindergardenGroups' => $kindergardenBranch->kindergardenBranchKindergardenGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="branch_kids">
            @includeIf('admin.kindergardenBranches.relationships.branchKids', ['kids' => $kindergardenBranch->branchKids])
        </div>
    </div>
</div>

@endsection