<?php

namespace App\Http\Requests;

use App\Models\Kid;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKidRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kid_edit');
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
                'unique:kids,id_number,' . request()->route('kid')->id,
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'parent_guardian_id' => [
                'required',
                'integer',
            ],
            'branch_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
