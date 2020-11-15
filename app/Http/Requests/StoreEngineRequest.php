<?php

namespace App\Http\Requests;

use App\Models\Engine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEngineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('engine_create');
    }

    public function rules()
    {
        return [
            'creator_id'        => [
                'required',
                'integer',
            ],
            'owner'             => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'name'              => [
                'string',
                'required',
            ],
            'description'       => [
                'string',
                'nullable',
            ],
            'manufacturer_id'   => [
                'required',
                'integer',
            ],
            'cylinder_number'   => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'block_config'      => [
                'string',
                'required',
            ],
            'power_units'       => [
                'string',
                'required',
            ],
            'engine_power'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'engine_size'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'engine_size_units' => [
                'string',
                'required',
            ],
            'bore'              => [
                'numeric',
                'required',
            ],
            'stroke'            => [
                'numeric',
                'required',
            ],
        ];
    }
}
