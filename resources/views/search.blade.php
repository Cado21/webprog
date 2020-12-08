@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container search-container">
        @if (count($data))
        
            @if (Auth::check())
                @can('isAdmin')
                    @if (Session::has('deletedData'))
                        <div class="alert alert-success">
                            <div>"{{Session::get('deletedData')->name}}" Deleted Successfully!</div>
                        </div>
                    @endif
                    <a href="/product/add" class="btn-container btn btn-primary">Add New Stationary</a>
                    <a href="/type" class="btn-container btn btn-primary">Add New Stationary Type</a>
                    <a href="/type/edit" class="btn-container btn btn-primary">Edit Stationary Type</a>
                @endcan
            @else
            
            @endif
        
            <div class="result-wrap-container">
                @foreach ($data as $eachData)
                @if (Auth::check())
                    <a class="image-card card-hover" href={{'/product/detail/' . $eachData->id }}> 
                        <img src={{ asset('images/' . $eachData->image ) }} alt={{ $eachData->name }}>
                        <div class="detail-container">
                            <div class="name">{{ $eachData->name }}</div>
                            <div class="desc">{{ $eachData->description }}</div>
                        </div>
                    </a>
                @else 
                    <div class="image-card">
                        <img src={{ asset('images/' . $eachData->image ) }} alt={{ $eachData->name }}>
                        <div class="detail-container">
                            <div class="name">{{ $eachData->name }}</div>
                            <div class="desc">{{ $eachData->description }}</div>
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
            {{ $data->appends($_GET)->links() }}
        @else
            <div>Keyword that you looking for not found!</div>
        @endif
    </div>
@endsection
