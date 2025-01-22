<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => '1',
            'email' => '1@example.com',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'name' => '2',
            'email' => '2@example.com',
            'password' => bcrypt('123'),
        ]);

        Status::create(['status' => 'Pending']);
        Status::create(['status' => 'In-Progress']);
        Status::create(['status' => 'Completed']);
    }
}
