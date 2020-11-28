@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container search-container">
        @if ($data->count())
        
        @if (Auth::check())
            @can('isAdmin')
                <a href="/product/add" class="btn-container btn btn-primary">Add New Stationary</a>
                <a href="/type" class="btn-container btn btn-primary">Add New Stationary Type</a>
                <a href="/type/edit" class="btn-container btn btn-primary">Edit Stationary Type</a>
            @endcan
        @else
        
        @endif
        
        <div class="result-wrap-container">
            @foreach ($data as $eachData)
                <a href={{'/product/detail/' . $eachData->id }}> 
                    <div class="image-card">
                        <img src={{ asset('images/' . $eachData->image ) }} alt={{ $eachData->name }}>
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
            <div>Keyword that you looking for not found!</div>
        @endif
    </div>
@endsection
