<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(18)->create();

        foreach ($users as $user) {
            UserAddress::factory()
                ->create(['user_id' => $user->id]);

            DB::table('user_shoping_carts')->insert([
                'user_id' => $user->id
            ]);
        }
    }
}
