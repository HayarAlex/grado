<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $productos = Product::orderBy('prod_id','asc')->get();
    	return view('Home.home',['productos' => $productos]);
    }
}
