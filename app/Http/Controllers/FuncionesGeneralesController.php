<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Canton;

class FuncionesGeneralesController extends Controller
{
    //
    public function get_provincias(Request $request)
    {  
        $id_pais = request('id_pais');
        $provincias = Provincia::where('id_pais', $id_pais)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        // Si no hay provincias para el país, o siempre se quiere incluir la provincia con ID = 1
        if (!$provincias->has(1)) {
            $provinciaDefault = Provincia::find(1); // Obtenemos la provincia con ID = 1
            if ($provinciaDefault) {
                $provincias->put($provinciaDefault->id, $provinciaDefault->nombre); // Añadimos al listado
            }
        }
    
        // Formato de respuesta esperado
        return response()->json([
            'provincias' => $provincias->map(function ($nombre, $id) {
                return ['id' => $id, 'nombre' => $nombre];
            })->values(),
        ]);
    }

    public function get_cantones(Request $request)
    {  
        $id_pais = request('id_pais');
        $id_provincia = request('id_provincia');
        $cantones = Canton::where('id_pais', $id_pais)->where('id_provincia', $id_provincia)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        // Si no hay provincias para el país, o siempre se quiere incluir la provincia con ID = 1
        if (!$cantones->has(1)) {
            $cantonDefault = Canton::find(1); // Obtenemos la provincia con ID = 1
            if ($cantonDefault) {
                $cantones->put($cantonDefault->id, $cantonDefault->nombre); // Añadimos al listado
            }
        }
    
        // Formato de respuesta esperado
        return response()->json([
            'cantones' => $cantones->map(function ($nombre, $id) {
                return ['id' => $id, 'nombre' => $nombre];
            })->values(),
        ]);
    }

    public function get_parroquias(Request $request)
    {  
        $id_pais = request('id_pais');
        $id_provincia = request('id_provincia');
        $id_canton = request('id_canton');
        $parroquias = Parroquia::where('id_pais', $id_pais)
        ->where('id_provincia', $id_provincia)
        ->where('id_canton', $id_canton)->orderBy('nombre', 'asc')->pluck('nombre', 'id');

        // Si no hay provincias para el país, o siempre se quiere incluir la provincia con ID = 1
        if (!$parroquias->has(1)) {
            $parroquiaDefault = Canton::find(1); // Obtenemos la provincia con ID = 1
            if ($parroquiaDefault) {
                $parroquias->put($parroquiaDefault->id, $parroquiaDefault->nombre); // Añadimos al listado
            }
        }
    
        // Formato de respuesta esperado
        return response()->json([
            'parroquias' => $parroquias->map(function ($nombre, $id) {
                return ['id' => $id, 'nombre' => $nombre];
            })->values(),
        ]);
    }

}
