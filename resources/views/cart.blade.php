@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
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
                        <a href="/cart/update/{{$cartItem->id}}" class="btn btn-primary">Edit Item</a>
                        <a href="/cart/delete/{{$cartItem->id}}" class="btn btn-danger">Delete Item</a>
                    </div>
                </div>
            @endforeach
            <a href="/cart/checkout" class="btn btn-danger">Checkout</a>
            
        @else
            <div>Do Some Transaction to see your products in cart</div>
        @endif
    </div>
@endsection
