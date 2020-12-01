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
        $loggedUser = Auth::user();
        $user = User::find($loggedUser->id);
        dd ( $user->transactions );
        return view('transaction')->with('data' , $transactions );
    }
}
