<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'user_name' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'user_name' => 'user',
            'password' => Hash::make('user'),
        ]);
    }
}
