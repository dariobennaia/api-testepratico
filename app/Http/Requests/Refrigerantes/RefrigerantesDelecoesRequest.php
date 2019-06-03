<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesDelecoesRequest extends FormRequest
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
            'id_refrigerante' => 'required|numeric'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'id_refrigerante.required' => 'Informe os registros a serem excluidos!',
            'id_refrigerante.numeric' => 'Id do refrigerante inválido!',
        ];
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all();
        $data['id_refrigerante'] = $this->route('id_refrigerante');
        return $data;
    }
}
