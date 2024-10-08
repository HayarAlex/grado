<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    protected $ini;
    protected $fin;

    public function __construct($ini, $fin)
    {
        $this->ini = $ini;
        $this->fin = $fin;
    }

    // Datos a exportar
    public function collection()
    {
        return collect(DB::select("SELECT f1.flw_order,
            COALESCE(MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END), MAX(f1.flw_step)) as paso_en_curso,
            CASE 
                WHEN MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END) IS NULL THEN 'Concluido'
                ELSE CONCAT('Paso ', MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END))
            END as estado,
            MIN(f1.created_at) AS fecha_creacion,
            MAX(f1.updated_at) AS fecha_actualizacion
        FROM follows f1
        WHERE f1.created_at >= '{$this->ini}' AND f1.updated_at < DATE_ADD('{$this->fin}', INTERVAL 1 DAY)
        GROUP BY f1.flw_order"));
    }

    
    public function headings(): array
    {
        return [
            'Lote',
            'Paso en Curso',
            'Estado',
            'Fecha Inicio',
            'Fecha Fin',
        ];
    }

    
    public function startCell(): string
    {
        return 'A4'; 
    }

    // Estilos para el archivo Excel
    public function styles(Worksheet $sheet)
    {
        
        $sheet->setCellValue('A1', 'Reporte de Proceso de Producción'); 
        $sheet->setCellValue('A2', 'Rango de Fechas: ' . $this->ini . ' al ' . $this->fin);

        
        $sheet->mergeCells('A1:E1'); 
        $sheet->mergeCells('A2:E2'); 
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2')->getFont()->setBold(true); 
        $sheet->getStyle('A4:E4')->getFont()->setBold(true);
    }
}

