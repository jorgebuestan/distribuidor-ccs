<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_solicitud')->insert([  
            'descripcion' => 'PERSONA NATURAL' 
        ]); 

        DB::table('tipo_solicitud')->insert([  
            'descripcion' => 'REPRESENTANTE LEGAL' 
        ]); 

        DB::table('tipo_solicitud')->insert([  
            'descripcion' => 'MIEMBRO DE EMPRESA' 
        ]); 
    }
}
