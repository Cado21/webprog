@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/createProduct.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Number</th>
                <th scope="col">Stationary Type Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif
                @if (Session::has('deletedData'))
                    <div class="alert alert-success">
                        <div>{{ Session::get('deletedData') }}</div>
                    </div>
                @endif
                @if (Session::has('editedData'))
                    <div class="alert alert-success">
                        <div>{{ Session::get('editedData') }}</div>
                    </div>
                @endif

                <?php $i = 0?>
                @foreach ($data as $type)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $type->name }}</td>
                        <td>
                            <form action={{ route('type.edit_name' , $type->id )}} method="POST">
                                @csrf
                                @method("put")
                                <input type="text" name="name">
                                <button class="btn btn-primary" method="submit">Edit</button>
                            </form>

                            <form action={{ route('type.delete' , $type->id )}} method="POST">
                                @csrf
                                @method("delete")
                                <button class="btn btn-primary" method="">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection

