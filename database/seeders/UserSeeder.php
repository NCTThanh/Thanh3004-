<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        
        User::updateOrCreate(
            ['email' => 'thanhdayroi3004@gmail.com'], 
            [
                'name' => 'McLaren Admin',
                'password' => Hash::make('password'), 
                'is_admin' => true,
                'email_verified_at' => null,
            ]
        );

        
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'email_verified_at' => null,
            ]
        );
        
       
    }
}