<?php

use App\TiposRefrigerantes;
use Illuminate\Database\Seeder;

class TiposRefrigerantesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'PET',
            'GARRAFA',
            'LATA'
        ];

        foreach ($data as $value) {
            TiposRefrigerantes::updateOrCreate(['tipo_refrigerante' => $value]);
        }
    }
}
