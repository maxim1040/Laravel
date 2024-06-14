<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'is_admin' => 1,
        ]);
        
        User::create([
            'name' => 'user1',
            'email' => 'user1@ehb.be',
            'password' => Hash::make('Password!321'),
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@ehb.be',
            'password' => Hash::make('Password!321'),
            'is_admin' => 0,
        ]);
    }
}
