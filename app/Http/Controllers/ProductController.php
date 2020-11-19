<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function search( Request $req  ) {
        $params = $req->query();
        if ( array_key_exists('query', $params) )  {
            $searchValue = $params['query'];
            $data = Product::where('name' , 'like', '%'.$searchValue.'%')->paginate(6);
            return view('search')->with(compact('data', $data));
        } 
        return dd('query not found');
    }
}
