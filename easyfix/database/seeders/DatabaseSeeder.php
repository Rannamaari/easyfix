<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin if not exists
        User::firstOrCreate(
            ['email' => 'admin@easyfix.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create test customer
        User::firstOrCreate(
            ['email' => 'customer@easyfix.com'],
            [
                'name' => 'John Customer',
                'password' => bcrypt('password'),
                'role' => 'customer',
            ]
        );

        // Create test provider
        User::firstOrCreate(
            ['email' => 'provider@easyfix.com'],
            [
                'name' => 'Mike Provider',
                'password' => bcrypt('password'),
                'role' => 'provider',
            ]
        );

        $this->call([
            ServiceCategorySeeder::class,
        ]);
    }
}
