<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('promotion_id','desc')->paginate(5);
        return view('Promotions.list',[
            'promotions' => $promotions
        ]);
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
        // return $request;
        request()->validate([
            'description' => 'required'
        ]);
        $promotion = new Promotion;
        $promotion->description = $request->description;
        $promotion->save();
        return redirect()->route('promotion.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $promotion_id)
    {
        $promotion = Promotion::findOrFail($promotion_id);
        $promotion->description = $request->description;
        $promotion->save();
        return redirect()->route('promotion.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */

    public function deactivate($promotion_id)
    {
        $promotion = Promotion::findOrFail($promotion_id);
        $promotion->state = 0;
        $promotion->save();
        return redirect()->route('promotion.index')->with('status','Desactivado');
    }
    public function activate($promotion_id)
    {
        $promotion = Promotion::findOrFail($promotion_id);
        $promotion->state = 1;
        $promotion->save();
        return redirect()->route('promotion.index')->with('status','Activado');
    }
    public function destroy(Promotion $promotion)
    {
        //
    }
    public function delete($promotion_id)
    {
        $promotion = Promotion::findOrFail($promotion_id);
        $promotion->delete();
        return redirect()->route('promotion.index')->with('status','Eliminado');
    }
}
