@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Detail Transaction') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table>
                            <tr>
                                <td class="col-md-2">Tanggal {{ $transaksi->created_at }}</td>
                                <td class="col-md-2">Served by {{ $transaksi->user->name }}</td>
                            </tr>
                        </table>

                        <table class="table table-responsive table-striped">
                            <thead>
                                <th>No</th>
                                <th>Item name</th>
                                <th>qty</th>
                                <th>price</th>
                                <th>subtotal</th>
                            </thead>
                            @foreach ($transaksi->detail as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->item->name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->item->price}}</td>
                                    <td>{{$item->qty*$item->item->price}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-end" colspan="4">Grand total =</td>
                                <td>{{ $transaksi->total }}</td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="4">Pay total =</td>
                                <td>{{ $transaksi->pay_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="4">change =</td>
                                <td>{{ $transaksi->pay_total - $transaksi->total }}</td>
                            </tr>
                        </table>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
