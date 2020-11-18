<?php

namespace App\Http\Requests;

use App\Models\Carmodel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarmodelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carmodel_create');
    }

    public function rules()
    {
        return [
            'creator_id' => [
                'required',
                'integer',
            ],
            'owner_id'   => [
                'required',
                'integer',
            ],
            'name'       => [
                'string',
                'required',
                'unique:carmodels',
            ],
            'first_year' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'last_year'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'cars.*'     => [
                'integer',
            ],
            'cars'       => [
                'array',
            ],
        ];
    }
}
