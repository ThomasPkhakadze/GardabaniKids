<?php

namespace App\Http\Requests;

use App\Models\ParentGuardian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParentGuardianRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('parent_guardian_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'lastname' => [
                'string',
                'required',
            ],
            'id_number' => [
                'required',
                'string',
                'max:25',
                'unique:parent_guardians,id_number',
            ],
            'guardian_type' => [
                'string',
                'required',
            ],
        ];
    }
}
