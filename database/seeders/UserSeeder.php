<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'no_hp' => '79079070s',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('12345'),
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'no_hp' => '79079070s',
            'level' => '1',
            'status' => '1',
            'password' => Hash::make('12345'),
        ]);
    }
}
