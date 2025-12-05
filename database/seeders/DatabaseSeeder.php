<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
       
        DB::table('users')->where('email', 'test@example.com')->delete();

        
        $this->call([
            UserSeeder::class, 
            CarSeeder::class,
            ContentSeeder::class, 
        ]);
        
       
    }
}