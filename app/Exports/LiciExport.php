<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LiciExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
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

    public function collection()
    {
        return collect(DB::select("
            SELECT i.ins_id, 
                i.ins_uneg, 
                i.ins_nombre, 
                i.ins_cuce, 
                id.ins_cod, 
                id.ins_desc, 
                id.ins_cant, 
                i.fecha_soli, 
                i.fecha_entg
            FROM institutions i
            JOIN ins_details id ON id.ins_ped = i.ins_id
            WHERE i.ins_uneg = '{$this->uni}' 
            AND i.fecha_soli BETWEEN '{$this->ini}' AND '{$this->fin}'
            ORDER BY i.ins_id ASC
        "));
    }

    public function headings(): array
    {
        return [
            'N° Pedido',
            'Unidad de negocio',
            'Institucion',
            'CUCE',
            'Codigo prod',
            'Producto',
            'Cantidad',
            'Fecha Solicitud',
            'Fecha entrega'
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
