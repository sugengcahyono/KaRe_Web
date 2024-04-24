<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserdumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_user' => 'sugeng',
            'email_user' => 'sugeng@example.com',
            'alamat_user' => 'kediri',
            'notelp_user' => '085812455631',
            'foto_user' => 'cfxcxzh',
            'level_user' => 'admin',
            'password_user' => Hash::make('admin1234'),
        ]);
    }
}
