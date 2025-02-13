<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_sexo')->insert([  
            'descripcion' => 'HOMBRE' 
        ]); 

        DB::table('tipo_sexo')->insert([  
            'descripcion' => 'MUJER' 
        ]); 
    }
}
