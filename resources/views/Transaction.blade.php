@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            div.
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Daftar Produk</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th class="col-md-4">Name</th>
                                    <th>Price</th>
                                    <th class="col-md-2">Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->price) }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>
                                            <form action="{{ route('Transaction.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                <input type="hidden" name="qty" value="1">
                                                <button class="btn btn-warning">Add</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- cart belanjaaan --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Keranjang</div>
                    <div class="card-body">
                        <table class="table table-borderless text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th class="col-md-2">Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($carts->isEmpty())
                                    <tr>
                                        <td class="text-center" colspan="5">Keranjang Kosong</td>
                                    </tr>
                                @else
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->name }}</td>
                                            <td>{{ number_format($cart->price) }}</td>
                                            <th>
                                                <input type="number" max="{{ $cart->stock - $cart->qty }}" min="1"
                                                    onchange="ubah({{ $loop->iteration }})" value="1"
                                                    class="form-control">
                                            </th>
                                            <th>
                                                <form action="{{ route('Transaction.update', $cart->cart->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="submit" id="update{{ $loop->iteration }}" class="btn btn-primary"
                                                        style="display: none" value="Update">
                                                </form>
                                                <form action="{{ route('Transaction.destroy', $cart->cart->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" id="hapus{{ $loop->iteration }}" class="btn btn-outline-danger"
                                                        style="display:" value="delete">
                                                </form>
                                            </th>
                                        </tr>

                                        <script>
                                            function ubah{{ $loop->iteration }}() {
                                                document.getElementById("update{{ $loop->iteration }}").style.display = "inline";
                                                document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";
                                            }
                                        </script>
                                    @endforeach
                                @endif
                            </tbody>
                            <form action="{{ route('transaksi.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth()->user()->id }}" name="user_id" id="user_id">
                                <tbody>
                                    <td colspan="2">total</td>
                                    <td colspan="3">
                                        <input type="text" class="form-control" name="total" readonly
                                            value="{{ $carts->sum(function ($item) {return $item->price * $item->cart->qty;}) }}">
                                    </td>
                                </tbody>
                                <tbody>
                                    <td colspan="2">Payment</td>
                                    <td colspan="3">
                                        <input type="text" class="form-control"
                                            min="="{{ $carts->sum(function ($item) {return $item->price * $item->cart->qty;}) }}"
                                            name="pay_total" required>
                                    </td>
                                </tbody>
                        </table>
                        <div class="card-footer">
                            <input type="submit" value="submit" class="btn btn-success" name="" id="">
                            <a href="" class="btn btn-outline-danger">Cancel</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
