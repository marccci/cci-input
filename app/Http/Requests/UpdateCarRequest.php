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
