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

class ReportesController extends Controller
{
    //
    public function exportar_pdf_firmas(Request $request)
    { 

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

    public function exportar_excel_firmas(Request $request)
    { 

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

    public function exportar_csv_firmas(Request $request)
    {
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

    public function imprimir_pdf_firmas(Request $request)
    { 

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
       $pdf = PDF::loadView('reportes.firmas_imprimir', ['firmas' => $firmas])->setPaper('a4', 'landscape');
       // Descargar el PDF
       return $pdf->stream('firmas.pdf');
    }
}
