<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $ordenes = Order::all();
        return $ordenes;
    }

    public function generate(Request $request){
        $ordenes = Order::orderBy('ord_id', 'desc')->first();
        $arm = 1;

        $gen = new Order;
        $gen->ord_codp = $request->cod;
        $gen->ord_prod = $request->des;
        $gen->ord_lot = $arm.$request->mesi.$request->ges;
        $gen->ord_gest = $request->ges;
        $gen->ord_mes = $request->mesi;
        $gen->ord_state = 1;
        $gen->save();
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
}
