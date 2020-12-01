@extends('layouts.app')

@section('styles')
    {{-- <link href="{{ asset('css/transaction.css') }}" rel="stylesheet" type="text/css" > --}}
@endsection

@section('content')
    <div class="container">
        {{ dd($data)}}
        @foreach ($data as $transaction)
            <div class="mb-5"> {{ $data }}</div>
        @endforeach
    </div>
@endsection
