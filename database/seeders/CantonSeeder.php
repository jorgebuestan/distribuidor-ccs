<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CantonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('cantones')->insert([ 
            'id_pais' => 0, 
            'id_provincia' => 0, 
            'nombre' => 'OTRA', 
            'estado' => '1' 
        ]);

       /* DB::table('cantones')->insert([ 
            'id_pais' => 57, 
            'id_provincia' => 2, 
            'nombre' => '', 
            'estado' => '1' 
        ]); */

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'CUENCA',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'GIRÓN',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'GUALACEO',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'NABÓN',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'PAUTE',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'PUCARÁ',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'SAN FERNANDO',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'SANTA ISABEL',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'SIGSIG',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'OÑA',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'CHORDELEG',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'EL PAN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'SEVILLA DE ORO',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'GUACHAPALA',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 2,
            'nombre' => 'CAMILO PONCE ENRÍQUEZ',
            'estado' => '1',
        ]); 

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'GUARANDA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'CHILLANES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'CHIMBO',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'ECHEANDÍA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'SAN MIGUEL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'CALUMA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 3,
            'nombre' => 'LAS NAVES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'AZOGUES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'BIBLIÁN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'CAÑAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'LA TRONCAL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'EL TAMBO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'DÉLEG',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 4,
            'nombre' => 'SUSCAL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'TULCÁN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'BOLÍVAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'ESPEJO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'MIRA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'MONTÚFAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 5,
            'nombre' => 'SAN PEDRO DE HUACA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'LATACUNGA',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'LA MANÁ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'PANGUA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'PUJILI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'SALCEDO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'SAQUISILÍ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' => 6,
            'nombre' => 'SIGCHOS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'RIOBAMBA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'ALAUSI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'COLTA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'CHAMBO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'CHUNCHI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'GUAMOTE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'GUANO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'PALLATANGA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'PENIPE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>7,
            'nombre' => 'CUMANDÁ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'MACHALA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'ARENILLAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'ATAHUALPA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'BALSAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'CHILLA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'EL GUABO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'HUAQUILLAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'MARCABELÍ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'PASAJE',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'PIÑAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'PORTOVELO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'SANTA ROSA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'ZARUMA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>8,
            'nombre' => 'LAS LAJAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'ESMERALDAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'ELOY ALFARO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'MUISNE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'QUININDÉ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'SAN LORENZO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'ATACAMES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'RIOVERDE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>9,
            'nombre' => 'LA CONCORDIA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'GUAYAQUIL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'ALFREDO BAQUERIZO MORENO (JUJAN)',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'BALAO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'BALZAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'COLIMES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'DAULE',
            'estado' => '1',
        ]);
        
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'DURÁN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'EL EMPALME',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'EL TRIUNFO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'MILAGRO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'NARANJAL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'NARANJITO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'PALESTINA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'PEDRO CARBO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'SAMBORONDÓN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'SANTA LUCÍA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'SALITRE (URBINA JADO)',
            'estado' => '1',
        ]); 

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'SAN JACINTO DE YAGUACHI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'PLAYAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'SIMÓN BOLÍVAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'CORONEL MARCELINO MARIDUEÑA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'LOMAS DE SARGENTILLO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'NOBOL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'GENERAL ANTONIO ELIZALDE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>10,
            'nombre' => 'ISIDRO AYORA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'IBARRA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'ANTONIO ANTE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'COTACACHI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'OTAVALO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'PIMAMPIRO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>11,
            'nombre' => 'SAN MIGUEL DE URCUQUÍ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'LOJA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'CALVAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'CATAMAYO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'CELICA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'CHAGUARPAMBA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'ESPÍNDOLA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'GONZANAMÁ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'MACARÁ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'PALTAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'PUYANGO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'SARAGURO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'SOZORANGA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'ZAPOTILLO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'PINDAL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'QUILANGA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>12,
            'nombre' => 'OLMEDO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'BABAHOYO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'BABA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'MONTALVO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'PUEBLOVIEJO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'QUEVEDO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'URDANETA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'VENTANAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'VÍNCES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'PALENQUE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'BUENA FÉ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'VALENCIA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'MOCACHE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>13,
            'nombre' => 'QUINSALOMA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'PORTOVIEJO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'BOLÍVAR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'CHONE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'EL CARMEN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'FLAVIO ALFARO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'JIPIJAPA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'JUNÍN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'MANTA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'MONTECRISTI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'PAJÁN',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'PICHINCHA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'ROCAFUERTE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'SANTA ANA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'SUCRE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'TOSAGUA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => '24 DE MAYO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'PEDERNALES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'OLMEDO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'PUERTO LÓPEZ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'JAMA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'JARAMIJÓ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>14,
            'nombre' => 'SAN VICENTE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'MORONA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'GUALAQUIZA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'LIMÓN INDANZA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'PALORA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'SANTIAGO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'SUCÚA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'HUAMBOYA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'SAN JUAN BOSCO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'TAISHA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'LOGROÑO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'PABLO SEXTO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>15,
            'nombre' => 'TIWINTZA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>16,
            'nombre' => 'TENA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>16,
            'nombre' => 'ARCHIDONA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>16,
            'nombre' => 'EL CHACO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>16,
            'nombre' => 'QUIJOS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>16,
            'nombre' => 'CARLOS JULIO AROSEMENA TOLA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>17,
            'nombre' => 'PASTAZA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>17,
            'nombre' => 'MERA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>17,
            'nombre' => 'SANTA CLARA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>17,
            'nombre' => 'ARAJUNO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'QUITO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'CAYAMBE',
            'estado' => '1',
        ]);
                
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'MEJIA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'PEDRO MONCAYO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'RUMIÑAHUI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'SAN MIGUEL DE LOS BANCOS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'PEDRO VICENTE MALDONADO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>18,
            'nombre' => 'PUERTO QUITO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'AMBATO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'BAÑOS DE AGUA SANTA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'CEVALLOS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'MOCHA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'PATATE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'QUERO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'SAN PEDRO DE PELILEO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'SANTIAGO DE PÍLLARO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>19,
            'nombre' => 'TISALEO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'ZAMORA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'CHINCHIPE',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'NANGARITZA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'YACUAMBI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'YANTZAZA (YANZATZA)',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'EL PANGUI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'CENTINELA DEL CÓNDOR',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'PALANDA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>20,
            'nombre' => 'PAQUISHA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>21,
            'nombre' => 'SAN CRISTÓBAL',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>21,
            'nombre' => 'ISABELA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>21,
            'nombre' => 'SANTA CRUZ',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'LAGO AGRIO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'GONZALO PIZARRO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'PUTUMAYO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'SHUSHUFINDI',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'SUCUMBÍOS',
            'estado' => '1',
        ]);
                
        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'CASCALES',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>22,
            'nombre' => 'CUYABENO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>23,
            'nombre' => 'ORELLANA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>23,
            'nombre' => 'AGUARICO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>23,
            'nombre' => 'LA JOYA DE LOS SACHAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>23,
            'nombre' => 'LORETO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>24,
            'nombre' => 'SANTO DOMINGO',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>25,
            'nombre' => 'SANTA ELENA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>25,
            'nombre' => 'LA LIBERTAD',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>25,
            'nombre' => 'SALINAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>26,
            'nombre' => 'LAS GOLONDRINAS',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>26,
            'nombre' => 'MANGA DEL CURA',
            'estado' => '1',
        ]);

        DB::table('cantones')->insert([
            'id_pais' => 57,
            'id_provincia' =>26,
            'nombre' => 'EL PIEDRERO',
            'estado' => '1',
        ]);
        
    }
}
