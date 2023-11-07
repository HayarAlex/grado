<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Unegocio;
use App\Product;
use App\DisDetail;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unegocio::where('uneg_state', 1)
                    ->orderBy('uneg_id', 'desc')
                    ->paginate(5);
        return view('Distribuciones.unit',[
            'unidades' => $unidades
        ]);
    }
    public function indexadm()
    {
        $unidades = Unegocio::where('uneg_state', 1)
                    ->orderBy('uneg_id', 'desc')
                    ->paginate(5);
        return view('Distribuciones.admunit',[
            'unidades' => $unidades
        ]);
    }
    public function newped($id)
    {
        $unidades = Unegocio::findOrFail($id);
        $pedidos = Distribution::where('dis_uneg', $id)
                    ->where('dis_state',0)
                    ->orderBy('dis_id', 'desc')
                    ->paginate(5);
        return view('Distribuciones.new',[
            'unidades' => $unidades,
            'pedidos' => $pedidos
        ]);
    }

    public function admped($id)
    {
        $unidades = Unegocio::findOrFail($id);
        $pedidos = Distribution::where('dis_uneg', $id)
                    ->where('dis_state',0)
                    ->orderBy('dis_id', 'desc')
                    ->paginate(5);
        return view('Distribuciones.admpedidos',[
            'unidades' => $unidades,
            'pedidos' => $pedidos
        ]);
    }

    public function detped($id)
    {
        $pedidos = Distribution::findOrFail($id);
        $unidades = Unegocio::findOrFail($pedidos->dis_uneg);
        $productos = Product::all();
        $listprods = DisDetail::where('det_ped',$id)->paginate(5);
        //return $unidades;
        return view('Distribuciones.detail',[
            'unidades' => $unidades,
            'pedidos' => $pedidos,
            'productos' => $productos,
            'listprods' => $listprods
        ]);
    }

    public function activate(Request $request)
    {
        $dis = Distribution::findOrFail($request->idped);
        $dis->dis_state_env = 1;
        $dis->update();
        return Distribution::orderBy("dis_id")->get();
    }
    public function cancelar(Request $request)
    {
        $dis = Distribution::findOrFail($request->idped);
        $dis->dis_state = 1;
        $dis->update();
        return Distribution::orderBy("dis_id")->get();
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
        $dis = new Distribution;
        $dis->dis_uneg = $request->uneg;
        $dis->dis_nombre = 'Pedido';
        $dis->dis_state = 0;
        $dis->dis_state_env = 0;
        $dis->dis_state_ate = 0;
        $dis->fecha_soli = date('Y-m-d');
        $dis->save();
        return Distribution::orderBy("dis_id")->get();
    }

    public function storedet(Request $request)
    {
        $dis = new DisDetail;
        $dis->det_ped = $request->pedi;
        $dis->det_uneg = $request->uneg;
        $dis->det_cod = $request->cod;
        $dis->det_desc = $request->des;
        $dis->det_cant = $request->can;
        $dis->det_state = 0;
        $dis->det_state_ate = 0;
        $dis->det_state_apro = 0;
        $dis->det_fecha_ate = date('Y-m-d');
        $dis->det_fecha_apro = date('Y-m-d');
        $dis->save();
        return DisDetail::orderBy("det_id")->where('det_ped',$request->pedi)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show(Distribution $distribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribution $distribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribution $distribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribution $distribution)
    {
        //
    }
}
