<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;   
use App\User;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coachs = User::orderBy('id','desc')
            ->where('rol_id',5)
            ->paginate(5);
            return view('Coach.list',[
            'coachs' => $coachs
        ]);
        //para el buscador de creo un scope dentro del modelo del controlador customer
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Coach.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'paternal' => 'required',
            'maternal' => 'required',
            'email' => 'required'
        ]);
        $coach = new User;
        $coach->rol_id = 5;
        $coach->name = $request->name;
        $coach->paternal = $request->paternal;
        $coach->maternal = $request->maternal;
        $coach->address = $request->address;
        $coach->email = $request->email;
        $coach->ci = $request->ci;
        $coach->password = bcrypt($request->ci);
        $coach->gender = $request->gender;
        $coach->phone = $request->phone;
        $coach->save();
        return redirect()->route('coach.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $coach = User::findOrFail($id);
        return view('Coach.update',[
            'coach' => $coach,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'paternal' => 'required',
            'maternal' => 'required',
            'email' => 'required'
        ]);
        $id = Crypt::decrypt($id);
        $coach = User::findOrFail($id);
        $coach->name = $request->name;
        $coach->paternal = $request->paternal;
        $coach->maternal = $request->maternal;
        $coach->address = $request->address;
        $coach->email = $request->email;
        $coach->gender = $request->gender;
        $coach->phone = $request->phone;
        $coach->save();
        return redirect()->route('coach.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $coach = User::findOrFail($id);
        $coach->state = 0;
        $coach->save();
        return redirect()->route('coach.index')->with('status','Desactivado');
    }
    public function activate($id)
    {
        $coach = User::findOrFail($id);
        $coach->state = 1;
        $coach->save();
        return redirect()->route('coach.index')->with('status','Activado');
    }
    public function delete($id)
    {
        $coach = User::findOrFail($id);
        $coach->delete();
        return redirect()->route('coach.index')->with('status','Eliminado');
    }
}

