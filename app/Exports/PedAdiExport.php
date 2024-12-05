<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PedAdiExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    protected $ini;
    protected $fin;
    protected $uni;

    public function __construct($ini, $fin,$uni)
    {
        $this->ini = $ini;
        $this->fin = $fin;
        $this->uni = $uni;
    }

    // Datos a exportar
    public function collection()
    {
        return collect(DB::select("
            SELECT d.dis_id, d.dis_uneg, dd.det_cod, dd.det_desc, dd.det_cant, d.fecha_soli, d.fecha_aten
            FROM distributions d
            JOIN dis_details dd ON dd.det_ped = d.dis_id
            WHERE d.dis_uneg = '{$this->uni}' 
            AND d.fecha_soli BETWEEN '{$this->ini}' AND '{$this->fin}'
        "));
    }

    
    public function headings(): array
    {
        return [
            'N° Pedido',
            'Unidad de negocio',
            'Codigo prod',
            'Producto',
            'Cantidad',
            'Fecha Solicitud',
            'Fecha Atencion'
        ];
    }

    
    public function startCell(): string
    {
        return 'A4'; 
    }

    // Estilos para el archivo Excel
    public function styles(Worksheet $sheet)
    {
        
        $sheet->setCellValue('A1', 'Reporte de Pedidos por sucursal'); 
        $sheet->setCellValue('A2', 'Rango de Fechas: ' . $this->ini . ' al ' . $this->fin);

        
        $sheet->mergeCells('A1:E1'); 
        $sheet->mergeCells('A2:E2'); 
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2')->getFont()->setBold(true); 
        $sheet->getStyle('A4:E4')->getFont()->setBold(true);
    }
}
