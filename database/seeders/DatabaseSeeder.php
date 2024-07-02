<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'role' => 'admin',
                'first_name' => 'super',
                'last_name' => 'admin',
                'email' => 'super.admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ],
            [
                'role' => 'buyer',
                'first_name' => 'marsel',
                'last_name' => 'rewo',
                'email' => 'marsel@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ],
        ]);
        UserAddress::factory()->create(['user_id' => 1]);
        UserAddress::factory()->create(['user_id' => 2]);
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            CartItemSeeder::class
        ]);
    }
}
