<?php

namespace App\Http\Requests;

use App\Models\Garage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGarageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('garage_create');
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
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
