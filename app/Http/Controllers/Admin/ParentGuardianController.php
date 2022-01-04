<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyParentGuardianRequest;
use App\Http\Requests\StoreParentGuardianRequest;
use App\Http\Requests\UpdateParentGuardianRequest;
use App\Models\ParentGuardian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentGuardianController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('parent_guardian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardians = ParentGuardian::all();

        return view('admin.parentGuardians.index', compact('parentGuardians'));
    }

    public function create()
    {
        abort_if(Gate::denies('parent_guardian_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parentGuardians.create');
    }

    public function store(StoreParentGuardianRequest $request)
    {
        $parentGuardian = ParentGuardian::create($request->all());

        return redirect()->route('admin.parent-guardians.index');
    }

    public function edit(ParentGuardian $parentGuardian)
    {
        abort_if(Gate::denies('parent_guardian_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parentGuardians.edit', compact('parentGuardian'));
    }

    public function update(UpdateParentGuardianRequest $request, ParentGuardian $parentGuardian)
    {
        $parentGuardian->update($request->all());

        return redirect()->route('admin.parent-guardians.index');
    }

    public function show(ParentGuardian $parentGuardian)
    {
        abort_if(Gate::denies('parent_guardian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardian->load('parentGuardianKids');

        return view('admin.parentGuardians.show', compact('parentGuardian'));
    }

    public function destroy(ParentGuardian $parentGuardian)
    {
        abort_if(Gate::denies('parent_guardian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentGuardian->delete();

        return back();
    }

    public function massDestroy(MassDestroyParentGuardianRequest $request)
    {
        ParentGuardian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
