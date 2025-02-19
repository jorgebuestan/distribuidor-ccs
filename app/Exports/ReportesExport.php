<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ReportesExport implements FromCollection, WithHeadings, WithEvents, WithCustomCsvSettings
{
    protected $datos;

    public function __construct(Collection $datos)
    {
        // Forzar la codificación UTF-8 en los datos
        $this->datos = $datos->map(function ($item) {
            return collect($item)->map(function ($value) {
                return mb_convert_encoding($value, 'UTF-8', 'auto');
            });
        });
    }

    public function collection()
    {
        return $this->datos;
    }

    public function headings(): array
    {
        return [
            'Fecha de Emisión',
            'Cliente',
            'Tipo de Firma',
            'Vigencia de Firma',
            'Última Consulta',
            'Observaciones',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajustar automáticamente el ancho de todas las columnas
                foreach (range('A', 'F') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Aplicar formato de texto explícito a la columna "D"
                $highestRow = $sheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $cell = 'D' . $row;
                    $value = $sheet->getCell($cell)->getValue();
                    $sheet->setCellValueExplicit($cell, $value, DataType::TYPE_STRING);
                }
            },
        ];
    }

    // Agregar configuración personalizada para CSV
    public function getCsvSettings(): array
    {
        return [
            'output_encoding' => 'UTF-8', // Forzar la codificación UTF-8
            'use_bom' => true, // Agregar el BOM (Byte Order Mark)
        ];
    }
}