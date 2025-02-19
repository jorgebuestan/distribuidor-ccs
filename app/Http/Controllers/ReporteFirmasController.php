<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\TipoSolicitud;
use App\Models\TipoVigencia;
use App\Models\Firma;
use App\Models\ArchivoDocumento;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Storage;

class ReporteFirmasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            return view('not_authorized');
        } 

        //$fechaEmision = null;
        $tiposSolicitud = TipoSolicitud::pluck('descripcion', 'id');
        $tiposVigencia = TipoVigencia::pluck('descripcion', 'id'); 
        //$verEstado = null;
        //$ultimoEstado = null;
        //$ultimaConsulta = null; 
        //$observaciones = null;

        return view('admin.reporteFirmas', compact('tiposSolicitud', 'tiposVigencia'));
    }

    public function obtener_listado_firmas_emitidas(Request $request)
    {
        $columns = [
            0 => 'firmas.id',
            1 => 'acciones'
        ];

        $query = DB::table('firmas')
            ->join('tipo_solicitud', 'tipo_solicitud.id', '=', 'firmas.id_tipo_solicitud') 
            ->join('tipo_vigencia', 'tipo_vigencia.id', '=', 'firmas.id_tipo_vigencia')
            ->select(
                'firmas.id',
                'firmas.created_at',
                'tipo_solicitud.descripcion as tipo_solicitud',
                'tipo_vigencia.descripcion as tipo_vigencia',
                DB::raw("CONCAT(firmas.nombres, ' ', firmas.apellido_paterno, ' ', firmas.apellido_materno) as cliente"),
                'firmas.updated_at'
            )  
            ->orderBy('firmas.created_at', 'asc');

        // **Filtro por Mes y Año (usando un solo campo "fecha" en formato MM/YYYY)**
        if ($request->has('fecha') && !empty($request->fecha)) {
            list($mes, $anio) = explode('/', $request->fecha); // Separar mes y año
            $query->whereMonth('firmas.created_at', $mes)
                ->whereYear('firmas.created_at', $anio);
        }

        // **Búsqueda**
        if ($search = $request->input('search.value')) {
            $query->where(function ($query) use ($search) {
                $query->where('tipo_solicitud.descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('tipo_vigencia.descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.nombres', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.apellido_paterno', 'LIKE', "%{$search}%")
                    ->orWhere('firmas.apellido_materno', 'LIKE', "%{$search}%");          
            });
        }

        $totalFiltered = $query->count();

        // **Orden**
        $orderColumnIndex = $request->input('order.0.column', 0); // Por defecto, columna 0
        $orderDir = $request->input('order.0.dir', 'asc'); // Por defecto, orden ascendente

        if (isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDir);
        }

        // **Paginación**
        $start = $request->input('start') ?? 0;
        $length = $request->input('length') ?? 10;
        $query->skip($start)->take($length);

        $firmas = $query->get();

        $data = $firmas->map(function ($firma) { 

            return [
                'fecha_emision' => $firma->created_at,
                'tipo_solicitud' => $firma->tipo_solicitud,
                'tipo_vigencia' => $firma->tipo_vigencia,
                'cliente' =>  $firma->cliente,
                'btn_consultar' => '<div class="d-flex justify-content-center align-items-center gap-2">' . 
                    '<button class="btn btn-primary btn-sm" style="font-size: 0.6rem; padding: 0.25rem 0.5rem;" data-id="' . 
                    $firma->id . '">Consultar Estado</button>' .
                    '</div>',
                'ultimo_estado' =>  "EMITIDO (VÁLIDO)",
                'ultima_consulta' =>  $firma->updated_at,  
                'observaciones' => "",
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
