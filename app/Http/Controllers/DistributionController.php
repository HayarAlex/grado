<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Institution;
use App\Unegocio;
use App\Product;
use App\DisDetail;
use App\InsDetail;
use App\UserUnit;
use App\User;
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
        $userId = auth()->id();
        $unidades = UserUnit::where('usu_iduser',$userId)
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
    public function admdetped($id)
    {
        $pedidos = Distribution::findOrFail($id);
        $unidades = Unegocio::findOrFail($pedidos->dis_uneg);
        $productos = Product::all();
        $listprods = DisDetail::where('det_ped',$id)->paginate(5);
        //return $unidades;
        return view('Distribuciones.admdetail',[
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
    public function atender(Request $request)
    {
        $dis = Distribution::findOrFail($request->idped);
        $dis->dis_state_ate = 1;
        $dis->fecha_aten = date('Y-m-d');
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

    public function update(Request $request, $prod_id,$pedido)
    {
        $dis = DisDetail::findOrFail($prod_id);
        $dis->det_cant = $request->cantidad;
        $dis->save();
        return redirect('/Distribucion/Detalle/'.$pedido)->with('status','Actualizado');
    }

    public function updateadm(Request $request, $prod_id,$pedido)
    {
        $dis = DisDetail::findOrFail($prod_id);
        $dis->det_cant = $request->cantidad;
        $dis->det_state_ate = $request->estado;
        $dis->save();
        return redirect('/AdminDistribucion/Detalle/'.$pedido)->with('status','Actualizado');
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
    public function indexi()
    {
        //$unidades = Unegocio::where('uneg_state', 1)
                    //->orderBy('uneg_id', 'desc')
                    //->paginate(5);
        $userId = auth()->id();
        $unidades = UserUnit::where('usu_iduser',$userId)
                    ->paginate(5);
        return view('Instituciones.unit',[
            'unidades' => $unidades
        ]);
    }
    public function newlic($id)
    {
        $unidades = Unegocio::findOrFail($id);
        $pedidos = Institution::where('ins_uneg', $id)
                    ->where('ins_state',0)
                    ->orderBy('ins_id', 'desc')
                    ->paginate(5);
        return view('Instituciones.new',[
            'unidades' => $unidades,
            'pedidos' => $pedidos
        ]);
    }
    public function storei(Request $request)
    {
        $dis = new Institution;
        $dis->ins_uneg = $request->un;
        $dis->ins_nombre = $request->ins;
        $dis->ins_codigo = $request->obse;
        $dis->ins_cuce = $request->cuc;
        $dis->ins_state = 0;
        $dis->ins_state_env = 0;
        $dis->ins_state_ate = 0;
        $dis->fecha_entg = $request->fech;
        $dis->fecha_aten = date('Y-m-d');
        $dis->fecha_soli = date('Y-m-d');
        $dis->save();
        return Institution::orderBy("ins_id")->get();
    }
    public function detinsa($id)
    {
        $pedidos = Institution::findOrFail($id);
        $unidades = Unegocio::findOrFail($pedidos->ins_uneg);
        $productos = Product::all();
        $listprods = InsDetail::where('ins_ped',$id)->paginate(5);
        //return $unidades;
        return view('Instituciones.detail',[
            'unidades' => $unidades,
            'pedidos' => $pedidos,
            'productos' => $productos,
            'listprods' => $listprods
        ]);
    }
    public function storedeti(Request $request)
    {
        $dis = new InsDetail;
        $dis->ins_ped = $request->pedi;
        $dis->ins_uneg = $request->uneg;
        $dis->ins_cod = $request->cod;
        $dis->ins_desc = $request->des;
        $dis->ins_cant = $request->can;
        $dis->ins_state = 0;
        $dis->ins_state_ate = 0;
        $dis->ins_state_apro = 0;
        $dis->ins_fecha_ate = date('Y-m-d');
        $dis->ins_fecha_apro = date('Y-m-d');
        $dis->save();
        return InsDetail::orderBy("detins_id")->where('ins_ped',$request->pedi)->get();
    }

    public function indexadmins()
    {
        $unidades = Unegocio::where('uneg_state', 1)
                    ->orderBy('uneg_id', 'desc')
                    ->paginate(5);
        return view('Instituciones.admunit',[
            'unidades' => $unidades
        ]);
    }
    public function admpedins($id)
    {
        $unidades = Unegocio::findOrFail($id);
        $pedidos = Institution::where('ins_uneg', $id)
                    ->where('ins_state',0)
                    ->orderBy('ins_id', 'desc')
                    ->paginate(5);
        return view('Instituciones.admpedidos',[
            'unidades' => $unidades,
            'pedidos' => $pedidos
        ]);
    }
    public function admdetpedins($id)
    {
        $pedidos = Institution::findOrFail($id);
        $unidades = Unegocio::findOrFail($pedidos->ins_uneg);
        $productos = Product::all();
        $listprods = InsDetail::where('ins_ped',$id)->paginate(5);
        //return $unidades;
        return view('Instituciones.admdetail',[
            'unidades' => $unidades,
            'pedidos' => $pedidos,
            'productos' => $productos,
            'listprods' => $listprods
        ]);
    }
    public function atenderins(Request $request)
    {
        $dis = Institution::findOrFail($request->idped);
        $dis->ins_state_ate = 1;
        $dis->fecha_aten = date('Y-m-d');
        $dis->update();
        return Institution::orderBy("ins_id")->get();
    }
    public function updateins(Request $request, $prod_id,$pedido)
    {
        $dis = InsDetail::findOrFail($prod_id);
        $dis->ins_cant = $request->cantidad;
        $dis->ins_state_ate = $request->estado;
        $dis->save();
        return redirect('/AdminInsti/Detalle/'.$pedido)->with('status','Actualizado');
    }
    public function indexapro()
    {
        $unidades = Unegocio::where('uneg_state', 1)
                    ->orderBy('uneg_id', 'desc')
                    ->paginate(5);
        return view('Instituciones.comunit',[
            'unidades' => $unidades
        ]);
    }
    public function admlistapro($id)
    {
        $unidades = Unegocio::findOrFail($id);
        $pedidos = Institution::where('ins_uneg', $id)
                    ->where('ins_state',0)
                    ->orderBy('ins_id', 'desc')
                    ->paginate(5);
        return view('Instituciones.compedidos',[
            'unidades' => $unidades,
            'pedidos' => $pedidos
        ]);
    }
    public function admdetapro($id)
    {
        $pedidos = Institution::findOrFail($id);
        $unidades = Unegocio::findOrFail($pedidos->ins_uneg);
        $productos = Product::all();
        $listprods = InsDetail::where('ins_ped',$id)->paginate(5);
        //return $unidades;
        return view('Instituciones.comaprov',[
            'unidades' => $unidades,
            'pedidos' => $pedidos,
            'productos' => $productos,
            'listprods' => $listprods
        ]);
    }
    public function confapro(Request $request)
    {
        $dis = Institution::findOrFail($request->idped);
        $dis->ins_state_apro = 1;
        $dis->fecha_apro = date('Y-m-d');
        $dis->update();
        return Institution::orderBy("ins_id")->get();
    }
    public function confrech(Request $request)
    {
        $dis = Institution::findOrFail($request->idped);
        $dis->ins_state_apro = 2;
        $dis->fecha_apro = date('Y-m-d');
        $dis->update();
        return Institution::orderBy("ins_id")->get();
    }

    public function indexconf()
    {
        $usuarios = User::where('state',1)
                    ->paginate(5);
        return view('Unitxuser.index',[
            'usuarios' => $usuarios
        ]);
    }
    public function asiguneg($id)
    {
        $usuarios = User::findOrFail($id);
        $unidades = Unegocio::all();
        $asignations = UserUnit::orderBy('usu_id', 'desc')
                    ->paginate(5);
        return view('Unitxuser.asignation',[
            'unidades' => $unidades,
            'usuarios' => $usuarios,
            'asignations' => $asignations
        ]);
    }
    public function addunit(Request $request){
        
        $asig = new UserUnit;
        $asig->usu_iduser = $request->usuario;
        $asig->usu_iduneg = $request->cod;
        $asig->usu_name = $request->des;
        $asig->save();
        $proasignate = UserUnit::where('usu_id',$request->usuario)->paginate(5);
        return response()->json($proasignate);
    }
    public function elimuni($id)
    {
        $proces = UserUnit::findOrFail($id);
        $proces->delete();
        return response()->json(['message' => 'Registro eliminado correctamente.']);
    }

}
