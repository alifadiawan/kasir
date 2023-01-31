<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\category;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $items = item::all();
        return view('masteritem' , compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        return view('tambahproduk',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute gabole kosong',
            'dropdown' => 'dropdown diisi'
        ];
        $this->validate($request,[
            'category_id' => 'required',
            'nama_produk' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ], $message);

        item::create([
            'category_id'=>$request->category_id,
            'name'=>$request->nama_produk,
            'stock'=>$request->stock,
            'price'=>$request->price
        ]);

        Session::flash('success', $request->nama_produk , "Sebanyak" , $request->stok);
        return redirect(route('home.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = item::find($id);
        $category = category::all();
        return view('edititem', compact('produk','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute diisi gaess',
        ];
        $validateData = $request->validate([
            'edit_produk' => 'required',
            'edit_price' => 'required',
            'edit_stock' => 'required',
        ], $message);

        $produk = item::find($id);
        $produk->category_id = $request->category;
        $produk->name = $request->edit_produk;
        $produk->price = $request->edit_price;
        $produk->stock = $request->edit_stock;

        $produk->save();
        Session::flash('edit', $produk->name);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        $item = item::find($item);
        $item->delete();
        return Redirect('home');
    }

    public function hapus($id)
    {
        $item = item::find($id);
        $item->delete();
        Session::flash('hapus', $item->name);
        return Redirect('home');
    }
}
 