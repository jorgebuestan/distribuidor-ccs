<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Canton;

class FirmaController extends Controller
{
    //
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            return view('not_authorized');
        } 

        $paises = Pais::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $provincias = Provincia::where('id_pais', 57)->orderBy('nombre', 'asc')->pluck('nombre', 'id'); // Provincias de Ecuador
        $cantones = Canton::where('id_pais', 57)->where('id_provincia', 2)->orderBy('nombre', 'asc')->pluck('nombre', 'id'); // Provincias de Ecuador
          
        $provinciaDefault = Provincia::find(1); // Obtenemos la provincia con ID = 1
        if ($provinciaDefault) {
            $provincias->put($provinciaDefault->id, $provinciaDefault->nombre); // Añadimos al listado
        }

        $cantonDefault = Canton::find(1); // Obtenemos la provincia con ID = 1
        if ($cantonDefault) {
            $cantones->put($cantonDefault->id, $cantonDefault->nombre); // Añadimos al listado
        } 

        return view('admin.firmas', compact('paises', 'provincias', 'cantones'));
    }

    public function obtener_listado_firmas(Request $request)
    {
        $columns = [
            0 => 'camaras.id',
            1 => 'acciones'
        ];

        $query = DB::table('firmas')
            ->select(
                'camaras.id',
                'camaras.fecha_ingreso',
                'camaras.ruc',
                'camaras.razon_social',
                'camaras.cedula_representante_legal',
                'camaras.nombres_representante_legal',
                'camaras.apellidos_representante_legal',
                'camaras.estado_confecam',
                'camaras.fecha_desafiliacion',
                'camaras.motivo_desafiliacion'
            )  
            ->orderBy('camaras.razon_social', 'asc');

        // Filtro de localidad 

        // Búsqueda
        if ($search = $request->input('search.value')) {
            $query->where(function ($query) use ($search) {
                $query->where('camaras.ruc', 'LIKE', "%{$search}%")
                    ->orWhere('camaras.razon_social', 'LIKE', "%{$search}%")
                    ->orWhere('camaras.cedula_representante_legal', 'LIKE', "%{$search}%")
                    ->orWhere('camaras.nombres_representante_legal', 'LIKE', "%{$search}%")
                    ->orWhere('camaras.apellidos_representante_legal', 'LIKE', "%{$search}%");
            });
        }

        if ($idEstado = $request->input('estado')) {
            if($idEstado == 1){
                $query->wherein('camaras.estado_confecam', [0,1]);
            }
            if($idEstado == 2){
                $query->where('camaras.estado_confecam', 1);
            }
            if($idEstado == 3){
                $query->where('camaras.estado_confecam', 0);
            }
        }


        $totalFiltered = $query->count();

        // Orden
        $orderColumnIndex = $request->input('order.0.column', 0); // Por defecto, columna 0
        $orderDir = $request->input('order.0.dir', 'asc'); // Por defecto, orden ascendente

        if (isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDir);
        }

        // Paginación
        $start = $request->input('start') ?? 0;
        $length = $request->input('length') ?? 10;
        $query->skip($start)->take($length);

        $camaras = $query->get();

        $data = $camaras->map(function ($camara) {
            $boton = "";

            $representante_legal = $camara->nombres_representante_legal . " " . $camara->apellidos_representante_legal;
   
            $estado = "";
            if($camara->estado_confecam ==1){
                $estado = '<span class="badge bg-success text-light">ACTIVO</span>';
            }
            if($camara->estado_confecam ==0){
                $estado = '<span class="badge bg-danger text-light">INACTIVO</span>';
            }

            $boton = "";
            $fecha_desafiliacion = "";
            $motivo_desafiliacion = "";

            if($camara->estado_confecam == 1){
                $boton = '<button class="btn btn-outline-danger btn-sm rounded-pill mb-3 desafiliar-camara" data-id="' . $camara->id . '">Desafiliar&nbsp;<i class="fa-solid fa-trash"></i></button>';
            }else{
                $boton = '<button class="btn btn-outline-success btn-sm rounded-pill mb-3 reafiliar-camara" data-id="' . $camara->id . '">&nbsp;&nbsp;&nbsp;Afiliar&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>';
                $fecha_desafiliacion = $camara->fecha_desafiliacion;
                $motivo_desafiliacion = $camara->motivo_desafiliacion;
            } 


            return [
                'fecha_ingreso' => $camara->fecha_ingreso,
                'ruc' => $camara->ruc,
                'razon_social' => $camara->razon_social,
                'cedula_representante_legal' => $camara->cedula_representante_legal,
                'representante_legal' => $representante_legal,
                'fecha_desafiliacion' => $fecha_desafiliacion, 
                'motivo_desafiliacion' => $motivo_desafiliacion, 
                'estado' => $estado,
                /*'btn' => '<div class="d-flex justify-content-center align-items-center gap-2">' .
                            '<button class="btn btn-outline-warning mb-3 btn-sm rounded-pill open-modal" data-id="' . $camara->id . '"><i class="fa-solid fa-pencil"></i>&nbsp;Modificar</button>' .
                            '<button class="btn btn-outline-danger btn-sm rounded-pill mb-3 delete-camara" data-id="' . $camara->id . '">Eliminar&nbsp;<i class="fa-solid fa-trash"></i></button>' .
                         '</div>'*/
                'btn' => '<div class="d-flex justify-content-center align-items-center gap-2">' .
                         //'<button class="btn btn-outline-primary mb-3 btn-sm rounded-pill open-modal" data-id="' . $camara->id . '"><i class="fa-solid fa-file"></i>&nbsp;Archivos</button>'.
                          
                         '<button class="btn btn-outline-primary btn-sm rounded-pill" onclick="window.open(\'/administrador/camara/documentos/' . $camara->id . '\', \'_blank\')"><i class="fa-solid fa-file"></i>&nbsp;Archivos</button>'.
                            '<button class="btn btn-outline-warning mb-3 btn-sm rounded-pill open-modal" data-id="' . $camara->id . '"><i class="fa-solid fa-pencil"></i>&nbsp;Modificar</button>' .
                            $boton .
                         '</div>'         
            ];
        });

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => DB::table('camaras')->count(),
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];

        return response()->json($json_data);
    }

}
