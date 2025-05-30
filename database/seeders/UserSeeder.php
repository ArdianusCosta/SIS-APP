<?php

namespace Database\Seeders;

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
    public function run() : void
    {
        User::create([
            'name' => 'costa',
            'email' => 'costa@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);
    }
}
