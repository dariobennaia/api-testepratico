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
        return [
            'id' => [new \App\Rules\Refrigerantes\CheckIfRefrigerantesExistsRule($this->id)]
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
        $data['id'] = $this->route('id');
        return $data;
    }
}
