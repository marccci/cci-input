<?php

namespace App\Http\Requests;

use App\Models\Car;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_create');
    }

    public function rules()
    {
        return [
            'creator_id'      => [
                'required',
                'integer',
            ],
            'owner'           => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'name'            => [
                'string',
                'required',
            ],
            'carmodel'        => [
                'string',
                'nullable',
            ],
            'manufacturer_id' => [
                'required',
                'integer',
            ],
            'engine'          => [
                'string',
                'required',
            ],
        ];
    }
}
