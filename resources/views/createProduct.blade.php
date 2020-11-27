@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/createProduct.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
        <form action="" method="post">
            <div class="img-preview-container" style="display:none;">
                <img alt="image-preview" id="img-preview">
            </div>
            <div class="inp-container">
                <div class="label">Browse Photos: </div>
                <input type="file" name="image" accept="image/*" onchange="loadFile(event)">
            </div>
            <input type="text" name="name" class="form-control">
            <input type="text" name="description" class="form-control">
            <select name="type" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <input type="number" name="stock" class="form-control">
            <input type="number" name="price" class="form-control">
            <button type="submit" class="btn btn-primary">Add New Stationary</button>
        </form>
    </div>
@endsection


@section('footer-script')
<script>
    const loadFile = function(event) {
        const reader = new FileReader();
        const imgContainer = document.getElementsByClassName('img-preview-container')[0];
        imgContainer.style.display = 'block';
        reader.onload = function() {
            var output = document.getElementById('img-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script> 
@endsection


