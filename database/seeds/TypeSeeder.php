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
        $types = [
            [
                'name' => 'pen',
                'image' => 'pen.jpg'
            ],
            [
                'name' => 'pencil',
                'image' => 'staedtler_2b.jpeg'
            ],
            [
                'name' => 'ruler',
                'image' => 'penggaris.png'
            ],
            [
                'name' => 'notebook',
                'image' => 'notebook_hitam.jpg'
            ],
            [
                'name' => 'dictionary',
                'image' => 'kbbi.jpg'
            ],
            [
                'name' => 'smart pen', 
                'image' => 'smart_pen.jpg'
            ],
            [
                'name' => 'smart pencil', 
                'image' => 'apple_pencil.jpg'
            ],
            [
                'name' => 'smart reader', 
                'image' => 'smart_reader.jpg'
            ],
            [
                'name' => 'smart note', 
                'image' => 'smart_note.jpg'
            ],
            [
                'name' => 'eraser',
                'image' => 'peclian.jpg'
            ],
        ];
        foreach( $types as $type ) {
            Type::create([
                'name' => $type['name'],
                'image'=> $type['image'],
            ]);
        }
    }
}


