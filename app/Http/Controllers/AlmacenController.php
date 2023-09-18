<?php

namespace App\Http\Controllers;

use App\Almacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenes = Almacen::orderBy('alm_id','desc')->paginate(5);
        return view('Almacenes.list',[
            'almacenes' => $almacenes
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
            'uneg' => 'required',
            'description' => 'required'
        ]);
        $alm = new Almacen;
        $alm->alm_uneg = $request->uneg;
        $alm->alm_nombre = $request->description;
        $alm->alm_state = 1;
        $alm->save();
        return redirect()->route('almacen.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */

    public function deactivate($id)
    {
        $alm = Almacen::findOrFail($id);
        $alm->alm_state = 0;
        $alm->save();
        return redirect()->route('almacen.index')->with('status','Desactivado');
    }
    public function activate($id)
    {
        $alm = Almacen::findOrFail($id);
        $alm->alm_state = 1;
        $alm->save();
        return redirect()->route('almacen.index')->with('status','Activado');
    }

    public function delete($id)
    {
        $alm = Almacen::findOrFail($id);
        $alm->delete();
        return redirect()->route('almacen.index')->with('status','Eliminado');
    }

    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $almacen)
    {
        $alm = Almacen::findOrFail($almacen);
        $alm->alm_nombre = $request->description;
        $alm->save();
        return redirect()->route('almacen.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        //
    }
}
