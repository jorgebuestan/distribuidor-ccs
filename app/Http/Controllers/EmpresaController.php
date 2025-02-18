<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\TipoContribuyente;
use App\Models\TipoAmbiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        if (!Auth::user()->hasRole('admin')) {
            return view('not_authorized');
        }

        $tipo_contribuyente = TipoContribuyente::pluck('descripcion', 'id');
        $tipo_ambiente = TipoAmbiente::pluck('descripcion', 'id');

        return view('admin.empresas', compact('tipo_contribuyente', 'tipo_ambiente'));
    }

    public function obtener_listado_empresas(Request $request){
        
        $columns = [
            0 => 'empresas.id',
            1 => 'acciones'
        ];

        $query = DB::table('empresas')
            ->select(
                'empresas.id',
                'empresas.razon_social',
                'empresas.ruc',
            )
            ->orderBy('empresas.razon_social', 'asc');  

        // Busqueda por razon social o ruc

        if ($search = $request->input('search.value')) {
            $query->where(function($query) use ($search) {
                $query->where('empresas.razon_social', 'like', "%$search%")
                    ->orWhere('empresas.ruc', 'like', "%$search%");
            });
        }

        $totalFiltered = $query->count();

        // Ordenar por columna seleccionada y direccion de ordenamiento (asc o desc) 

        $orderColumnIndex = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir', 'asc');

        if (isset($columns[$orderColumnIndex])) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDir);
        }

        // Paginacion
        $start = $request->input('start') ?? 0;
        $length = $request->input('length') ?? 10;
        $query->skip($start)->take($length);

        $empresas = $query->get();

        $data = $empresas->map(function ($empresa) {

            //$boton = "";

            return [
                'id' => $empresa->id,
                'razon_social' => $empresa->razon_social,
                'ruc' => $empresa->ruc,
                'btn' => '<div class="d-flex justify-content-center align-items-center gap-2">' .
                            '<button class="btn btn-outline-warning mb-3 btn-sm rounded-pill open-modal" data-id="' . $empresa->id . '"><i class="fa-solid fa-pencil"></i>&nbsp;Modificar</button>' . 
                            '</div>'
            ];
        });

        //pendiente de revisar
        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => DB::table('empresas')->count(),
            'recordsFiltered' => $totalFiltered,
            "data" => $data
        ];

        return response()->json($json_data);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function registrar_empresa(Request $request){
        /*
        $request->validate([
            'ruc' => 'required',
            'razon_social' => 'required',
            'obligado_contabilidad' => 'required',
            'id_tipo_contribuyente' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_administrativo' => 'required|email',
            'contribuyente_especial' => 'required',
            'correo_comprobante_electronico' => 'required|email',
            'id_ambiente' => 'required',
            'clave_firma' => 'required',
        ]);

        */

        // $data = $request->all();

        try {
            $rutaLogo = 'default/default_logo.png';
            $rutaFirma = 'default/default_firma.png';

            if ($request->hasFile('logoFile'))  {
                $ruc = $request->input('ruc');
                $archivoLogo = $request->file('logoFile');
                $nombreArchivo = "{$ruc}}." . $archivoLogo->getClientOriginalExtension();

                $rutaLogo = "{$ruc}/logos/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}/logos", $nombreArchivo, 'public');
            }

            if ($request->hasFile('firmaFile')) {
                $ruc = $request->input('ruc');
                $archivoFirma = $request->file('firmaFile');
                $nombreArchivo = "{$ruc}}." . $archivoFirma->getClientOriginalExtension();

                $rutaFirma = "{$ruc}/firmas/{$nombreArchivo}";
                $archivoFirma->storeAs("{$ruc}/firmas/", $nombreArchivo, 'public');
            }

            $empresa = Empresa::create([
                
                'logo' => $rutaLogo,
                'firma' => $rutaFirma,
                'ruc' => strtoupper($request->input('ruc')),
                'razon_social' => strtoupper($request->input('razon_social')),
                'obligado_contabilidad' => $request->input('obligado_contabilidad'),
                'id_tipo_contribuyente' => $request->input('id_tipo_contribuyente'),
                'direccion' => strtoupper($request->input('direccion')),
                'telefono' => $request->input('telefono'),
                'correo_administrativo' => $request->input('correo_administrativo'),
                'contribuyente_especial' => $request->input('contribuyente_especial'),
                'correo_comprobante_electronico' => $request->input('correo_comprobante_electronico'),
                'id_ambiente' => $request->input('id_ambiente'),
                'clave_firma' => $request->input('clave_firma'),
            ]);

            return response()->json(['success' => true, 'message' => 'Empresa registrada correctamente'], 200);

        } catch (\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al registrar la empresa: ' . $e->getMessage()], 500);
        }
    }

    public function obtenerDatosEmpresa($id){
        $empresa = Empresa::find($id);
    
        if (!$empresa) {
            return response()->json(['success' => false, 'message' => 'Empresa no encontrada'], 404);
        }
    
        return response()->json($empresa);
    }

    public function modificar_empresa(Request $request){
        try {
            // Validar los datos de la solicitud
            $request->validate([
                'id_empresa' => 'required|exists:empresas,id',
                'ruc' => 'required|size:13',
                'razon_social' => 'required|string|max:255',
                'obligado_contabilidad' => 'required|in:true,false,1,0',
                'contribuyente_especial' => 'required|in:true,false,1,0',
                'id_tipo_contribuyente' => 'required|integer',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:20',
                'correo_administrativo' => 'required|email',
                'correo_comprobante_electronico' => 'required|email',
                'id_ambiente' => 'required|integer',
                'clave_firma' => 'required|string|max:255',
                'logoFile' => 'nullable|file|mimes:jpg,jpeg,png',
                'firmaFile' => 'nullable|file|mimes:jpg,jpeg,png',
            ]);

            // Buscar la empresa a modificar
            $empresa = Empresa::find($request->input('id_empresa'));

            // Si la empresa no existe
            if (!$empresa) {
                return response()->json(['success' => false, 'message' => 'Empresa no encontrada'], 404);
            }

            // Inicializar rutas de logo y firma (mantener los valores antiguos si no se cargan nuevos archivos)
            $rutaLogo = $empresa->logo;
            $rutaFirma = $empresa->firma;

            // Subir nuevo logo si fue proporcionado
            if ($request->hasFile('logoFile')) {
                $ruc = $request->input('ruc');
                $archivoLogo = $request->file('logoFile');
                $nombreArchivoLogo = "{$ruc}." . $archivoLogo->getClientOriginalExtension();

                // Almacenar archivo de logo
                $rutaLogo = "{$ruc}/logos/{$nombreArchivoLogo}";
                $archivoLogo->storeAs("{$ruc}/logos", $nombreArchivoLogo, 'public');
            }

            // Subir nueva firma si fue proporcionada
            if ($request->hasFile('firmaFile')) {
                $ruc = $request->input('ruc');
                $archivoFirma = $request->file('firmaFile');
                $nombreArchivoFirma = "{$ruc}." . $archivoFirma->getClientOriginalExtension();

                // Almacenar archivo de firma
                $rutaFirma = "{$ruc}/firmas/{$nombreArchivoFirma}";
                $archivoFirma->storeAs("{$ruc}/firmas", $nombreArchivoFirma, 'public');
            }

            // Asignar los nuevos valores a los atributos del modelo
            $empresa->logo = $rutaLogo;
            $empresa->firma = $rutaFirma;
            $empresa->ruc = strtoupper($request->input('ruc'));
            $empresa->razon_social = strtoupper($request->input('razon_social'));
            $empresa->obligado_contabilidad = $request->input('obligado_contabilidad');
            $empresa->id_tipo_contribuyente = $request->input('id_tipo_contribuyente');
            $empresa->direccion = strtoupper($request->input('direccion'));
            $empresa->telefono = $request->input('telefono');
            $empresa->correo_administrativo = $request->input('correo_administrativo');
            $empresa->contribuyente_especial = $request->input('contribuyente_especial');
            $empresa->correo_comprobante_electronico = $request->input('correo_comprobante_electronico');
            $empresa->id_ambiente = $request->input('id_ambiente');
            $empresa->clave_firma = $request->input('clave_firma');

            // Guardar los cambios en la base de datos
            $empresa->save();

            return response()->json(['success' => true, 'message' => 'Empresa modificada correctamente'], 200);

        } catch (\Exception $e) {
            Log::error("Error al modificar la empresa: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al modificar la empresa: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}