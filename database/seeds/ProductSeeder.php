<?php

use Illuminate\Database\Seeder;
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
        Product::create([
            'name' => 'book',
            'stock' => rand(10,50),
            'price' => rand(20000,90000),
            'image' => 'notes.jpg',
            'type_id' => rand( 1, Type::all()->count() ),
        ]);
    }
}
