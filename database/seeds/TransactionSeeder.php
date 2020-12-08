<?php

use Illuminate\Database\Seeder;
use App\Transaction;
use App\Member;
use App\Product;
use App\Type;
use App\User;
use App\TransactionDetail;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role' , '=' , 'member')->first(); 
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->save();

        $typeNames = ['eraser', 'notebook' , 'dictionary', 'pen'];
        $types = Type::whereIn('name' , $typeNames )->get();
        
        foreach ( $types as $type ) {
            $product = Product::where('type_id' , '=' , $type->id )->first();
            if ( $product ) {
                $qty = rand(2, $product->stock-1);
                $product->stock = $product->stock - $qty;
                
                $transactionDetail = new TransactionDetail();
                $transactionDetail->product_id = $product->id;
                $transactionDetail->transaction_id = $transaction->id;
                $transactionDetail->price = $product->price;
                $transactionDetail->quantity = $qty;
    
                $transactionDetail->save();
                $product->save();
            }
        }
    }
}
