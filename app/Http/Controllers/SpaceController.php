<?php

namespace App\Http\Controllers;

use App\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spaces = Space::orderBy('space_id','desc')->paginate(5);
        return view('Spaces.list',[
            'spaces' => $spaces
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
            'name' => 'required',
            'price' => 'required',
        ]);
        $space = new Space;
        $space->name = $request->name;
        $space->price = $request->price;
        $space->description = $request->description;
        $space->save();
        return redirect()->route('space.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function show(Space $space)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $space_id)
    {
        $space = Space::findOrFail($space_id);
        $space->name = $request->name;
        $space->price = $request->price;
        $space->description = $request->description;
        $space->save();
        return redirect()->route('space.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Space  $space
     * @return \Illuminate\Http\Response
     */
     public function deactivate($space_id)
    {
        $space = Space::findOrFail($space_id);
        $space->state = 0;
        $space->save();
        return redirect()->route('space.index')->with('status','Desactivado');
    }
    public function activate($space_id)
    {
        $space = Space::findOrFail($space_id);
        $space->state = 1;
        $space->save();
        return redirect()->route('space.index')->with('status','Activado');
    }
    public function destroy(Space $space)
    {
        //
    }
    public function delete($space_id)
    {
        $space = Space::findOrFail($space_id);
        $space->delete();
        return redirect()->route('space.index')->with('status','Eliminado');
    }
}
