@extends('layouts.app')
@section('content')
<link href="{{ asset('css/search.css') }}" rel="stylesheet" type="text/css" >
<div class="container product-detail-container">
    <img src={{ asset('images/' . $data->image) }} />
    {{ json_encode($data)}}
</div>
@endsection
