<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Transaction;
use App\TransactionDetail;
use Auth;
use Validator;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\ProductController;
class CartController extends Controller
{
    public function getAll( ) {
        $user = Auth::user();
        $carts = Cart::where([
            ['user_id' ,'=', $user->id],
        ])->get();
        return view('cart')->with('data' , $carts );
    }
    public function create( Request $req ){
        $product = Product::find($req->product_id);
        if (!$product){
            return redirect()->back()
                ->withErrors('Product with id ' . $product->id . 'not found!');
        }
        $rules = [
            'quantity' => 'required|integer|min:1' . '|max:' . $product->stock,
            'product_id'=> 'required',
        ];
        $messages = [
            //'quantity.min'        => 'quantity min 1',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $sameCart = Cart::where('product_id' , '=' , $product->id)->first();
        if ( !$sameCart ) {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->quantity = $req->quantity;
            $cart->user_id = Auth::id();
            $cart->save();
        } else {
            $sameCart->quantity += $req->quantity;
            $sameCart->save();
        }
        return redirect(RouteServiceProvider::CART);
    }
    public function delete ( $cartId ) {
        $cart = Cart::find($cartId);
        if (!$cart) {
            return redirect()->back()
                ->withErrors('Cart with id ' . $cartId . ' not found!');
        } else {
            $cart->delete();
            return redirect()->back()->with('deletedData', $cart);
        }
    }
    public function showEditCart($cartId) {
        $cart = Cart::find($cartId);
        if (!$cart) {
            return view('productCartUpdate')
                ->withErrors('Cart with id ' . $cart->id . 'not found!');
        } else {
            return view('productCartUpdate')->with('data', $cart);
        }
    }
    public function edit( Request $req , $cartId ) {
        $cart = Cart::find($cartId);
        if (!$cart) {
            return redirect()->back()
                ->withErrors('Cart with id ' . $cart->id . 'not found!');
        } else {
            $rules = [
                'quantity' => 'required|integer|min:1' . '|max:' . $cart->product->stock,
            ];
            $messages = [
                //'quantity.min'        => 'quantity minimal 1',
                'quantity.max'        => 'maximum quantity '.$cart->product->stock,
            ];
            $validator = Validator::make($req->all(), $rules, $messages);
            if ($validator->fails()) { 
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $cart->quantity = $req->quantity;
            $cart->save();
            return redirect(RouteServiceProvider::CART);
        }
    }
    public function checkout () {
        $user = Auth::user();
        $carts = Cart::where( 'user_id' , '=' , $user->id );
        if ( count($carts->get()) == 0 ) {
            return redirect()->back()
                ->withErrors('Your Cart is empty!');
        } else {
            foreach ( $carts->get() as $cart ) {
                $product = Product::find($cart->product->id);
                if (  $cart->quantity > $product->stock ){
                    return redirect()->back()
                        ->withErrors(
                            'Please update your cart quantity with product name: ' . 
                            $product->name . 
                            ',because its reach our product stock limit!'
                        );
                }
            }
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->save();

            foreach ( $carts->get() as $cart ) {
                $product = Product::find($cart->product->id);
                $product->stock -= $cart->quantity;
        
                $transactionDetail = new TransactionDetail();
                $transactionDetail->name                = $cart->product->name;
                $transactionDetail->image               = $cart->product->image;
                $transactionDetail->description         = $cart->product->description;
                $transactionDetail->transaction_id      = $transaction->id;
                $transactionDetail->price               = $cart->product->price;
                $transactionDetail->quantity            = $cart->quantity;
                
                $transactionDetail->product_id          = $cart->product->id;
                $transactionDetail->type_id             = $cart->product->type->id;
                $transactionDetail->type_name           = $cart->product->type->name;

                $product->save();
                $transactionDetail->save();
            }
            $carts->delete();
            return redirect(RouteServiceProvider::TRANSACTION);
        }
    }
}
