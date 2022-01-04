<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKindergardenBranchRequest;
use App\Http\Requests\StoreKindergardenBranchRequest;
use App\Http\Requests\UpdateKindergardenBranchRequest;
use App\Models\KindergardenBranch;
use App\Models\KindergardenGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KindergardenBranchController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kindergarden_branch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenBranches = KindergardenBranch::all();

        return view('admin.kindergardenBranches.index', compact('kindergardenBranches'));
    }

    public function create()
    {
        abort_if(Gate::denies('kindergarden_branch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kindergardenBranches.create');
    }

    public function store(StoreKindergardenBranchRequest $request)
    {
        $kindergardenBranch = KindergardenBranch::create($request->all());
        KindergardenGroup::upsert([
            ['name' => '2-3', 'vacancy' => 0, 'kindergarden_branch_id' => $kindergardenBranch->id],
            ['name' => '3-4', 'vacancy' => 0, 'kindergarden_branch_id' => $kindergardenBranch->id],
            ['name' => '4-5', 'vacancy' => 0, 'kindergarden_branch_id' => $kindergardenBranch->id],
            ['name' => '5-6', 'vacancy' => 0, 'kindergarden_branch_id' => $kindergardenBranch->id]
        ], ['name', 'vacancy', 'kindergarden_branch_id']);

        return redirect()->route('admin.kindergarden-branches.index');
    }

    public function edit(KindergardenBranch $kindergardenBranch)
    {
        abort_if(Gate::denies('kindergarden_branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kindergardenBranches.edit', compact('kindergardenBranch'));
    }

    public function update(UpdateKindergardenBranchRequest $request, KindergardenBranch $kindergardenBranch)
    {
        $kindergardenBranch->update($request->all());

        return redirect()->route('admin.kindergarden-branches.index');
    }

    public function show(KindergardenBranch $kindergardenBranch)
    {
        abort_if(Gate::denies('kindergarden_branch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenBranch->load('kindergardenBranchKindergardenGroups', 'branchKids');

        return view('admin.kindergardenBranches.show', compact('kindergardenBranch'));
    }

    public function destroy(KindergardenBranch $kindergardenBranch)
    {
        abort_if(Gate::denies('kindergarden_branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kindergardenBranch->delete();

        return back();
    }

    public function massDestroy(MassDestroyKindergardenBranchRequest $request)
    {
        KindergardenBranch::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
