<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;   
use App\User;

class ResponsibleController extends Controller
{
    public function index()
    {
        $responsibles = User::orderBy('id','desc')
            ->where('rol_id',3)
            ->paginate(5);
            return view('Responsibles.list',[
            'responsibles' => $responsibles
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Responsibles.new');
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
        $responsible = new User;
        $responsible->rol_id = 3;
        $responsible->name = $request->name;
        $responsible->paternal = $request->paternal;
        $responsible->maternal = $request->maternal;
        $responsible->address = $request->address;
        $responsible->email = $request->email;
        $responsible->ci = $request->ci;
        $responsible->password = bcrypt($request->ci);
        $responsible->gender = $request->gender;
        $responsible->phone = $request->phone;
        $responsible->save();
        return redirect()->route('responsible.index')->with('status','Agregado');
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
        $responsible = User::findOrFail($id);
        return view('Responsibles.update',[
            'responsible' => $responsible,
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
        $responsible = User::findOrFail($id);
        $responsible->name = $request->name;
        $responsible->paternal = $request->paternal;
        $responsible->maternal = $request->maternal;
        $responsible->address = $request->address;
        $responsible->email = $request->email;
        $responsible->phone = $request->phone;
        $responsible->save();
        return redirect()->route('responsible.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $responsible = User::findOrFail($id);
        $responsible->state = 0;
        $responsible->save();
        return redirect()->route('responsible.index')->with('status','Desactivado');
    }
    public function activate($id)
    {
        $responsible = User::findOrFail($id);
        $responsible->state = 1;
        $responsible->save();
        return redirect()->route('responsible.index')->with('status','Activado');
    }
    public function delete($id)
    {
        $responsible = User::findOrFail($id);
        $responsible->delete();
        return redirect()->route('responsible.index')->with('status','Eliminado');
    }
}
