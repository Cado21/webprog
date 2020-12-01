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
        $maxTypeId = Type::all()->count();
        $type_id = 1;
        for( $i = 0 ; $i < 20 ; $i++ ){
            $type_id = $type_id > $maxTypeId ? 1 : $type_id;
            Product::create([
                'name' => Type::find( rand(1, Type::all()->count()) )->name . ' - ' . Str::random(rand( 5, 20 )) . ' ' . Str::random(rand( 5, 20 )),
                'stock' => rand(10,50),
                'price' => rand(20000,90000),
                'image' => 'notes.jpg',
                'description' => Str::random(rand( 5, 50 )) . ' ' . Str::random(rand( 5, 50 )) . ' '. Str::random(rand( 5, 50 )),
                'type_id' =>  $type_id++,
            ]);
        }
    }
}
