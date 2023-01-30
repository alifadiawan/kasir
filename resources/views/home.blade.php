@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- produk --}}
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Daftar Produk</h5>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('items.create') }}" class="btn btn-sm btn-success">Tambah Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{ $message }} Berhasil Ditambahkan</h4>
                            </div>
                        @endif
                        @if ($message = Session::get('edit'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{$message}} Berhasil di update</h4>
                            </div>
                        @endif
                        @if ($message = Session::get('hapus'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{$message}} Berhasil di Hapus</h4>
                            </div>
                        @endif
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar_produk as $item)
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{number_format($item->price) }}</td>
                                        <td>{{$item->stock}}</td>
                                        <td>
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="btn btn-outline-warning" data-bs-toggle='tooltip'
                                                data-placement='top' title='Edit Produk'>
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <a href="{{ route('items.hapus', $item->id) }}" class="btn btn-outline-danger"
                                                data-bs-toggle='tooltip' data-placement='top' title='Hapus Produk'>
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- category --}}
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        @if ($message = Session::get('c_success'))
                            <div class="alert alert-success" role="alert">
                                <h4>{{ $message }}</h4>
                            </div>
                        @endif
                        @if ($message = Session::get('c_warning'))
                            <div class="alert alert-warning" role="alert">
                                <h4>{{$message}}</h4>
                            </div>
                        @endif
                        @if ($message = Session::get('c_danger'))
                            <div class="alert alert-danger" role="alert">
                                <h4>{{$message}}</h4>
                            </di>
                        @endif
                        <div class="row">
                            <div class="col">
                                <h5>Category</h5>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('Category.create') }}" class="btn btn-sm btn-success">Tambah Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordeless table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <a href="{{ route('Category.edit', $item->id) }}"
                                                class="btn btn-outline-warning" data-bs-toggle='tooltip'
                                                data-placement='top' title='Edit Produk'>
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <a href="{{ route('Category.hapus', $item->id) }}" class="btn btn-outline-danger"
                                                data-bs-toggle='tooltip' data-placement='top' title='Hapus Produk'>
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection
