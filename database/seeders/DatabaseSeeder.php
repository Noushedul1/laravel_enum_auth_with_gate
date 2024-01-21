<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Editor;
use App\Models\Manager;
use App\Models\Superadmin;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'super_admin',
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make(12345678),
            'role'=>'super_admin'
        ]);
        User::create([
            'name'=>'manager',
            'email'=>'managaer@gmail.com',
            'password'=>Hash::make(12345678),
            'role'=>'manager'
        ]);
        User::create([
            'name'=>'editor',
            'email'=>'editor@gmail.com',
            'password'=>Hash::make(12345678),
            'role'=>'editor'
        ]);
    }
}
