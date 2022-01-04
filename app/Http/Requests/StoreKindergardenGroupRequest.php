<?php

namespace App\Http\Requests;

use App\Models\KindergardenGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKindergardenGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kindergarden_group_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'vacancy' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'kindergarden_branch_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
