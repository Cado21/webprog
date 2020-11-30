@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/productDetail.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
        {{-- {{ json_encode($data )}} --}}
        @foreach ($data as $cartItem)
            <div class="row mb-5">
                {{json_encode($cartItem->product)}}
                <br>
                <br>
                {{json_encode($cartItem->user)}} 
                <br>
                <br>
                {{json_encode($cartItem)}} 
            </div>
        @endforeach
    </div>
@endsection
