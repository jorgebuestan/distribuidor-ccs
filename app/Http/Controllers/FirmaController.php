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
use App\Models\Firma;
use App\Models\ArchivoDocumento;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Storage;

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

    public function registrar_firma(Request $request)
    {
        try {
            // Iniciar una transacción
            DB::beginTransaction();


            // Validar los campos
            $request->validate([
                'tipo_solicitud' => 'required|string', // El tipo de Solicitud de Creación de Firma
                'tipo_documento' => 'required|string', //Tipo de Documento del Solicitante
                'numero_documento' => 'required|string',
                'codigo_dactilar' => 'nullable|string',
                'nombres' => 'required|string',
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string',
                'fecha_nacimiento' => 'required|date_format:d/m/Y',
                'pais' => 'required|string',
                'tipo_sexo' => 'required|string',
                'celular' => 'required|string',
                'email' => 'required|email',
                'provincia' => 'required|string',
                'canton' => 'required|string',
                'direccion_empresa' => 'required|string',
                'tipo_vigencia' => 'required|string', 

                'cedula_frontal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'cedula_posterior' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->input('tipo_solicitud') == 1) {
                $request->validate([
                    'switch_ruc' => 'required|string',
                    'ruc' => 'nullable|string',  
                ]);
            } 

            if ($request->input('tipo_solicitud') == 2) {
                $request->validate([
                    'ruc_empresa' => 'required|string',  
                    'razon_social_empresa' => 'required|string',   
                    'cargo_representante' => 'required|string',  
                ]);
            }

            if ($request->input('tipo_solicitud') == 3) {
                $request->validate([
                    'ruc_empresa_miembro' => 'required|string',  
                    'razon_social_empresa_miembro' => 'required|string',   
                    'area_miembro' => 'required|string',   
                    'motivo_miembro' => 'required|string',   
                    'cargo_solicitante_miembro' => 'required|string',  
                ]);
            } 

            $data = $request->all(); 
            $data['fecha_nacimiento'] = Carbon::createFromFormat('d/m/Y', $data['fecha_nacimiento'])->format('Y-m-d'); 

            $switch_ruc = $request->has('switch_ruc') ? 1 : 0;
            $ruc_empresa = "";
            $razon_social_empresa = "";

            if ($request->input('tipo_solicitud') == 2) {
                $ruc_empresa = $data['ruc_empresa'];
                $razon_social_empresa = $data['razon_social_empresa'];
            } 

            if ($request->input('tipo_solicitud') == 3) {
                $ruc_empresa = $data['ruc_empresa_miembro'];
                $razon_social_empresa = $data['razon_social_empresa_miembro'];
            }

            // Guardar en la base de datos la Solicitud para nuevo Socio
            $firma = Firma::create([
                'id_tipo_solicitud' => $data['tipo_solicitud'],
                'id_tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $data['numero_documento'], 
                'codigo_dactilar' => $data['codigo_dactilar'],
                'nombres' => $data['nombres'],
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data['apellido_materno'], 
                'fecha_nacimiento' => $data['fecha_nacimiento'], 
                'id_pais' => $data['pais'], 
                'id_sexo' => $data['tipo_sexo'], 
                'celular' => $data['celular'], 
                'email' => $data['email'], 
                'con_ruc' => $switch_ruc, 
                'ruc' => $data['ruc'], 
                'ruc_empresa' =>  $ruc_empresa, 
                'razon_social_empresa' => $razon_social_empresa, 
                'cargo_representante' => $data['cargo_representante'], 
                'area_empresa' => $data['area_miembro'], 
                'motivo_empresa' => $data['motivo_miembro'], 
                'cargo_solicitante' => $data['cargo_solicitante_miembro'], 
                'id_tipo_documento_representante' => $data['tipo_documento_empresa'], 
                'numero_documento_representante' => $data['numero_documento_empresa'], 
                'nombres_representante' => $data['nombres_empresa'], 
                'apellido_paterno_representante' => $data['apellido_paterno_empresa'], 
                'apellido_materno_representante' => $data['apellido_materno_empresa'], 
                'id_provincia' => $data['provincia'], 
                'id_canton' => $data['canton'], 
                'direccion' => $data['direccion_empresa'], 
                'id_tipo_vigencia' => $data['tipo_vigencia'], 
            ]);

            //Manejo de Archivos
            if ($request->hasFile('cedula_frontal') && $request->file('cedula_frontal')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('cedula_frontal');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_1_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 1,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('cedula_posterior') && $request->file('cedula_posterior')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('cedula_posterior');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_2_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 2,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('cedula_selfie') && $request->file('cedula_selfie')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('cedula_selfie');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_3_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 3,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('ruc_image') && $request->file('ruc_image')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('ruc_image');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_4_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 4,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('documento_adicional') && $request->file('documento_adicional')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('documento_adicional');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_5_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 5,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('constitucion_compania') && $request->file('constitucion_compania')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('constitucion_compania');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_6_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 6,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('nombramiento_representante') && $request->file('nombramiento_representante')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('nombramiento_representante');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_7_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 7,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('aceptacion_nombramiento') && $request->file('aceptacion_nombramiento')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('aceptacion_nombramiento');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_8_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 8,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('cedula_representante') && $request->file('cedula_representante')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('cedula_representante');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_9_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 9,
                    'ruta' => $rutaLogo 
                ]);
            }

            if ($request->hasFile('autorizacion_representante') && $request->file('autorizacion_representante')->isValid()) {
                $ruc = $data['numero_documento'];
                $archivoLogo = $request->file('autorizacion_representante');
                $extension = $archivoLogo->getClientOriginalExtension();
                
                // Crear un nombre único utilizando el timestamp o un hash
                $nombreArchivo = "{$ruc}_10_" . time() . ".{$extension}"; // Usar `time()` para garantizar que el nombre sea único
            
                // Crear carpeta con el nombre del RUC y guardar el archivo
                $rutaLogo = "{$ruc}/{$nombreArchivo}";
                $archivoLogo->storeAs("{$ruc}", $nombreArchivo, 'public');

                $archivoDocumento = ArchivoDocumento::create([
                    'id_firma' => $firma->id,
                    'id_tipo_archivo' => 10,
                    'ruta' => $rutaLogo 
                ]);
            } 

            

            // Confirmar la transacción
            DB::commit();

            return response()->json([
                'codigo' => '200', 
                'message' => 'Registro de Firma agregado exitosamente' 
            ], 201);

        } catch (\Exception $e) {
            // En caso de error, hacer rollback
            DB::rollBack();

            return response()->json(['error' => 'Error al registrar firma', 'message' => $e->getMessage()], 500);
        } 
    }

}
