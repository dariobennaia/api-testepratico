<?php

use App\LitragensRefrigerantes;
use Illuminate\Database\Seeder;

class LitragensRefrigerantesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '250ML',
            '600ML',
            '1L',
            '1.5L',
            '2L',
            '3L'
        ];

        foreach ($data as $value) {
            LitragensRefrigerantes::updateOrCreate(['litragem_refrigerante' => $value]);
        }
    }
}
