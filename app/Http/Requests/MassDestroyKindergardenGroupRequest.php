<?php

namespace App\Http\Requests;

use App\Models\KindergardenGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKindergardenGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kindergarden_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kindergarden_groups,id',
        ];
    }
}
