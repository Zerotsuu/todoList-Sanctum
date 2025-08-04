<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user (or create one if none exists)
        $user = User::first() ?? User::factory()->create();

        // Create sample todos
        Todo::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);
    }
}
