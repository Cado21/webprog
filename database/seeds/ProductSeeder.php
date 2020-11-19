<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Product;
use App\Type;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for( $i = 0 ; $i < 20 ; $i++ ){
            Product::create([
                'name' => Type::find( rand(1, Type::all()->count()) )->name . ' - ' . Str::random(rand( 5, 20 )) . ' ' . Str::random(rand( 5, 20 )),
                'stock' => rand(10,50),
                'price' => rand(20000,90000),
                'image' => 'notes.jpg',
                'description' => Str::random(rand( 5, 50 )) . ' ' . Str::random(rand( 5, 50 )) . ' '. Str::random(rand( 5, 50 )),
                'type_id' => rand( 1, Type::all()->count() ),
            ]);
        }
    }
}
