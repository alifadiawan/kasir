<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\item;
use App\Models\transaction;
use App\Models\transactiondetail;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class TransactionController extends Controller
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
        $items = item::doesnthave('cart')->where('stock', '>' , 0)->get();
        $carts = item::has('cart')->get()->sortByDesc('cart.created_at'); 
        return view('Transaction' , compact('carts', 'items'));

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

    public function checkout(request $request)
    {
        transaction::create($request->all());
        foreach(cart::all() as $item){
            transactiondetail::create([
                'transaction_id'    => transaction::latest()->first()->id,
                'item_id'           => $item->item_id,
                'qty'               => $item->qty,
                'subtotal'          => $item->item->price * $item->qty
            ]);
        }

        cart::truncate();

        return redirect(route('Transaction.show',transaction::latest()->first()->id));
    }

    public function history()
    {
        $transaksi = transaction::all();
        return view ('historytransactions', compact('transaksi'));
    }

    public function transactiondetails()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        cart::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = transaction::findorfail($id);
        return view ('transactiondetails',compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = cart::findorfail($id);
        $item->update($request->all());

        return redirect()->back()->with('s  tatus', 'quantity has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = cart::findorfail($id);
        $items->delete();

        return redirect()->back();
    }

    public function hapus($id)
    {
        $items = cart::findorfail($id);
        $items->delete();

        return redirect()->back();
    }
}
