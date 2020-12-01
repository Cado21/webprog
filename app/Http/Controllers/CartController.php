<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Transaction;
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
            ['checkout' ,'=', false],
        ])->get();
        return view('cart')->with('data' , $carts );
    }
    public function create( Request $req ){
        $rules = [
            'quantity' => 'required|min:1',
            'product_id'=> 'required',
        ];
        $messages = [
            'quantity.min'        => 'quantity minimal 1',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($req->product_id);
        if (!$product){
            return redirect()->back()
                ->withErrors('Product with id ' . $product->id . 'not found!');
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
                ->withErrors('Cart with id ' . $cart->id . 'not found!');
        } else {
            $cart->delete();
            return redirect()->back();
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
        dd($cart);
        if (!$cart) {
            return redirect()->back()
                ->withErrors('Cart with id ' . $cart->id . 'not found!');
        } else {
            $rules = [
                'quantity'          => 'required|min:1',
                'product_id'        => 'required',
            ];
            $messages = [
                'quantity.min'        => 'quantity minimal 1',
            ];
            
            $validator = Validator::make($req->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $cart->quantity = $req->quantity;
            $cart->save();
            dd ($cart);
            return redirect(RouteServiceProvider::CART);
        }
    }
    public function checkoutAll () {
        $user = Auth::user();
        $carts = Cart::where( 'user_id' , '=' , $user->id );
        if ( count($carts) == 0 ) {
            return redirect()->back()
                ->withErrors('Your Cart is empty!');
        } else {
            foreach ( $carts as $cartItem ) {
                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->cart_id = $cart->cart_id;
                $transaction->price = $cart->price;
                $transaction->save();
            }
            $carts->update(['checkout' => true]);
            return redirect(RouteServiceProvider::TRANSACTION);
        }
    }
}
