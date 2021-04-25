<?php


use Illuminate\Support\Facades\DB;

class UserSeeder extends \Illuminate\Database\Seeder
{
    public function run() {
        DB::table("users")->insert([
            "name" => "Customer 1",
            "email" => "customer1@email.com",
            "email_verified_at" => now(),
            "password" => \Illuminate\Support\Facades\Hash::make("test1234")
        ]);

        DB::table("users")->insert([
            "name" => "Customer 2",
            "email" => "customer2@email.com",
            "email_verified_at" => now(),
            "password" => \Illuminate\Support\Facades\Hash::make("test1234")
        ]);
    }
}
