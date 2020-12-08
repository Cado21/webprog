@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
    @endif
    <div class="container">
        @if (Session::has('editedData'))
            <div class="alert alert-success">
                <div>"{{ Session::get('editedData')->name }}" Successfully Updated!</div>
            </div>  
        @endif
        <form action={{route('product.edit' , $data->id)}} method="POST">
            @csrf
            @method('put')
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Stationary Name" value="{{ $data->name }}">
            </div>
            <div class="input-group mb-3">
                <input type="text" name="description" class="form-control" placeholder="Stationary Description" value="{{ $data->description }}">
            </div>
            <div class="input-group mb-3">
                <input type="number" name="stock" class="form-control" placeholder="Stock" value="{{ $data->stock }}">
            </div>

            <div class="input-group mb-3">
                <input type="number" name="price" class="form-control" placeholder="Price" min="1" max="99999999" value="{{ $data->price }}">
            </div>
            <button class="btn btn-primary">Update Stationary Data</button>
        </form>
    </div>
@endsection
