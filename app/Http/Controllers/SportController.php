<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::orderBy('sport_id','desc')->paginate(5);
        return view('Sports.list',[
            'sports' => $sports
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
        $sport = new Sport;
        $sport->description = $request->description;
        $sport->save();
        return redirect()->route('sport.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        $sport->description = $request->description;
        $sport->save();
        return redirect()->route('sport.index')->with('status','Actualizado');
    }

    public function deactivate($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        $sport->state = 0;
        $sport->save();
        return redirect()->route('sport.index')->with('status','Desactivado');
    }
    public function activate($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        $sport->state = 1;
        $sport->save();
        return redirect()->route('sport.index')->with('status','Activado');
    }
    public function destroy(Sport $sport)
    {
        //
    }
    public function delete($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
        $sport->delete();
        return redirect()->route('sport.index')->with('status','Eliminado');
    }
}
