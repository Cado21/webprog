@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/productDetail.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
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
                            <a href="/product/delete" class="btn btn-danger">delete</a>
                            <a href="/product/edit/{{$data->id}}" class="btn btn-primary">edit</a>
                        @endcan
                        @can('isMember')
                            add qty , add to cart with input field
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
