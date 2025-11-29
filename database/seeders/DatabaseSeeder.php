<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin Tzu Chi',
            'email' => 'admin@tzuchi.sch.id',
            'password' => bcrypt('admin#1234'),
            'role' => 'admin',
        ]);
    }
}
