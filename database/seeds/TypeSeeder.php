<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeNames = [
            'pen',
            'pencil',
            'ruler',
            'notebook',
            'dictionary',
            'smart pen', 
            'smart pencil', 
            'smart reader', 
            'smart note', 
            'eraser'
        ];
        $images = ['notes.jpg','samsung_pen.jpg', 'dictionary.jpg', 'ruler.jpg'];
        $i = 0;
        foreach( $typeNames as $type ) {
            Type::create([
                'name' => $type,
                'image'=> $images[$i],
            ]);
            $i = $i > 2 ? 0 : $i+1;
        }
    }
}
