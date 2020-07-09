<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'address' => '',
            'phone' => '',
            'role' => 'admin',
            'password' => Hash::make('123qweasd'),
        ]);
        
        User::create([
            'name' => 'Sueb',
            'email' => 'sueb@gmail.com',
            'address' => '',
            'phone' => '',
            'role' => 'peminjam',
            'password' => Hash::make('123qweasd'),
        ]);
    }
}