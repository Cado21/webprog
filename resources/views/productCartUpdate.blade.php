
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
        <div class="item-container">
            <div class="left">
                <img src={{ asset('images/' . $data->product->image) }} class="product-img"/>
            </div>
            <div class="right">
                <div class="text">Name: {{ $data->product->name }}</div>
                <div class="text">Stock: {{ $data->product->stock }}</div>
                <div class="text">Price: {{ $data->product->price }}</div>
                <div class="text">Description: {{ $data->product->description }}</div>
                <div class="text">Type: {{ $data->product->type->name }}</div>
                <div class="text" style="display:flex; flex-direction:row; justify-content:flex-end;">
                    @if (Auth::check())
                        @can('isMember')
                        <form action={{ route('cart.edit_quantity' , $data->id )}} method="post">
                            @csrf
                            @method('put')
                            <input type="number" name="quantity" value="{{$data->quantity}}" >
                            <button class="btn btn-dark">Update Cart</button>
                        </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
