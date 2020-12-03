@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css" >
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
        @if (Session::has('deletedData'))
            <div class="alert alert-success">
                <div>{{ Session::get('deletedData') }}</div>
            </div>
        @endif
        @if (count($data))
            @foreach ($data as $cartItem)
                <div class="cart-item-container">
                    <div class="name">{{$cartItem->product->name}}</div>
                    <ul>
                        <li>Stationary Price: {{number_format($cartItem->product->price,0,'.','.')}}</li>
                        <li>Quantity: {{$cartItem->quantity}}</li>
                    </ul>
                    <div class="separator"></div>
                    <?php 
                        $price = $cartItem->product->price * $cartItem->quantity;
                        $subTotal = number_format($price,0,'.','.');
                    ?>
                    <div>Total Rp{{$subTotal}}</div>
                    <div class="right-btn-container">
                        <a href="/cart/update/{{$cartItem->id}}" class="btn btn-primary mr-2">Edit Item</a>
                        <form action={{route('cart.delete', $cartItem->id)}} method="post">
                            @csrf
                            @method('delete')
                            <button href="/cart/delete/{{$cartItem->id}}" class="btn btn-danger">Delete Item</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <form action={{route('cart.checkout')}} method="post">
                @csrf
                <button class="btn btn-danger">Checkout</button>
            </form>
            
        @else
            <div>Do Some Transaction to see your products in cart</div>
        @endif
    </div>
@endsection
