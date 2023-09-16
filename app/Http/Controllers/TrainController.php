<?php

namespace App\Http\Controllers;

use App\Train;
use App\Sport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trains = Train::orderBy('train_id','desc')->paginate(5);
        return view('Trains.list',[
            'trains' => $trains
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function show(Train $train)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function edit(Train $train)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Train $train)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function destroy(Train $train)
    {
        //
    }
}
