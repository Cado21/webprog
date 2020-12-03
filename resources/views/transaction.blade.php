@extends('layouts.app')

@section('styles')
    {{-- <link href="{{ asset('css/transaction.css') }}" rel="stylesheet" type="text/css" > --}}
@endsection

@section('content')
    <div class="container">
        @if (count($data))
            
            @foreach ($data as $transaction)
            <div class="transaction-container">
                <div class="date"> {{ $transaction->created_at }}</div>
                <div class="transaction-detail-container"> 
                    @foreach ($transaction->details as $detail)
                        <div class="m-2">{{$detail}}</div>
                    @endforeach
                </div>
            </div>
            @endforeach
            
        @else
            You Got No History
        @endif
    </div>
@endsection
