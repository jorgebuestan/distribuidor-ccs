<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Cédula Frontal' 
        ]); 

        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Cédula Posterior' 
        ]); 
        
        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Selfie con Cédula' 
        ]); 

        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Copia del RUC' 
        ]); 

        
        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Documento Adicional (Vídeo)' 
        ]); 

        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Constitución de Compañía' 
        ]); 

        
        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Nombramiento de Representante' 
        ]); 

        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Aceptación de Nombramiento' 
        ]); 

        
        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Cédula del Representante Legal' 
        ]); 

        DB::table('tipo_archivo')->insert([  
            'descripcion' => 'Autorización del Representante' 
        ]); 

    }
}
