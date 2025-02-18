<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_contribuyente')->insert([  
            'descripcion' => 'RÉGIMEN GENERAL' 
        ]); 

        DB::table('tipo_contribuyente')->insert([  
            'descripcion' => 'RIMPE EMPRENDEDOR' 
        ]); 

        DB::table('tipo_contribuyente')->insert([  
            'descripcion' => 'RIMPE NEGOCIO POPULAR' 
        ]); 
    }
}
