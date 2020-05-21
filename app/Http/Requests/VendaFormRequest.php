<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idpessoas' => 'required',
            'tipo_comprovante' => 'required|max:50',
            'serie' => 'required|max:50',
            'num_comprovante' => 'required|numeric',
            'taxa' => 'required|numeric',
            'total_venda' => 'required|numeric',
            //'data_hora' => 'required|numeric',
            'estado' => 'requerid|max:45'
        ];
    }
}
