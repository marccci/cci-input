<?php

namespace App\Http\Requests;

use App\Models\Manufacturer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manufacturer_create');
    }

    public function rules()
    {
        return [
            'creator_id'   => [
                'required',
                'integer',
            ],
            'owner_id'     => [
                'required',
                'integer',
            ],
            'name'         => [
                'string',
                'required',
            ],
            'description'  => [
                'string',
                'nullable',
            ],
            'country'      => [
                'string',
                'required',
            ],
            'country_code' => [
                'string',
                'nullable',
            ],
            'first_year'   => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'last_year'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
