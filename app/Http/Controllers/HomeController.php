<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $daftar_produk = item::all();
        $category = category::all();
        return view('home', compact('daftar_produk', 'category'));
    }

}
