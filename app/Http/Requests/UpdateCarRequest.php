<?php

namespace App\Http\Requests;

use App\Models\Car;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('car_edit');
    }

    public function rules()
    {
        return [
            'creator_id'      => [
                'required',
                'integer',
            ],
            'owner_id'        => [
                'required',
                'integer',
            ],
            'manufacturer_id' => [
                'required',
                'integer',
            ],
            'carmodel'        => [
                'string',
                'nullable',
            ],
            'name'            => [
                'string',
                'required',
            ],
            'engine'          => [
                'string',
                'required',
            ],
        ];
    }
}
