<?php

namespace App\Http\Requests;

use App\Models\KindergardenBranch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKindergardenBranchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kindergarden_branch_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'branch_manager' => [
                'string',
                'required',
            ],
            'phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
