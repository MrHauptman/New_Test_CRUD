<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("roles")->insert([
            "role_name" => "Moderator",
            "role_slug" => "moderator",
        ]);
 
        DB::table("roles")->insert([
            "role_name" => "User",
            "role_slug" => "user",
        ]);
 
        DB::table("roles")->insert([
            "role_name" => "Seller",
            "role_slug" => "seller",
        ]);
    }
}
