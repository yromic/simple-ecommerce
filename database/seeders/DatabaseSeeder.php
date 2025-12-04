<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_seller' => false,
        ]);

        $seller = User::create([
            'name' => 'Budi Seller',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_seller' => true,
        ]);

        User::create([
            'name' => 'Andi Buyer',
            'email' => 'buyer@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_seller' => false,
        ]);

        Product::create([
            'user_id' => $seller->id,
            'name' => 'Laptop Gaming Murah',
            'description' => 'Laptop spek dewa harga kaki lima',
            'price' => 5000000,
            'stock' => 10,
        ]);

        Product::create([
            'user_id' => $seller->id,
            'name' => 'Mouse Wireless',
            'description' => 'Anti delay, baterai awet',
            'price' => 150000,
            'stock' => 50,
        ]);
    }
}
