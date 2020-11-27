<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Type;

class ProductController extends Controller
{
    
    public function search( Request $req  ) {
        $params = $req->query();
        $data;
        if ( $req->has('query') ) {
            $data = Product::where('name', 'like' , '%' . $params['query'] . '%')->paginate(6);
        } else if ( $req->has('type') ) {
            $type = Type::where('name' , '=' ,$params['type'])->first();
            $data = Product::where('type_id' , '=' , $type->id)->paginate(6);
        } else {
            $data = Product::where('name', 'like' , '%')->paginate(6);
        }
        return view('search')->with(compact('data', $data));
    }
    public function getById ( $id ) {
        $data = Product::find($id);
        return view('productDetail')->with(compact('data', $data));
    }
    public function showCreateProduct( ) {
        return view('createProduct');
    }
    public function create( Request $req ) {
        
    }
}
