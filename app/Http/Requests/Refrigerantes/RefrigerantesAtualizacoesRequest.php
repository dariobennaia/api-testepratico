<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesAtualizacoesRequest extends FormRequest
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
            'id_refrigerante' => [new \App\Rules\Refrigerantes\VerificaSeRefrigeranteExisteRule($idRefigerante)],
            'id_tipo_refrigerante' => 'required',
            'id_litragem_refrigerante' => 'required',
            'sabor' => [
                'required',
                "unique:refrigerantes,sabor,{$idRefigerante},id_refrigerante,marca,{$marca},id_litragem_refrigerante,
                {$idLitragemRefrigerante},id_tipo_refrigerante,{$idTipoRefrigerante},deleted_at,NULL"
            ],
            'marca' => 'required',
            'valor' => [
                'bail',
                'required',
                'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',
                'numeric',
                'between:0.01,99999999.99'
            ],
            'estoque' => 'required|numeric|min:0'
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
            'valor.regex' => 'O valor do refrigerante esta inválido! Tente de R$ 0.00 a 99999999.99!',
            'valor.numeric' => 'O valor do refrigerante esta inválido! Tente de R$ 0.00 a 99999999.99!',
            'valor.between' => 'O valor do refrigerante deve ser entre R$ 0.00 a 99999999.99!',

            'estoque.required' => 'Informe a quantidade em estoque do refrigerante!',
            'estoque.numeric' => 'Quantidade para estoque inválida!',
            'estoque.min' => 'A quantidade minima para o estoque é 0!'
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
