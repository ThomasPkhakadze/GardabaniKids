<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKidRequest;
use App\Http\Requests\StoreKidRequest;
use App\Http\Requests\UpdateKidRequest;
use App\Models\Kid;
use App\Models\KindergardenBranch;
use App\Models\KindergardenGroup;
use App\Models\ParentGuardian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KidController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kid_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kids = Kid::with(['branch', 'group', 'parent_guardian'])->get();

        return view('admin.kids.index', compact('kids'));
    }

    public function create()
    {
        abort_if(Gate::denies('kid_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allBranches = KindergardenBranch::with('kindergardenBranchKindergardenGroups')->get();
        $branches = [];

        foreach($allBranches as $branch){
            $vacantGroups = $branch->kindergardenBranchKindergardenGroups->where('vacancy', '!=', '0');            
            if(count($vacantGroups) > 0){
                $availableBranch = [
                    "id" => $branch->id,
                    "name" => $branch->name
                ];
                array_push($branches, $availableBranch);
            }
        }

        $groupsWithBranches = KindergardenGroup::where('vacancy','!=', '0')->with('kindergarden_branch')->get();

        $groups = []; 

        foreach($groupsWithBranches as $group){
            $groupGroupIdAndBranchNames = [
                "id" => $group->id,
                "group" => $group->name,
                "branch" => $group->kindergarden_branch->name
            ];
            array_push($groups, $groupGroupIdAndBranchNames);
        }

        $parent_guardians = ParentGuardian::pluck('id_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kids.create', compact('branches', 'groups', 'parent_guardians'));
    }

    public function store(StoreKidRequest $request)
    {
        $kid = Kid::create($request->all());
        KindergardenGroup::find($kid->group_id)->decrement('vacancy', 1);        

        return redirect()->route('admin.kids.index');
    }

    public function edit(Kid $kid)
    {
        abort_if(Gate::denies('kid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branches = KindergardenBranch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groupsWithBranches = KindergardenGroup::where('vacancy','!=', '0')->with('kindergarden_branch')->get();

        $groups = []; 

        foreach($groupsWithBranches as $group){
            $groupGroupIdAndBranchNames = [
                "id" => $group->id,
                "group" => $group->name,
                "branch" => $group->kindergarden_branch->name
            ];
            array_push($groups, $groupGroupIdAndBranchNames);
        }

        $parent_guardians = ParentGuardian::pluck('id_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kid->load('branch', 'group', 'parent_guardian');

        return view('admin.kids.edit', compact('branches', 'groups', 'kid', 'parent_guardians'));
    }

    public function update(UpdateKidRequest $request, Kid $kid)
    {
        if(intval($request->group_id) != $kid->group->id){
            KindergardenGroup::find($kid->group->id)->decrement('vacancy', 1);        
            KindergardenGroup::find($request->group_id)->increment('vacancy', 1);        
        }
        $kid->update($request->all());

        return redirect()->route('admin.kids.index');
    }

    public function show(Kid $kid)
    {
        abort_if(Gate::denies('kid_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kid->load('branch', 'group', 'parent_guardian');

        return view('admin.kids.show', compact('kid'));
    }

    public function destroy(Kid $kid)
    {
        abort_if(Gate::denies('kid_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kid->delete();

        return back();
    }

    public function massDestroy(MassDestroyKidRequest $request)
    {
        Kid::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
