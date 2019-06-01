<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesMultiplasDelecoesRequest extends FormRequest
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
            'id_refrigerante' => 'required|array'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'id_refrigerante.required' => 'Informe os registros a serem excluidos!',
            'id_refrigerante.array' => 'Os registros devem ser informados como array!',
        ];
    }
}
