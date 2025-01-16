<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SandykaDK',
            'email' => 'sandyka@gmail.com',
            'password' => Hash::make('sandyka123'),
        ]);
    }
}
