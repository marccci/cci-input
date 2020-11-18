<?php

namespace App\Http\Requests;

use App\Models\Manufacturer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manufacturer_edit');
    }

    public function rules()
    {
        return [
            'creator_id'   => [
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
                'required',
            ],
            'first_year'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'last_year'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
