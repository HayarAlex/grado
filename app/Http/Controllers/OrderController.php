<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Follow;
use App\Master;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
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
        $query = "select ord_lot, tipd_orden,tipd_actividad,tipd_almdestino,proasig_state
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
            $fol->flw_almacen= $list[$i]->tipd_almdestino;
            $fol->flw_cant= $list[$i]->proasig_state;
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
        $huh = DB::select("
            SELECT f1.flw_order, f1.flw_step, f1.updated_at, f1.flw_state
            FROM follows f1
            WHERE f1.flw_state IN (0, 1)
            AND f1.flw_order IN (
                SELECT flw_order
                FROM follows
                WHERE flw_state = 0
            )
            ORDER BY f1.flw_order, f1.flw_step
        ");
    
        $chartData = [];
        $dataCounts = [];
        $dates = [];
    
        foreach ($huh as $order) {
            $lote = $order->flw_order;
            $step = $order->flw_step;
            $date = $order->updated_at;
    
            // Inicializar si no existe
            if (!isset($chartData[$lote])) {
                $chartData[$lote] = []; // Inicializa como un array si no existe
                $dataCounts[$lote] = []; // También inicializa dataCounts
            }
    
            // Agregar paso y fecha
            $chartData[$lote][] = [
                'step' => $step,
                'date' => $date,
            ];
    
            // Contar los pasos
            $dataCounts[$lote][] = $step;
    
            // Agregar fechas únicas
            if (!in_array($date, $dates)) {
                $dates[] = $date;
            }
        }
    
        return view('Ordenes.seguimiento', [
            'ordenes' => $orders,
            'dates' => json_encode($dates),
            'dataCounts' => json_encode($dataCounts),
            'chartData' => json_encode($chartData), // Asegúrate de pasar chartData a la vista
        ]);
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
        $query = "SELECT flw_order,flw_cant
                FROM follows
                WHERE flw_order = '$fol->flw_order'
                GROUP BY flw_order,flw_cant
                HAVING SUM(CASE WHEN flw_state != 1 THEN 1 ELSE 0 END) = 0";
        $list = DB::select($query);
        $tamaño = count($list);
        if ($tamaño > 0) {
            for ($i=0; $i < $tamaño; $i++) { 
                $ma = new Master;
                $ma->ma_lote = $list[$i]->flw_order;
                $ma->ma_cantidad = $list[$i]->flw_cant;
                $ma->ma_almacen= 'Almacen';
                $ma->ma_fecha= date('Y-m-d H:i:s');
                $ma->save();
            }
            
        }
        return redirect()->route('seguimiento.index')->with('status','Desactivado');
    }

    public function indexrep()
    {
        return view('Ordenes.report');
    }
    public function report($ini,$fin)
    {
        $query = "SELECT f1.flw_order,
            MIN(f1.flw_almacen) AS flw_almacen,
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
    public function exportExcel($ini, $fin)
    {
        return Excel::download(new ReportExport($ini, $fin), "reporte_{$ini}_{$fin}.xlsx");
    }

    public function indexmaster()
    {
        $results = Master::join('orders', 'masters.ma_lote', '=', 'orders.ord_lot')
                ->select('masters.*', 'orders.*')
                ->orderBy('ma_id','desc')
                ->paginate(5);
        return view('Ordenes.maestro',['ordenes' => $results]);
    }

    public function cprod($id){
        $query = "SELECT 
            COUNT(dis_id) AS totald,
            SUM(CASE WHEN dis_state_ate = 0 THEN 1 ELSE 0 END) AS pendientesd,
            SUM(CASE WHEN dis_state_ate = 1 THEN 1 ELSE 0 END) AS atendidosd
        FROM 
            distributions";
        $list = DB::select($query);
        $queryin = "SELECT 
            COUNT(ins_id) AS total,
            SUM(CASE WHEN ins_state_ate = 0 THEN 1 ELSE 0 END) AS pendientes,
            SUM(CASE WHEN ins_state_ate = 1 THEN 1 ELSE 0 END) AS atendidos
        FROM 
            institutions";
        $listin = DB::select($queryin);
        $result = [
            'total_pedidosad' => $list[0]->totald ?? 0,
            'pendientesd' => $list[0]->pendientesd ?? 0,
            'atendidosd' => $list[0]->atendidosd ?? 0,
            'total_ins' => $listin[0]->total ?? 0,
            'pendientes' => $listin[0]->pendientes ?? 0,
            'atendidos' => $listin[0]->atendidos ?? 0,
        ];
        return $result;
    }

}
