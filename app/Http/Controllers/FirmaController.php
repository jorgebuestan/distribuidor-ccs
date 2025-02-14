<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Canton;
use App\Models\TipoSolicitud;
use App\Models\TipoDocumento;
use App\Models\TipoSexo;
use App\Models\TipoVigencia;

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
        $tiposSolicitud = TipoSolicitud::pluck('descripcion', 'id');  
        $tiposDocumento = TipoDocumento::pluck('descripcion', 'id');   
        $tiposSexo = TipoSexo::pluck('descripcion', 'id');    
        $tiposVigencia = TipoVigencia::pluck('descripcion', 'id');  

        $provinciaDefault = Provincia::find(1); // Obtenemos la provincia con ID = 1
        if ($provinciaDefault) {
            $provincias->put($provinciaDefault->id, $provinciaDefault->nombre); // Añadimos al listado
        }

        $cantonDefault = Canton::find(1); // Obtenemos la provincia con ID = 1
        if ($cantonDefault) {
            $cantones->put($cantonDefault->id, $cantonDefault->nombre); // Añadimos al listado
        } 

        return view('admin.firmas', compact('paises', 'provincias', 'cantones', 'tiposSolicitud', 'tiposDocumento', 'tiposSexo', 'tiposVigencia'));
    }

    public function obtener_listado_firmas(Request $request)
    {
        $columns = [
            0 => 'firmas.id',
            1 => 'acciones'
        ];

        $query = DB::table('firmas')
            ->join('tipo_solicitud', 'tipo_solicitud.id', '=', 'firmas.id_tipo_solicitud') 
            ->join('tipo_documento', 'tipo_documento.id', '=', 'firmas.id_tipo_documento') 
            ->select(
                'firmas.id',
                'tipo_solicitud.descripcion as tipo_solicitud',
                'tipo_documento.descripcion as tipo_documento',
                'firmas.numero_documento',
                'firmas.nombres',
                'firmas.apellido_paterno',
                'firmas.apellido_materno',
                'firmas.celular',
                'firmas.email' 
            )  
            ->orderBy('firmas.apellido_paterno', 'asc');

        // Filtro de localidad 

        // Búsqueda
        if ($search = $request->input('search.value')) {
            $query->where(function ($query) use ($search) {
                $query->where('tipo_solicitud.descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('tipo_documento.descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.numero_documento', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.nombres', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.apellido_paterno', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.apellido_materno', 'LIKE', "%{$search}%");
            });
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

        $firmas = $query->get();

        $data = $firmas->map(function ($firma) { 

            return [
                'id' => $firma->id,
                'tipo_solicitud' => $firma->tipo_solicitud,
                'tipo_documento' => $firma->tipo_documento,
                'numero_documento' => $firma->numero_documento,
                'nombres' =>  $firma->nombres,
                'apellido_paterno' => $firma->apellido_paterno,
                'apellido_materno' => $firma->apellido_materno, 
                'celular' =>  $firma->celular,
                'email' =>  $firma->email,  
            ];
        });

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => DB::table('firmas')->count(),
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];

        return response()->json($json_data);
    }

}
