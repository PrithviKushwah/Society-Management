<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => Hash::make('secret'),
            'role' => 'admin'
        ]);
    }
}
