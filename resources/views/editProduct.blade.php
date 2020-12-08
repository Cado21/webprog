@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('editedData'))
            <div class="alert alert-success">
                <div>"{{ Session::get('editedData')->name }}" Successfully Updated!</div>
            </div>  
        @endif
        <form action={{route('product.edit' , $data->id)}} method="POST">
            @csrf
            @method('put')

            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Stationary Name" value="{{ old ('name') ?? $data->name }}">
            </div>

            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="text" name="description" class="form-control" placeholder="Stationary Description" value="{{ old('description') ?? $data->description }}">
            </div>

            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="number" name="stock" class="form-control" placeholder="Stock" value="{{ old('stock') ?? $data->stock }}">
            </div>

            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="number" name="price" class="form-control" placeholder="Price" value="{{ old('price') ?? $data->price }}">
            </div>
            <button class="btn btn-primary">Update Stationary Data</button>
        </form>
    </div>
@endsection
