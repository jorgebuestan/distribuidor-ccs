<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class EmpresasExport implements FromCollection, WithHeadings, WithEvents
{
    protected $datos;

    public function __construct(Collection $datos)
    {
        $this->datos = $datos;
    }

    public function collection()
    {
        return $this->datos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'RUC',
            'Razón Social',
            'Obligado contabilidad',
            'Tipo de Contribuyente',
            'Dirección',
            'Teléfono',
            'Correo Administrativo',
            'Contribuyente Especial',
            'Correo Comprobante Electrónico',
            'Tipo de Ambiente',
        ];
    } 

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Ajustar automáticamente el ancho de todas las columnas
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Aplicar formato de texto explícito a la columna "E" (RUC)
                $highestRow = $sheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $cell = 'E' . $row;
                    $value = $sheet->getCell($cell)->getValue();
                    $sheet->setCellValueExplicit($cell, $value, DataType::TYPE_STRING);
                }
            },
        ];
    }
}
