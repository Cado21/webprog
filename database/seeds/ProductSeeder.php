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
        Product::create([
            'name' => 'Sarasa Pen(Hitam)',
            'stock' => 200,
            'price' => 15000,
            'image' => 'sarasa.jpg',
            'description' => ' Semua tubuh dirancang dengan baik dengan pegangan karet yang nyaman',
            'type_id' =>  1,
        ]);

        Product::create([
            'name' => 'Sarasa Pen(Biru)',
            'stock' => 200,
            'price' => 15000,
            'image' => 'sarsa_biru.jpg',
            'description' => ' Semua tubuh dirancang dengan baik dengan pegangan karet yang nyaman',
            'type_id' =>  1,
        ]);
        Product::create([
            'name' => 'STAEDTLER 2B PENCIL NORIS HEXAGONAL',
            'stock' => 150,
            'price' => 32000,
            'image' => 'pensil_gambar.jpg',
            'description' => 'High quality pencils',
            'type_id' =>  2,
        ]);
        Product::create([
            'name' => '14Pcs Drawing Sketching Graphite Pencils Professional Art Stationery Pencils Set',
            'stock' => 100,
            'price' => 50000,
            'image' => 'staedtler_2b.jpeg',
            'description' => 'Material: wood',
            'type_id' =>  2,
        ]);
        Product::create([
            'name' => 'Penggaris Butterfly',
            'stock' => 120,
            'price' => 6000,
            'image' => 'penggaris.png',
            'description' => 'penggaris dengan panjang 30cm',
            'type_id' =>  3,
        ]);
        Product::create([
            'name' => 'Penggaris Segitiga',
            'stock' => 10,
            'price' => 5000,
            'image' => 'penggaris3.jpg',
            'description' => 'Penggaaris tiga sisi',
            'type_id' =>  3,
        ]);
        Product::create([
            'name' => 'Spiral Notebook',
            'stock' => 5,
            'price' => 100000,
            'image' => 'notebook_hitam.jpg',
            'description' => 'The Times Spiral Notebook is the classic keeper of everyday things ',
            'type_id' =>  4,
        ]);
        Product::create([
            'name' => 'Notebook A5 Grid Nude',
            'stock' => 100,
            'price' => 90000,
            'image' => 'notebook_karet.jpg',
            'description' => 'Dimensions: A5 (15 x 21 cm) ',
            'type_id' =>  4,
        ]);
        
        Product::create([
            'name' => 'Oxford English Dictionary',
            'stock' => 50,
            'price' => 24500,
            'image' => 'kamus_oxford.jpg',
            'description' => 'This fully updated edition offers over 120,000 words, phrases, and definitions.',
            'type_id' =>  5,
        ]);

        Product::create([
            'name' => 'KBBI',
            'stock' => 10,
            'price' => 5800,
            'image' => 'kbbi.jpg',
            'description' => 'The Great Dictionary of the Indonesian Language of the Language Center is the official dictionary of the Indonesian language',
            'type_id' =>  5,
        ]);
        Product::create([
            'name' => 'Stylus Pens Ipad Pencil Fine Point Active Smart Digital Pen White',
            'stock' => 20,
            'price' => 20000,
            'image' => 'smart_pen.jpg',
            'description' => 'Stylus Pen Universal Touch High Precision Ujung Lancip bisa Gambar untuk semua touchscreen, touch pen serbaguna yang bisa dipakai di segala smartphone / tablet / Ipad Apple',
            'type_id' =>  6,
        ]);
        Product::create([
            'name' => 'Apple Pencil 2nd Generation New Apple Pencil 2 Gen iPad Pro 2018-2020',
            'stock' => 20,
            'price' => 2000000,
            'image' => 'apple_pencil.jpg',
            'description' => 'The new Apple Pencil delivers pixel-perfect precision and industry-leading low latency, making it great for drawing',
            'type_id' =>  7,
        ]);
        Product::create([
            'name' => 'Uni Boxy Eraser - Black',
            'stock' => 200,
            'price' => 15000,
            'image' => 'boxy.jpg',
            'description' => 'Sangat direkomendasikan untuk saat ujian karena bentuk ampas hapusan yang seperti lilitan ampas',
            'type_id' =>  10,
        ]);
        Product::create([
            'name' => 'Peclian BR 40® Rubber Eraser',
            'stock' => 20,
            'price' => 50000,
            'image' => 'peclian.jpg',
            'description' => 'The BR 40® Rubber Eraser from Pelikan offers one side for erasing lead pencil, and one side for ink, ball point pen and much more.',
            'type_id' =>  10,
        ]);

    }
}
