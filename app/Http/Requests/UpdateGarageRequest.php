<?php

namespace App\Http\Requests;

use App\Models\Garage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGarageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('garage_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'name'    => [
                'string',
                'required',
            ],
            'car'     => [
                'string',
                'required',
            ],
        ];
    }
}
