<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()
            ->count(15)
            ->create()
            ->each(function ($user) {
                Project::factory()
                    ->count(rand(4, 6))
                    ->create([
                        'owner_id' => $user->id,
                    ]);
            });

         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@schoonveld.com',
             'role' => Role::admin()
         ]);
    }
}
