<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; 
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('category_id','desc')->paginate(5);
        return view('Categories.list',[
            'categories' => $categories
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
            'description' => 'required'
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('category.index')->with('status','Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function deactivate($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->state = 0;
        $category->save();
        return redirect()->route('category.index')->with('status','Desactivado');
    }
    public function activate($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->state = 1;
        $category->save();
        return redirect()->route('category.index')->with('status','Activado');
    }
    public function update(Request $request, $category_id)
    {
        // return $request;

        $category = Category::findOrFail($category_id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('category.index')->with('status','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->delete();
        return redirect()->route('category.index')->with('status','Eliminado');
    }
}
