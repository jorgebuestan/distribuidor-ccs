<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('provincias')->insert([ 
            'id_pais' => 0, 
            'nombre' => 'OTRA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'AZUAY', 
            'estado' => '1' 
        ]); 

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'BOLIVAR', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'CAÑAR', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'CARCHI', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'COTOPAXI', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'CHIMBORAZO', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'EL ORO', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'ESMERALDAS', 
            'estado' => '1' 
        ]);


        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'GUAYAS', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'IMBABURA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'LOJA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'LOS RIOS', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'MANABÍ', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'MORONA SANTIAGO', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'NAPO', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'PASTAZA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'PICHINCHA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'TUNGURAHUA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'ZAMORA CHIMCHIPE', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'GALÁPAGOS', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'SUCUMBIOS', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'ORELLANA', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'SANTO DOMINGO DE LOS TSÁCHILAS', 
            'estado' => '1' 
        ]);

        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'SANTA ELENA', 
            'estado' => '1' 
        ]); 
        
        DB::table('provincias')->insert([ 
            'id_pais' => 57, 
            'nombre' => 'ZONAS NO DELIMITADAS', 
            'estado' => '1' 
        ]);

        

        

        

        
 
    }
}
