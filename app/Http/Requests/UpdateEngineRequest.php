<?php

namespace App\Http\Requests;

use App\Models\Engine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEngineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('engine_edit');
    }

    public function rules()
    {
        return [
            'creator_id'         => [
                'required',
                'integer',
            ],
            'owner_id'           => [
                'required',
                'integer',
            ],
            'name'               => [
                'string',
                'required',
            ],
            'description'        => [
                'string',
                'nullable',
            ],
            'manufacturer_id'    => [
                'required',
                'integer',
            ],
            'cylinder_number'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'engine_power'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'engine_power_units' => [
                'required',
            ],
            'engine_size'        => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'engine_size_units'  => [
                'required',
            ],
            'bore'               => [
                'numeric',
                'required',
            ],
            'stroke'             => [
                'numeric',
                'required',
            ],
            'block_config'       => [
                'required',
            ],
        ];
    }
}
