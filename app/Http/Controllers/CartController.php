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
                'quantity'          => 'required|min:1',
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
            return redirect(RouteServiceProvider::CART);
        }
    }
    public function checkout () {
        $user = Auth::user();
        $carts = Cart::where( 'user_id' , '=' , $user->id )->get();
        if ( count($carts) == 0 ) {
            return redirect()->back()
                ->withErrors('Your Cart is empty!');
        } else {
            foreach ( $carts as $cart ) {
                $transactionDetail = new TransactionDetail();
                $transactionDetail->product_id = $cart->product->id;
                $transactionDetail->price = $cart->product->price;
                $transactionDetail->quantity = $cart->quantity;
                $transactionDetail->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->transaction_detail_id = $transactionDetail->id;
                $transaction->save();
            }
            return redirect(RouteServiceProvider::TRANSACTION);
        }
    }
}
