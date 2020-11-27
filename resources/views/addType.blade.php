@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/createProduct.css') }}" rel="stylesheet" type="text/css" >
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
        @if (Session::has('editedData'))
            <div class="alert alert-success">
                <div>{{ Session::get('createdData') }}</div>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Stationary Type Name</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0?>
                @foreach ($data as $type)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td style="text-transform: capitalize">{{ $type->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="/type" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="input-wrapper">
                <div class="image-input-text">Browse Photos</div>
                <input type="file" name="image" accept="image/*">
            </div>
            <input type="text" name="name">
            <button type="submit" class="btn btn-primary">Add new Stationary Type </button>
        </form>
    </div>
@endsection

