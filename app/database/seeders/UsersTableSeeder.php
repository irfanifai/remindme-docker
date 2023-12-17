<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        User::create([
            'name' => 'Alice',
            'email' => 'alice@mail.com',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'name' => 'Bob',
            'email' => 'bob@mail.com',
            'password' => Hash::make('123456'),
        ]);

        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('123456'),
            ]);
        }
    }
}
