<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 

        DB::table('paises')->insert([ 
            'codigo' => '93', 
            'nombre' => 'Afganistán', 
            'estado' => '1' 
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '355', 
            'nombre' => 'Albania', 
            'estado' => '1'
        ]);     

        DB::table('paises')->insert([ 
            'codigo' => '213', 
            'nombre' => 'Argelia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '376', 
            'nombre' => 'Andorra', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '244', 
            'nombre' => 'Angola', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '1-264', 
            'nombre' => 'Anguila', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '1-268', 
            'nombre' => 'Antigua y Barbuda', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([ 
            'codigo' => '54', 
            'nombre' => 'Argentina', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([  
            'codigo' => '374', 
            'nombre' => 'Armenia', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '297', 
            'nombre' => 'Aruba', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '61', 
            'nombre' => 'Australia', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '43', 
            'nombre' => 'Austria', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '994', 
            'nombre' => 'Azerbaiyán', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '1-242', 
            'nombre' => 'Bahamas', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '973', 
            'nombre' => 'Baréin', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '880', 
            'nombre' => 'Bangladesh', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '1-246', 
            'nombre' => 'Barbados', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '375', 
            'nombre' => 'Bielorrusia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '32', 
            'nombre' => 'Bélgica', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '501', 
            'nombre' => 'Belice', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '229', 
            'nombre' => 'Benín', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '1-441', 
            'nombre' => 'Bermudas', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '975', 
            'nombre' => 'Bután', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '591', 
            'nombre' => 'Bolivia', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([  
            'codigo' => '387', 
            'nombre' => 'Bosnia y Herzegovina', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '267', 
            'nombre' => 'Botsuana', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '55', 
            'nombre' => 'Brasil', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '673', 
            'nombre' => 'Brunéi', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '359', 
            'nombre' => 'Bulgaria', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '226', 
            'nombre' => 'Burkina Faso', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '257',
            'nombre' => 'Burundi', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '855', 
            'nombre' => 'Camboya', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '237', 
            'nombre' => 'Camerún', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '1', 
            'nombre' => 'Canadá', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '238', 
            'nombre' => 'Cabo Verde', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '1-345', 
            'nombre' => 'Islas Caimán', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '236', 
            'nombre' => 'República Centroafricana', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '235', 
            'nombre' => 'Chad', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '56', 
            'nombre' => 'Chile', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '86', 
            'nombre' => 'China', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '61', 
            'nombre' => 'Isla de Navidad', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '57', 
            'nombre' => 'Colombia', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '269', 
            'nombre' => 'Comoras', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '242', 
            'nombre' => 'República del Congo', 
            'estado' => '1'
        ]);

        DB::table('paises')->insert([  
            'codigo' => '243', 
            'nombre' => 'República Democrática del Congo', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '682', 
            'nombre' => 'Islas Cook', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '506', 
            'nombre' => 'Costa Rica', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '385', 
            'nombre' => 'Croacia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '53', 
            'nombre' => 'Cuba', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '599', 
            'nombre' => 'Curazao', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '357', 
            'nombre' => 'Chipre', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '420', 
            'nombre' => 'República Checa', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '45', 
            'nombre' => 'Dinamarca', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '253', 
            'nombre' => 'Yibuti', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '1-767', 
            'nombre' => 'Dominica', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '1-809', 
            'nombre' => 'República Dominicana', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([  
            'codigo' => '593',
            'nombre' => 'Ecuador', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '20', 
            'nombre' => 'Egipto', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '503', 
            'nombre' => 'El Salvador', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '240', 
            'nombre' => 'Guinea Ecuatorial', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([  
            'codigo' => '291', 
            'nombre' => 'Eritrea', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '372', 
            'nombre' => 'Estonia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '251', 
            'nombre' => 'Etiopía', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '358', 
            'nombre' => 'Finlandia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '33', 
            'nombre' => 'Francia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '995', 
            'nombre' => 'Georgia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '49', 
            'nombre' => 'Alemania', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '233', 
            'nombre' => 'Ghana', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '30', 
            'nombre' => 'Grecia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '502', 
            'nombre' => 'Guatemala', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '224', 
            'nombre' => 'Guinea', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '245', 
            'nombre' => 'Guinea-Bisáu', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '592', 
            'nombre' => 'Guyana', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '509', 
            'nombre' => 'Haití', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([  
            'codigo' => '504', 
            'nombre' => 'Honduras', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([  
            'codigo' => '852', 
            'nombre' => 'Hong Kong', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '36', 
            'nombre' => 'Hungría', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '354', 
            'nombre' => 'Islandia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '91', 
            'nombre' => 'India', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '62', 
            'nombre' => 'Indonesia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '98', 
            'nombre' => 'Irán', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '964', 
            'nombre' => 'Irak', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([  
            'codigo' => '353', 
            'nombre' => 'Irlanda', 
            'estado' => '1'
        ]);    

        DB::table('paises')->insert([   
            'codigo' => '972', 
            'nombre' => 'Israel', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '39', 
            'nombre' => 'Italia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '1-876', 
            'nombre' => 'Jamaica', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '81', 
            'nombre' => 'Japón', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '962', 
            'nombre' => 'Jordania', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '7', 
            'nombre' => 'Kazajistán', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '254', 
            'nombre' => 'Kenia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '686', 
            'nombre' => 'Kiribati', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '383', 
            'nombre' => 'Kosovo', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '965', 
            'nombre' => 'Kuwait', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '996', 
            'nombre' => 'Kirguistán', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '856', 
            'nombre' => 'Laos', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '371', 
            'nombre' => 'Letonia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '961', 
            'nombre' => 'Líbano', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '266', 
            'nombre' => 'Lesoto', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '231', 
            'nombre' => 'Liberia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '218', 
            'nombre' => 'Libia', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '423', 
            'nombre' => 'Liechtenstein', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '370', 
            'nombre' => 'Lituania', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '352', 
            'nombre' => 'Luxemburgo', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '853', 
            'nombre' => 'Macao', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '389', 
            'nombre' => 'Macedonia', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '261', 
            'nombre' => 'Madagascar', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '265', 
            'nombre' => 'Malaui', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '60', 
            'nombre' => 'Malasia', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '960', 
            'nombre' => 'Maldivas', 
            'estado' => '1'
        ]);   

        DB::table('paises')->insert([   
            'codigo' => '223', 
            'nombre' => 'Malí', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '356', 
            'nombre' => 'Malta', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '692', 
            'nombre' => 'Islas Marshall', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '222', 
            'nombre' => 'Mauritania', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '230', 
            'nombre' => 'Mauricio', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '52', 
            'nombre' => 'México', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '691', 
            'nombre' => 'Micronesia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '373', 
            'nombre' => 'Moldavia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '377', 
            'nombre' => 'Mónaco', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '976', 
            'nombre' => 'Mongolia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '382', 
            'nombre' => 'Montenegro', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '212', 
            'nombre' => 'Marruecos', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '258', 
            'nombre' => 'Mozambique', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '95', 
            'nombre' => 'Birmania', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '264', 
            'nombre' => 'Namibia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '674', 
            'nombre' => 'Nauru', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '977', 
            'nombre' => 'Nepal', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '31', 
            'nombre' => 'Países Bajos', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '64', 
            'nombre' => 'Nueva Zelanda', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '505', 
            'nombre' => 'Nicaragua', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '227', 
            'nombre' => 'Níger', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '234', 
            'nombre' => 'Nigeria', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '850', 
            'nombre' => 'Corea del Norte', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '47', 
            'nombre' => 'Noruega', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '968', 
            'nombre' => 'Omán', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '92', 
            'nombre' => 'Pakistán', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '680', 
            'nombre' => 'Palaos', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '507', 
            'nombre' => 'Panamá', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '675', 
            'nombre' => 'Papúa Nueva Guinea', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '595', 
            'nombre' => 'Paraguay', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '51', 
            'nombre' => 'Perú', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '63', 
            'nombre' => 'Filipinas', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '48', 
            'nombre' => 'Polonia', 
            'estado' => '1'
        ]); 

        DB::table('paises')->insert([   
            'codigo' => '351', 
            'nombre' => 'Portugal', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '1-787', 
            'nombre' => 'Puerto Rico', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '974', 
            'nombre' => 'Catar', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '40', 
            'nombre' => 'Rumania', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '7', 
            'nombre' => 'Rusia', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '250', 
            'nombre' => 'Ruanda', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '685', 
            'nombre' => 'Samoa', 
            'estado' => '1'
        ]);  

        DB::table('paises')->insert([   
            'codigo' => '378', 
            'nombre' => 'San Marino', 
            'estado' => '1'
        ]);    

        DB::table('paises')->insert([
            'codigo' => '239',
            'nombre' => 'Santo Tomé y Príncipe',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '966',
            'nombre' => 'Arabia Saudita',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '221',
            'nombre' => 'Senegal',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '381',
            'nombre' => 'Serbia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '248',
            'nombre' => 'Seychelles',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '232',
            'nombre' => 'Sierra Leona',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '65',
            'nombre' => 'Singapur',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '421',
            'nombre' => 'Eslovaquia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '386',
            'nombre' => 'Eslovenia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '677',
            'nombre' => 'Islas Salomón',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '252',
            'nombre' => 'Somalia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '27',
            'nombre' => 'Sudáfrica',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '82',
            'nombre' => 'Corea del Sur',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '211',
            'nombre' => 'Sudán del Sur',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '34',
            'nombre' => 'España',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '94',
            'nombre' => 'Sri Lanka',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '249',
            'nombre' => 'Sudán',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '597',
            'nombre' => 'Surinam',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '268',
            'nombre' => 'Esuatini',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '46',
            'nombre' => 'Suecia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '41',
            'nombre' => 'Suiza',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '963',
            'nombre' => 'Siria',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '886',
            'nombre' => 'Taiwán',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '992',
            'nombre' => 'Tayikistán',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '255',
            'nombre' => 'Tanzania',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '66',
            'nombre' => 'Tailandia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '670',
            'nombre' => 'Timor Oriental',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '228',
            'nombre' => 'Togo',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '690',
            'nombre' => 'Tokelau',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '676',
            'nombre' => 'Tonga',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '1-868',
            'nombre' => 'Trinidad y Tobago',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '216',
            'nombre' => 'Túnez',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '90',
            'nombre' => 'Turquía',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '993',
            'nombre' => 'Turkmenistán',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '688',
            'nombre' => 'Tuvalu',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '256',
            'nombre' => 'Uganda',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '380',
            'nombre' => 'Ucrania',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '971',
            'nombre' => 'Emiratos Árabes Unidos',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '44',
            'nombre' => 'Reino Unido',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '1',
            'nombre' => 'Estados Unidos',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '598',
            'nombre' => 'Uruguay',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '998',
            'nombre' => 'Uzbekistán',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '678',
            'nombre' => 'Vanuatu',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '58',
            'nombre' => 'Venezuela',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '84',
            'nombre' => 'Vietnam',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '681',
            'nombre' => 'Wallis y Futuna',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '212',
            'nombre' => 'Sahara Occidental',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '967',
            'nombre' => 'Yemen',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '260',
            'nombre' => 'Zambia',
            'estado' => '1'
        ]);
        
        DB::table('paises')->insert([
            'codigo' => '263',
            'nombre' => 'Zimbabue',
            'estado' => '1'
        ]);
    }
}
