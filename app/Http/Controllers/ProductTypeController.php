<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; 

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypes = ProductType::orderBy('product_type_id','desc')->paginate(5);
        return view('ProductTypes.list',[
            'productTypes' => $productTypes
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
        $productType = new ProductType;
        $productType->description = $request->description;
        $productType->save();
        return redirect()->route('productType.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        //
    }

    public function deactivate($product_type_id)
    {
        $productType = ProductType::findOrFail($product_type_id);
        $productType->state = 0;
        $productType->save();
        return redirect()->route('productType.index')->with('status','Desactivado');
    }
    public function activate($product_type_id)
    {
        $productType = ProductType::findOrFail($product_type_id);
        $productType->state = 1;
        $productType->save();
        return redirect()->route('productType.index')->with('status','Activado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_type_id)
    {
        $productType = ProductType::findOrFail($product_type_id);
        $productType->description = $request->description;
        $productType->save();
        return redirect()->route('productType.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function delete($product_type_id)
    {
        $productType = ProductType::findOrFail($product_type_id);
        $productType->delete();
        return redirect()->route('productType.index')->with('status','Eliminado');
    }
}
