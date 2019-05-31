<?php

namespace App\Http\Requests\Refrigerantes;

use Illuminate\Foundation\Http\FormRequest;

class RefrigerantesStatusRequest extends FormRequest
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
        return [
            'id_refrigerante' => [new \App\Rules\Refrigerantes\CheckIfRefrigerantesExistsRule($idRefigerante)]
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            
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
