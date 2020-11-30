<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Type;
use Validator;
use Illuminate\Support\Facades\File;
use App\Providers\RouteServiceProvider;

class ProductController extends Controller
{
    
    public function search( Request $req  ) {
        $params = $req->query();
        $data;
        if ( $req->has('query') ) {
            $data = Product::where('name', 'like' , '%' . $params['query'] . '%')->paginate(6);
        } else if ( $req->has('type') ) {
            $type = Type::where('name' , '=' ,$params['type'])->first();
            $data = !$type ? [] : Product::where('type_id' , '=' , $type->id)->paginate(6);
        } else {
            $data = Product::where('name', 'like' , '%')->paginate(6);
        }
        return view('search')->with(compact('data', $data));
    }
    public function getById ( $id ) {
        $data = Product::find($id);
        return view('productDetail')->with(compact('data', $data));
    }
    public function showCreateProduct() {
        $types = Type::all();
        return view('createProduct')->with('data', $types);
    }
    public function showEditProduct ($id)  {
        $product = Product::find($id);
        return view('editProduct')->with('data', $product);
    }
    public function edit( Request $req , $id ) {
        $rules = [
            'name' => 'required|min:5',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ];
        $messages = [
            'image.required'        => 'image wajib diisi',
            'name.required'         => 'name wajib diisi',
            'description.required'  => 'description wajib diiisi',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $product = Product::find($id);
        $product->name          = $req->name;
        $product->description   = $req->description;
        $product->stock         = $req->stock;
        $product->price         = $req->price;
        $product->save();

        return redirect()->back()
                    ->with('editedData', $product );  
    }
    public function create( Request $req ) {
        $rules = [
            'image' => 'required',
            'name' => 'required|min:5',
            'description' => 'required',
            'type' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ];
        $messages = [
            'image.required'        => 'image wajib diisi',
            'name.required'         => 'name wajib diisi',
            'description.required'  => 'description wajib diiisi',
            'type.required'         => 'type wajib diisi',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $typeIsFound = Type::find($req->type);
        if (!$typeIsFound) {
            return redirect()->back()
                ->withErrors('Stationary type doesn\'t Exist');
        }

        $product = new Product();
        $image = $req->file('image');
        $imageName = $image->getClientOriginalName();
        $uniqueName = generateUniqueFileName($imageName);
        $image->move('images', $uniqueName);

        $product->name          = $req->name;
        $product->image         = $uniqueName;
        $product->description   = $req->description;
        $product->type_id       = $typeIsFound->id;
        $product->stock         = $req->stock;
        $product->price         = $req->price;
        $product->save();

        return redirect()->back()
                    ->with('createdData', $product );  
    }
    public function delete ( $id ) {
        $product = Product::find($id);
        if ( !$product ) {
            return redirect()->back()
                ->withErrors('Product with id: ' . $id . ' not found!')
                ->withInput();
        } else {
            // deleteLocalImage($product->image);
            $product->delete();
            return redirect( RouteServiceProvider::PRODUCT . '/search' );
        }


    }
}
