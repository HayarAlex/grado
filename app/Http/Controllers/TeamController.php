<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('team_id','desc')->paginate(5);
        return view('Teams.list',[
            'teams' => $teams
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
        $team = new Team;
        $team->description = $request->description;
        $team->save();
        return redirect()->route('team.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $team_id)
    {
        $team = Team::findOrFail($team_id);
        $team->description = $request->description;
        $team->save();
        return redirect()->route('team.index')->with('status','Actualizado');
    }

    public function deactivate($team_id)
    {
        $team = Team::findOrFail($team_id);
        $team->state = 0;
        $team->save();
        return redirect()->route('team.index')->with('status','Desactivado');
    }
    public function activate($team_id)
    {
        $team = Team::findOrFail($team_id);
        $team->state = 1;
        $team->save();
        return redirect()->route('team.index')->with('status','Activado');
    }
    public function destroy(Team $team)
    {
        //
    }
    public function delete($team_id)
    {
        $team = Team::findOrFail($team_id);
        $team->delete();
        return redirect()->route('team.index')->with('status','Eliminado');
    }
}
