<?php

use Illuminate\Database\Seeder;
use App\Transaction;
use App\Member;
use App\Product;
use App\Type;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::where('role' , '=' , 'member')->get(1); 
        // $transaction = new Transaction();
        // $transaction->user_id = $user->id;
        // $transaction->save();

        // $typeNames = ['eraser', 'notebook' , 'dictionary', 'pen'];
        // $types = Type::whereIn('name' , $typeNames )->get(4);
        
        // foreach ( $types as $type ) {
        //     $product = Product::where('type_id' , '=' , $type->id )->first();
        //     if ( $product ) {
        //         $product->stock = $product->stock - rand
                
        //         $transactionDetail = new TransactionDetail();
        //         $transactionDetail->product_id = $cart->product->id;
        //         $transactionDetail->transaction_id = $transaction->id;
        //         $transactionDetail->price = $cart->product->price;
        //         $transactionDetail->quantity = $cart->quantity;
    
        //         $transactionDetail->save();
        //         $product->save();
        //     }
        // }
    }
}
