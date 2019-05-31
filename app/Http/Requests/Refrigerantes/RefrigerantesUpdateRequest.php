<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesUpdateRequest extends FormRequest
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
        $idRefigerante = $this->id_refrigerante;
        $marca = $this->marca;
        $idLitragemRefrigerante = $this->id_litragem_refrigerante;
        $idTipoRefrigerante = $this->id_tipo_refrigerante;

        return [
            'id_refrigerante' => [new \App\Rules\Refrigerantes\CheckIfRefrigerantesExistsRule($idRefigerante)],
            'id_tipo_refrigerante' => 'required',
            'id_litragem_refrigerante' => 'required',
            'sabor' => [
                'required',
                "unique:refrigerantes,sabor,{$idRefigerante},id_refrigerante,marca,{$marca},id_litragem_refrigerante,
                {$idLitragemRefrigerante},id_tipo_refrigerante,{$idTipoRefrigerante}"
            ],
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
            'id_tipo_refrigerante.required' => 'Informe o tipo do refrigerante!',
            'id_litragem_refrigerante.required' => 'Informe a litragem do refrigerante!',

            'sabor.required' => 'Informe o sabor do refrigerante!',
            'sabor.unique' => 'Ops! parece que este refrigerante já esta cadastrado!',

            'marca.required' => 'Informe a marca do refrigerante!',
            'valor.required' => 'Informe o valor unitário do refrigerante!',
            'estoque.required' => 'Informe a quantidade em estoque do refrigerante!!'
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
