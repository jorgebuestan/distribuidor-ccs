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
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            return view('not_authorized');
        }

        $tipo_contribuyente = TipoContribuyente::pluck('descripcion', 'id');
        $tipo_ambiente = TipoAmbiente::pluck('descripcion', 'id');

        return view('admin.empresas', compact('tipo_contribuyente', 'tipo_ambiente'));
    }

    public function obtener_listado_empresas(Request $request)

    {
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

    //pendiente de revisar
    $json_data = [
        'draw' => intval($request->input('draw')),
        'recordsTotal' => DB::table('empresas')->count(),
        'recordsFiltered' => $totalFiltered,
    ];

    return response()->json($json_data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function registrar_empresa(Request $request)
    {
        try {
            $rutaLogo = 'default/default_logo.png';

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

            DB::beginTransaction();

            $empresa = Empresa::create([
                
                //'id_empresa' => $empresa->id,
                'logo' => $rutaLogo,
                'firma' => $rutaFirma,
                'ruc' => strtoupper($request->input('ruc')),
                'razon_social' => strtoupper($request->input('razon_social')),
                'obligado_contabilidad' => $request->input('obligado_contabilidad'),
                'id_tipo_contribuyente' => $request->input('id_tipo_contribuyente'),
                'direccion' => strtoupper($request->input('direccion')),
                'telefono' => $request->input('telefono'),
                'email_administrativo' => $request->input('email_administrativo'),
                'contribuyente_especial' => $request->input('contribuyente_especial'),
                'email_comprobante_electronico' => $request->input('email_comprobante_electronico'),
                'id_ambiente' => $request->input('id_ambiente'),
                'clave_firma' => $request->input('clave_firma'),
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Empresa registrada correctamente'], 200);

        } catch (\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al registrar la empresa: ' . $e->getMessage()], 500);
        }
    }

    public function modificar_empresa(Request $request)
    {
        try{
            DB::beginTransaction();

            $empresa = Empresa::find($request->input('id_empresa'));

            if (!$empresa){
                return response()->json(['success' => false, 'message' => 'Empresa no encontrada'], 404);
            }
            
            $rutaLogo = $empresa->logo;

            if ($request->hasFile('logoFile_mod')){
                $ruc = $request->input('ruc_mod');
                $archivoLogo = $request->file('logoFile_mod');
                $nombreArchivo = "{$ruc}." . $archivoLogo->getClientOriginalExtension();

                $rutaLogo = "{$ruc}/logos/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}/logos", $nombreArchivo, 'public');
            }

            if ($request->hasFile('firmaFile_mod')){
                $ruc = $request->input('ruc_mod');
                $archivoFirma = $request->file('firmaFile_mod');
                $nombreArchivo = "{$ruc}." . $archivoFirma->getClientOriginalExtension();

                $rutaFirma = "{$ruc}/firmas/{$nombreArchivo}";
                $archivoFirma->storeAs("{$ruc}/firmas", $nombreArchivo, 'public');
            }
            
            $empresa->update([
                'logo' => $rutaLogo,
                'firma' => $rutaFirma,
                'ruc' => strtoupper($request->input('ruc_mod')),
                'razon_social' => strtoupper($request->input('razon_social_mod')),
                'obligado_contabilidad' => $request->input('obligado_contabilidad_mod'),
                'id_tipo_contribuyente' => $request->input('id_tipo_contribuyente_mod'),
                'direccion' => strtoupper($request->input('direccion_mod')),
                'telefono' => $request->input('telefono_mod'),
                'email_administrativo' => $request->input('email_administrativo_mod'),
                'contribuyente_especial' => $request->input('contribuyente_especial_mod'),
                'email_comprobante_electronico' => $request->input('email_comprobante_electronico_mod'),
                'id_ambiente' => $request->input('id_ambiente_mod'),
                'clave_firma' => $request->input('clave_firma_mod'),
            ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Empresa modificada correctamente'], 200);
            
        } catch(\Exception $e){
            Log::error($e->getMessage());
            DB::rollBack();
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