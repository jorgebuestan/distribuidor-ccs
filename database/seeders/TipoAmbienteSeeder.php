<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_ambiente')->insert([  
            'descripcion' => 'PRUEBAS' 
        ]); 

        DB::table('tipo_ambiente')->insert([  
            'descripcion' => 'PRODUCCIÓN' 
        ]); 
    }
}
