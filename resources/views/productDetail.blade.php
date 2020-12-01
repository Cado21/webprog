@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
        @endif
        @if (Session::has('editedData'))
            <div class="alert alert-success">
                <div>{{ Session::get('deletedData') }}</div>
            </div>  
        @endif
        <div class="item-container">
            <div class="left">
                <img src={{ asset('images/' . $data->image) }} class="product-img"/>
            </div>
            <div class="right">
                <div class="text">Name: {{ $data->name }}</div>
                <div class="text">Stock: {{ $data->stock }}</div>
                <div class="text">Price: {{ $data->price }}</div>
                <div class="text">Description: {{ $data->description }}</div>
                <div class="text">Type: {{ $data->type->name }}</div>
                <div class="text" style="display:flex; flex-direction:row; justify-content:flex-end;">
                    @if (Auth::check())
                        @can('isAdmin')
                            <form action="{{ route('product.delete', $data->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">delete</button>
                            </form>
                            <a href="/product/edit/{{$data->id}}" class="btn btn-primary">edit</a>
                        @endcan
                        @can('isMember')
                        <form action="/cart/add" method="post">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1">
                            <input type="hidden" name="product_id" value={{$data->id}}>
                            <button class="btn btn-primary">Add to Cart</button>
                        </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
