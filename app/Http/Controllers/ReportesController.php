<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PDF; // Asegúrate de usar Laravel-DomPDF
use App\Exports\FirmasExport;
use App\Exports\EmpresasExport;

class ReportesController extends Controller
{
    // Sección para exportado de firmas

    public function exportar_pdf_firmas(Request $request){ 

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
 

        $firmas = $query->get();   

       // Generar PDF usando una vista Blade con los datos filtrados firmas
       //$pdf = PDF::loadView('reportes.firmas', ['firmas' => $firmas]);
       $pdf = PDF::loadView('reportes.firmas', ['firmas' => $firmas])->setPaper('a4', 'landscape');
       // Descargar el PDF
       return $pdf->download('firmas_registradas.pdf'); 
    }

    public function exportar_excel_firmas(Request $request){ 

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
 

        $firmas = $query->get();   

       // Exportar a Excel
       return Excel::download(new FirmasExport($firmas), 'firmas_registradas.xlsx');
    }

    public function exportar_csv_firmas(Request $request){
        // Obtener los datos de la consulta
        $firmas = DB::table('firmas')
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
            ->orderBy('firmas.apellido_paterno', 'asc')
            ->get(); // Obtener los datos como colección

        // Descargar el archivo CSV con los datos
        return Excel::download(new FirmasExport($firmas), 'firmas.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function imprimir_pdf_firmas(Request $request){ 

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
 

        $firmas = $query->get();   

       // Generar PDF usando una vista Blade con los datos filtrados firmas
       //$pdf = PDF::loadView('reportes.firmas', ['firmas' => $firmas]);
       $pdf = PDF::loadView('reportes.firmas', ['firmas' => $firmas])->setPaper('a4', 'landscape');
       // Descargar el PDF
       return $pdf->stream('firmas.pdf');
    }

    // Sección para exportado de empresas

    public function exportar_pdf_empresas(Request $request){ 

        $query = DB::table('empresas')
            ->join('tipo_contribuyente', 'tipo_contribuyente.id', '=', 'empresas.id_tipo_contribuyente') 
            ->join('tipo_ambiente', 'tipo_ambiente.id', '=', 'empresas.id_ambiente') 
            ->select(
                'empresas.id',
                'empresas.ruc',
                'empresas.razon_social',
                DB::raw("CASE WHEN empresas.obligado_contabilidad = 1 THEN 'SÍ' ELSE 'NO' END as obligado_contabilidad"),
                'tipo_contribuyente.descripcion as tipo_contribuyente',
                'empresas.direccion',
                'empresas.telefono',
                'empresas.correo_administrativo',
                DB::raw("CASE WHEN empresas.contribuyente_especial = 1 THEN 'SÍ' ELSE 'NO' END as contribuyente_especial"),
                'empresas.correo_comprobante_electronico',
                'tipo_ambiente.descripcion as tipo_ambiente',                   
            )  
            ->orderBy('empresas.razon_social', 'asc'); 

        $empresas = $query->get();   

        // Generar PDF usando una vista Blade con los datos filtrados empresas
        $pdf = PDF::loadView('reportes.empresas', ['empresas' => $empresas])->setPaper('a4', 'landscape');
        // Descargar el PDF
        return $pdf->download('empresas_registradas.pdf'); 
    }

    public function exportar_excel_empresas(Request $request){ 

        $query = DB::table('empresas')
            ->join('tipo_contribuyente', 'tipo_contribuyente.id', '=', 'empresas.id_tipo_contribuyente') 
            ->join('tipo_ambiente', 'tipo_ambiente.id', '=', 'empresas.id_ambiente') 
            ->select(
                'empresas.id',
                'empresas.ruc',
                'empresas.razon_social',
                DB::raw("CASE WHEN empresas.obligado_contabilidad = 1 THEN 'SÍ' ELSE 'NO' END as obligado_contabilidad"),
                'tipo_contribuyente.descripcion as tipo_contribuyente',
                'empresas.direccion',
                'empresas.telefono',
                'empresas.correo_administrativo',
                DB::raw("CASE WHEN empresas.contribuyente_especial = 1 THEN 'SÍ' ELSE 'NO' END as contribuyente_especial"),
                'empresas.correo_comprobante_electronico',
                'tipo_ambiente.descripcion as tipo_ambiente',                   
            ) 
            ->orderBy('empresas.razon_social', 'asc'); 

        $empresas = $query->get();   

        // Exportar a Excel
        return Excel::download(new EmpresasExport($empresas), 'empresas_registradas.xlsx');
    }

    public function exportar_csv_empresas(Request $request){

        // Obtener los datos de la consulta
        $empresas = DB::table('empresas')
            ->join('tipo_contribuyente', 'tipo_contribuyente.id', '=', 'empresas.id_tipo_contribuyente') 
            ->join('tipo_ambiente', 'tipo_ambiente.id', '=', 'empresas.id_ambiente') 
            ->select(
                'empresas.id',
                'empresas.ruc',
                'empresas.razon_social',
                DB::raw("CASE WHEN empresas.obligado_contabilidad = 1 THEN 'SÍ' ELSE 'NO' END as obligado_contabilidad"),
                'tipo_contribuyente.descripcion as tipo_contribuyente',
                'empresas.direccion',
                'empresas.telefono',
                'empresas.correo_administrativo',
                DB::raw("CASE WHEN empresas.contribuyente_especial = 1 THEN 'SÍ' ELSE 'NO' END as contribuyente_especial"),
                'empresas.correo_comprobante_electronico',
                'tipo_ambiente.descripcion as tipo_ambiente',                   
            ) 
            ->orderBy('empresas.razon_social', 'asc')
            ->get(); // Obtener los datos como colección

        // Descargar el archivo CSV con los datos
        return Excel::download(new EmpresasExport($empresas), 'empresas.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function imprimir_pdf_empresas(Request $request){ 

        $query = DB::table('empresas')
            ->join('tipo_contribuyente', 'tipo_contribuyente.id', '=', 'empresas.id_tipo_contribuyente') 
            ->join('tipo_ambiente', 'tipo_ambiente.id', '=', 'empresas.id_ambiente') 
            ->select(
                'empresas.id',
                'empresas.ruc',
                'empresas.razon_social',
                DB::raw("CASE WHEN empresas.obligado_contabilidad = 1 THEN 'SÍ' ELSE 'NO' END as obligado_contabilidad"),
                'tipo_contribuyente.descripcion as tipo_contribuyente',
                'empresas.direccion',
                'empresas.telefono',
                'empresas.correo_administrativo',
                DB::raw("CASE WHEN empresas.contribuyente_especial = 1 THEN 'SÍ' ELSE 'NO' END as contribuyente_especial"),
                'empresas.correo_comprobante_electronico',
                'tipo_ambiente.descripcion as tipo_ambiente',                   
            ) 
            ->orderBy('empresas.razon_social', 'asc'); 

        $empresas = $query->get();   

        // Generar PDF usando una vista Blade con los datos filtrados empresas
        $pdf = PDF::loadView('reportes.empresas', ['empresas' => $empresas])->setPaper('a4', 'landscape');
        // Descargar el PDF
        return $pdf->stream('empresas.pdf');
    }


}
