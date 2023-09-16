<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;   
use App\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $customers = User::orderBy('id','desc')
            ->where('rol_id',4)
            ->search($search)
            ->paginate(5);
            return view('Customer.list',[
            'customers' => $customers
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
        return view('Customer.new');
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
            'nit' => 'required',
            'email' => 'required'
        ]);
        $customer = new User;
        $customer->rol_id = 4;
        $customer->name = $request->name;
        $customer->paternal = $request->paternal;
        $customer->maternal = $request->maternal;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->ci = $request->ci;
        $customer->nit = $request->nit;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->route('customer.index')->with('status','Agregado');
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
        $customer = User::findOrFail($id);
        return view('Customer.update',[
            'customer' => $customer,
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
        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->paternal = $request->paternal;
        $customer->maternal = $request->maternal;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->route('customer.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $customer = User::findOrFail($id);
        $customer->state = 0;
        $customer->save();
        return redirect()->route('customer.index')->with('status','Desactivado');
    }
    public function activate($id)
    {
        $customer = User::findOrFail($id);
        $customer->state = 1;
        $customer->save();
        return redirect()->route('customer.index')->with('status','Activado');
    }
    public function delete($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('status','Eliminado');
    }
}
