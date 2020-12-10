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
        $typeNames = [
            ['eraser', 'notebook' , 'dictionary', 'pen'],
            ['smart pen', 'smart pencil'],
            ['eraser', 'notebook' , 'dictionary', 'pen'],
            ['eraser', 'dictionary', 'smart pencil'],
        ];
        for( $i = 0 ; $i < count($typeNames) ; $i++ ) {
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->save();

            
            $types = Type::whereIn('name' , $typeNames[$i] )->get();
            
            foreach ( $types as $type ) {
                $product = Product::where('type_id' , '=' , $type->id )->first();
                if ( $product ) {
                    $qty = rand(2, $product->stock-1);
                    $product->stock = $product->stock - $qty;
                    
                    $transactionDetail = new TransactionDetail();
                    $transactionDetail->name                = $product->name;
                    $transactionDetail->image               = $product->image;
                    $transactionDetail->description         = $product->description;
                    $transactionDetail->transaction_id      = $transaction->id;
                    $transactionDetail->price               = $product->price;
                    $transactionDetail->quantity            = $qty;
                    
                    $transactionDetail->product_id          = $product->id;
                    $transactionDetail->type_id             = $product->type->id;
                    $transactionDetail->type_name           = $product->type->name;

                    $transactionDetail->save();
                }
            }
        }
    }
}
