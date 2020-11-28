@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/createProduct.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        @if (Session::has('createdData'))
            <div class="alert alert-success">
                <div>{{ Session::get('createdData') }}</div>
            </div>
        @endif
        <form action={{ route('product.add')}} method="post" enctype="multipart/form-data">
            @csrf
            <div class="img-preview-container" style="display:none;">
                <img alt="image-preview" id="img-preview" class="img-preview">
            </div>

            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="inp-container">
                <div class="img-preview-container" style="display:none;">
                    <img alt="img-preview">
                </div>
                <div class="label">Browse Photos: </div>
                <input type="file" name="image" accept="image/*" onchange="loadFile(e)">
            </div>
            
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Stationary Name">
            </div>

            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="text" name="description" class="form-control" placeholder="Stationary Description">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Type</label>
                </div>
                <select class="custom-select" name="type">
                    @foreach ($data as $type)
                        <option value={{$type->id}}>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>

            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="number" name="stock" class="form-control" placeholder="Stock">
            </div>

            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
                <input type="number" name="price" class="form-control" placeholder="Price" min="1" max="99999999">
            </div>

            <button type="submit" class="btn btn-primary">Add New Stationary</button>
        </form>
    </div>
@endsection


@section('footer-script')
    <script>
        const loadFile = function(e) {
            const reader = new FileReader();
            const imgContainer = document.getElementsByClassName('img-preview-container')[0];
            imgContainer.style.display = 'block';
            reader.onload = function() {
                var output = document.getElementById('img-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        };

    </script>
@endsection
