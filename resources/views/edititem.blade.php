@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Produk
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
                <form action="{{ route('items.update', $produk->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="category">Nama Category</label>
                        <select class="form-select" aria-label="Default select example" id="category" name="category"
                            required>
                            <option selected value="">Belum milih Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Edit Produk</label>
                        <input type="text" name="edit_produk" id="edit_produk" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $produk->name }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Edit Price</label>
                        <input type="number" name="edit_price" id="edit_price" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $produk->price }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Edit Stock</label>
                        <input type="text" name="edit_stock" id="edit_stock" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $produk->stock }}">
                    </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-sm btn-primary" value="Edit Produk">
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
