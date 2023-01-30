@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Produk
            </div>
            <div class="card-body">
                <form action="{{route('Category.update', $category->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="edit_category" class="form-label">Category</label>
                        <input type="text" class="form-control" name="edit_category" id="edit_category" value="{{ $category->name }}">
                    </div>
                    <input type="submit" value="Edit Category" class="btn btn-success">
                    <a href="{{ route('home.index') }}" class="btn btn-outline-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
