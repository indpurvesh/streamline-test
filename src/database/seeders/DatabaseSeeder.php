<?php

namespace Database\Seeders;

use App\Models\Directory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)
            ->has(Directory::factory()->count(5))
            ->create([
                'email' => 'admin@admin.com'
            ]);
        \App\Models\User::factory(3)
            ->has(Directory::factory()->count(5))
            ->create();
    }
}
