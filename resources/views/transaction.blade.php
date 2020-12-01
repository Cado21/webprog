@extends('layouts.app')

@section('styles')
    {{-- <link href="{{ asset('css/transaction.css') }}" rel="stylesheet" type="text/css" > --}}
@endsection

@section('content')
    <div class="container">
        @if (count($data))
            @foreach ($data as $transaction)
                <div class="mb-5"> {{ $transaction->created_at }}</div>
                <div class="mb-5"> {{ $transaction->details }}</div>
            @endforeach
            
        @else
            You Got No History
        @endif
    </div>
@endsection
