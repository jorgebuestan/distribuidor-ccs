<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVigenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '7 DÍAS' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '30 DÍAS' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '1 AÑO' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '2 AÑOS' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '3 AÑOS' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '4 AÑOS' 
        ]); 

        DB::table('tipo_vigencia')->insert([  
            'descripcion' => '5 AÑOS' 
        ]); 
    }
}
