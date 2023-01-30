@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Transactions History
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Total Transactions</th>
                            <th>Served by</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->total}}</td>
                            <td>{{$item->user->name}}</td>
                            <th>
                                <a href="{{route('Transaction.show', $item->id)}}" class="btn btn-success">Struk</a>
                            </th>
                        </tr>      
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
