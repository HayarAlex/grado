<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;   
use App\User;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::orderBy('id','desc')
        ->where('rol_id',2)->paginate(5);
        return view('Users.list',[
            'users' => $users
        ]);
    }
    public function create()
    {
        return view('users.new');
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
            'address' => 'required',
            'email' => 'required',
            'ci' => 'required'
        ]);
        $user = new User;
        $user->rol_id = 2;
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->gender = $request->gender;
        $user->password = bcrypt($request->ci);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('user.index')->with('status','Agregado');
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
        $user = User::findOrFail($id);
        return view('Users.update',[
            'user' => $user,
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
            'email' => 'required',
            'ci' => 'required'
        ]);
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->paternal = $request->paternal;
        $user->maternal = $request->maternal;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->password = bcrypt($request->ci);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('user.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->state = 0;
        $user->save();
        return redirect()->route('user.index')->with('status','Desactivado');
    }
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->state = 1;
        $user->save();
        return redirect()->route('user.index')->with('status','Activado');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('status','Eliminado');
    }
}
