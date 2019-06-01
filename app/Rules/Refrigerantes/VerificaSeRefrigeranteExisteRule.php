<?php

namespace App\Rules\Refrigerantes;

use Illuminate\Contracts\Validation\Rule;
use App\Refrigerantes;

class VerificaSeRefrigeranteExisteRule implements Rule
{
    private $refrigerantesId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($refrigerantesId)
    {
        $this->refrigerantesId = $refrigerantesId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $totalRefrigerantes = Refrigerantes::where('id_refrigerante', $this->refrigerantesId)->count();
            if ($totalRefrigerantes === 0) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Registro inexistente!';
    }
}
