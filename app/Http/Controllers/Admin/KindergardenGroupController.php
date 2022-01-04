<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKindergardenGroupRequest;
use App\Http\Requests\StoreKindergardenGroupRequest;
use App\Http\Requests\UpdateKindergardenGroupRequest;
use App\Models\KindergardenBranch;
use App\Models\KindergardenGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KindergardenGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kindergarden_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenGroups = KindergardenGroup::with(['kindergarden_branch'])->get();

        return view('admin.kindergardenGroups.index', compact('kindergardenGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('kindergarden_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergarden_branches = KindergardenBranch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kindergardenGroups.create', compact('kindergarden_branches'));
    }

    public function store(StoreKindergardenGroupRequest $request)
    {
        $kindergardenGroup = KindergardenGroup::create($request->all());

        return redirect()->route('admin.kindergarden-groups.index');
    }

    public function edit(KindergardenGroup $kindergardenGroup)
    {
        abort_if(Gate::denies('kindergarden_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergarden_branches = KindergardenBranch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kindergardenGroup->load('kindergarden_branch');

        return view('admin.kindergardenGroups.edit', compact('kindergardenGroup', 'kindergarden_branches'));
    }

    public function update(UpdateKindergardenGroupRequest $request, KindergardenGroup $kindergardenGroup)
    {
        $kindergardenGroup->update($request->all());

        return redirect()->route('admin.kindergarden-groups.index');
    }

    public function show(KindergardenGroup $kindergardenGroup)
    {
        abort_if(Gate::denies('kindergarden_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenGroup->load('kindergarden_branch', 'groupKids');

        return view('admin.kindergardenGroups.show', compact('kindergardenGroup'));
    }

    public function destroy(KindergardenGroup $kindergardenGroup)
    {
        abort_if(Gate::denies('kindergarden_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyKindergardenGroupRequest $request)
    {
        KindergardenGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
