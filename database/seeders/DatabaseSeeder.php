<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Create Users (Admin, Manager, User) ---

        $users = [
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@site.com',
                'role' => 'administrator',
                'password' => bcrypt('password'),
            ]),

            User::factory()->create([
                'name' => 'Manager User',
                'email' => 'manager@site.com',
                'role' => 'manager',
                'password' => bcrypt('password'),
            ]),

            User::factory()->create([
                'name' => 'Regular User',
                'email' => 'user@site.com',
                'role' => 'user',
                'password' => bcrypt('password'),
            ]),
        ];

        // --- Generate API Tokens (like in the lecture) ---

        foreach ($users as $user) {
            $token = $user->createToken(name: $user->email)->plainTextToken;
            echo "User: {$user->email} - Token: {$token}\n";
        }

        // --- Seed Departments + Products ---

        Department::factory(10)
            ->state(function () use ($users) {
                return [
                    'user_id' => collect($users)->random()->id,
                ];
            })
            ->has(
                Product::factory()
                    ->count(fake()->numberBetween(20, 50))
                    ->state(function () use ($users) {
                        return [
                            'user_id' => collect($users)->random()->id,
                        ];
                    })
            )
            ->create();
    }
}
