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
        foreach( $typeNames as $type ) {
            Type::create([
                'name' => $type,
            ]);
        }
    }
}
