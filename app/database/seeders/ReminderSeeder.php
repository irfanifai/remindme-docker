<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reminder;
use Faker\Factory as Faker;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Reminder::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'remind_at' => $faker->dateTimeBetween('now', '+30 days')->getTimestamp(),
                'event_at' => $faker->dateTimeBetween('+31 days', '+60 days')->getTimestamp(),
            ]);
        }
    }
}
