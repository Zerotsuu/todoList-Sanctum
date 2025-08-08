<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TodoGroup;
use App\Models\User;
use App\Models\Todo;

class TodoGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            
            // Create 2 groups for each user
            $groups = TodoGroup::factory(2)->create([
                'user_id' => $user->id,
            ]);

            // For each group, create 2 todos
            foreach ($groups as $group) {
                Todo::factory(2)->create([
                    'user_id' => $user->id,
                    'todo_group_id' => $group->id,
                ]);
            }

            // Create 2 todos without a group
            Todo::factory(2)->create([
                'user_id' => $user->id,
                'todo_group_id' => null,
            ]);
        }
    }
}
