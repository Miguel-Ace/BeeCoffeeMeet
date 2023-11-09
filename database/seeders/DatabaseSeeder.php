<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin.bee@gmail.com',
            'password' => Hash::make('Str@ng2023*Cr'),
            'telefono' => null,
            'direccion' => null,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
