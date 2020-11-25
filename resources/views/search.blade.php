@extends('layouts.app')
@section('content')
<link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css">
<div class="container search-container">
    @if ($data->count())
    
    @if (Auth::check())
        @if ( Auth::user()->role == 'admin' )
            <a href="#" class="btn-container btn-primary">Add New Stationary</a>
            <a href="#" class="btn-container btn-primary">Add New Stationary Type</a>
            <a href="#" class="btn-container btn-primary">Edit Stationary Type</a>
        @endif
    @else
    
    @endif
    
    <div class="result-wrap-container">
        @foreach ($data as $eachData)
            <a href={{'/product/detail/' . $eachData->id }}> 
                <div class="image-card">
                    <img src={{ asset('images/' . $eachData->image) }} alt={{ $eachData->name }}>
                    <div class="detail-container">
                        <div class="name">{{ $eachData->name }}</div>
                        <div class="desc">{{ $eachData->description }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{ $data->appends($_GET)->links() }}
    @else
        <div>ga ad</div>
    @endif
</div>
@endsection
