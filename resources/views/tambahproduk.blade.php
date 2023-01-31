@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Produk
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('items.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category">Nama Category</label>
                        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id" required>
                            <option selected value="">Belum milih Category</option>
                            @foreach ($category as $i => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder=""
                            aria-describedby="helpId" min="1">
                    </div>
                    <div class="form-group">
                        <label for="">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder=""
                            aria-describedby="helpId" min="1">
                    </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-sm btn-primary" value="Tambah Produk">
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
