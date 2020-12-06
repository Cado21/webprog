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
        return $data;
    }
    public function showProductDetail ($id) {
        $data = $this->getById($id);
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
            'description' => 'required|min:10',
            'stock' => 'required',
            'price' => 'required',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:5001'
        ];
        $messages = [
            'name.required'         => 'Please Fill The Name',
            'description.required'  => 'Please Fill The Description',
            'stock.required'        =>'Please Fill Stock',
            'price.required'        =>'Please Fill Price',
            'name.min'              => 'name lengeth minimum 5 characters',
            'description.min'       => 'description minimum 10 characters',
            'stock.min'             => 'must be more than 0',
            'price.min'             => 'must be more than 5000'
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
            'name' => 'required|min:5|unique:products,name',
            'description' => 'required|min:10',
            'type' => 'required',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:5001'
        ];
        $messages = [
            'image.required'        => 'Please Insert The Image',
            'name.required'         => 'Please Fill The Name',
            'name.unique'         => 'Please Insert diffrent name',
            'description.required'  => 'Please Fill The Description',
            'type.required'         => 'Please Fill The Type',
            'stock.required'        =>'Please Fill Stock',
            'price.required'        =>'Please Fill Price',
            'name.min'              => 'name lengeth minimum 5 characters',
            'description.min'       => 'description minimum 10 characters',
            'stock.min'             => 'must be more than 0',
            'price.min'             => 'must be more than 5000'
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
        // $image = $req->file('image');
        // $imageName = $image->getClientOriginalName();
        // $uniqueName = generateUniqueFileName($imageName);
        // $imagePath = '\images';
        // dd($image);
        // $image->move($imagePath, $uniqueName);
        $image = $req->image;
        if($image){
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);
        }

        $product->name          = $req->name;
        $product->image         = $imageName;
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
