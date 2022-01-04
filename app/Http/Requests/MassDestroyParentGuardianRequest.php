<?php

namespace App\Http\Requests;

use App\Models\ParentGuardian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParentGuardianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('parent_guardian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:parent_guardians,id',
        ];
    }
}
