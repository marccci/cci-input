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
            'creator_id'      => [
                'required',
                'integer',
            ],
            'name'            => [
                'string',
                'required',
            ],
            'description'     => [
                'string',
                'nullable',
            ],
            'manufacturer_id' => [
                'required',
                'integer',
            ],
            'bore'            => [
                'numeric',
                'required',
            ],
            'stroke'          => [
                'numeric',
            ],
        ];
    }
}
