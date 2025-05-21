<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer')->insert([
            'username' => 'edp@gmail.com',
            'password' => Hash::make('jangandihack'),
            'role' => 'admin',
            'name' => 'EDP admin',
            'login_type' => 'Master',
        ]);
    }
}
