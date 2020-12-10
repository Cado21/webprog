<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]); 
        User::create([
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member'),
            'role' => 'member',
        ]); 
    }
}
