<?php

namespace App\Http\Requests;

use App\Models\Carmodel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarmodelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carmodel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carmodels,id',
        ];
    }
}
