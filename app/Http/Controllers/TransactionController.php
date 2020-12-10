<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionDetail;
use App\User;
use App\Cart;
use Auth;
use Validator;
use App\Providers\RouteServiceProvider;

class TransactionController extends Controller
{
    public function getAll() {
        $user = Auth::user();
        $transactions = Transaction::where('user_id' , '=', $user->id )->get();
        foreach( $transactions as $transaction ) {
            $total = 0;
            foreach( $transaction->details as $detail ) {
                $subTotal = ($detail->price * $detail->quantity);
                $total += $subTotal;
                $detail['subtotal'] = $subTotal;
            }
            $transaction['total'] = $total;
        }
        return view('transaction')->with('data' , $transactions );
    }
}
