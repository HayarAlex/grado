<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$productos = Order::orderBy('prod_id','asc')->paginate(5);
        $productos = Product::all();
        $orders = Order::orderBy('ord_id','desc')->paginate(5);
        return view('Ordenes.list',['productos' => $productos,'ordenes' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordenes = Order::all();
        $ord = new Order;
        $ord->ord_prod = $request->prod;
        $ord->ord_lot = 'lote test';
        $ord->ord_gest = $request->ges;
        $ord->ord_mes = $request->mes;
        $ord->ord_state = 1;
        $ord->save();
        //return Order::orderBy("ord_id")->get();
        return redirect()->route('order.index')->with('status','Agregado');
    }

    public function proemlot($id){
        $query = "select * from types_details";
        $list = DB::select($query);
        return $list;
        //$ordenes = Order::all();
        //return $ordenes;
    }

    public function generate(Request $request){
        $ordenes = Order::orderBy('ord_id', 'desc')->first();
        $arm = 1;
        $order = Order::all()->count();
        $gen = new Order;
        $gen->ord_codp = $request->cod;
        $gen->ord_prod = $request->des;
        $gen->ord_lot = 'OP'.$arm.'0'.$request->mesi.$request->ges.$order;
        $gen->ord_gest = $request->ges;
        $gen->ord_mes = $request->mesi;
        $gen->ord_fecha = date('Y-m-d');
        $gen->ord_state = 1;
        $gen->save();
        $query = "select ord_lot, tipd_orden,tipd_actividad
                    from orders 
                    join product_asignates on ord_codp = proasig_code 
                    join product_types on product_asignates.proasig_idlinea = product_types.product_type_id
                    join types_details on product_types.product_type_id = types_details.tipd_idlinea
                    where ord_lot = '$gen->ord_lot'
                    order by ord_id desc";
        $list = DB::select($query);
        $tamaño = count($list);
        for ($i=0; $i < $tamaño; $i++) { 
            $fol = new Follow;
            $fol->flw_order = $list[$i]->ord_lot;
            $fol->flw_step = $list[$i]->tipd_orden;
            $fol->flw_stepdesc= $list[$i]->tipd_actividad;
            $fol->flw_state=0;
            $fol->save();
        }
        
        return redirect()->route('order.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function indexseg()
    {
        //$productos = Order::orderBy('prod_id','asc')->paginate(5);
        
        //$orders = Order::orderBy('ord_id','desc')->paginate(5);
        $orders = Follow::select('follows.*')
            ->join(DB::raw('(SELECT flw_order, MIN(flw_step) AS Primer_Paso
                            FROM follows
                            WHERE flw_state = 0
                            GROUP BY flw_order) t2'), function ($join) {
                $join->on('follows.flw_order', '=', 't2.flw_order')
                    ->on('follows.flw_step', '=', 't2.Primer_Paso');
            })
            ->where('follows.flw_state', 0)
            ->paginate(5);
        return view('Ordenes.seguimiento',['ordenes' => $orders]);
    }
    public function detSeg($id)
    {
        $fol = Follow::findOrFail($id);
        return view('Ordenes.detail',[
            'follows' => $fol
        ]);
        
    }
    public function confimstate($id)
    {
        $fol = Follow::findOrFail($id);
        $fol->flw_state = 1;
        $fol->save();
        return redirect()->route('seguimiento.index')->with('status','Desactivado');
    }

    public function indexrep()
    {
        return view('Ordenes.report');
    }
    public function report($ini,$fin)
    {
        $query = "SELECT f1.flw_order,
            COALESCE(MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END), MAX(f1.flw_step)) as paso_en_curso,
            CASE 
                WHEN MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END) IS NULL THEN 'Concluido'
                ELSE CONCAT('Paso ', MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END))
            END as estado,
            MIN(f1.created_at) AS fecha_creacion,
            MAX(f1.updated_at) AS fecha_actualizacion
        FROM follows f1
        WHERE f1.created_at >= '$ini' AND f1.updated_at < DATE_ADD('$fin', INTERVAL 1 DAY)
        GROUP BY f1.flw_order";

        $list = DB::select($query);

        // Retorna la vista y pasa los datos de la consulta a la vista
        return view('Ordenes.detreport', ['list' => $list,'ini' => $ini,'fin' => $fin]);
    }
    public function exportPdf($ini, $fin)
    {
        // Consulta para obtener los datos
        $query = "SELECT f1.flw_order,
            COALESCE(MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END), MAX(f1.flw_step)) as paso_en_curso,
            CASE 
                WHEN MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END) IS NULL THEN 'Concluido'
                ELSE CONCAT('Paso ', MIN(CASE WHEN f1.flw_state = 0 THEN f1.flw_step END))
            END as estado,
            MIN(f1.created_at) AS fecha_creacion,
            MAX(f1.updated_at) AS fecha_actualizacion
        FROM follows f1
        WHERE f1.created_at >= '$ini' AND f1.updated_at < DATE_ADD('$fin', INTERVAL 1 DAY)
        GROUP BY f1.flw_order";

        $list = DB::select($query);

        // Generar el contenido HTML para el PDF
        $html = '<h1>Reporte desde ' . $ini . ' hasta ' . $fin . '</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Lote</th>';
        $html .= '<th>Paso en Curso</th>';
        $html .= '<th>Estado</th>';
        $html .= '<th>Fecha Inicio</th>';
        $html .= '<th>Fecha Fin</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($list as $li) {
            $html .= '<tr>';
            $html .= '<td>' . $li->flw_order . '</td>';
            $html .= '<td>' . $li->paso_en_curso . '</td>';
            $html .= '<td>' . $li->estado . '</td>';
            $html .= '<td>' . $li->fecha_creacion . '</td>';
            $html .= '<td>' . $li->fecha_actualizacion . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Definir el nombre del archivo PDF
        $pdfFileName = "reporte_{$ini}_{$fin}.pdf";

        // Generar el PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Usar la función native de PHP para convertir HTML a PDF
        // Asegúrate de que tu servidor tenga habilitada la extensión `mbstring`
        echo "<script>window.print();</script>"; // Esto generará un cuadro de diálogo de impresión
        echo $html; // Esto mostrará el contenido HTML

        exit;
    }

}
