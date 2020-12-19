<?php

namespace App\Http\Requests;

use App\Models\Ownership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOwnershipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ownership_create');
    }

    public function rules()
    {
        return [
            'user' => [
                'string',
                'required',
            ],
        ];
    }
}
