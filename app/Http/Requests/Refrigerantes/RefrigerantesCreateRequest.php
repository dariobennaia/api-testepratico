<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesCreateRequest extends FormRequest
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
            'id_refrigerante' => 'required',
            'id_tipo_refrigerante' => 'required',
            'id_litragem_refrigerante' => 'required',
            'sabor' => 'required',
            'marca' => 'required',
            'valor' => 'required',
            'estoque' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'id_refrigerante.required' => 'Este campo é obrigatorio',
            'id_tipo_refrigerante.required' => 'Este campo é obrigatorio',
            'id_litragem_refrigerante.required' => 'Este campo é obrigatorio',
            'sabor.required' => 'Este campo é obrigatorio',
            'marca.required' => 'Este campo é obrigatorio',
            'valor.required' => 'Este campo é obrigatorio',
            'estoque.required' => 'Este campo é obrigatório!'
        ];
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all();
        $data['id'] = $this->route('id');
        return $data;
    }
}
