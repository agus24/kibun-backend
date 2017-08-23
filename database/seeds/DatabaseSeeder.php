<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "username" => "admin",
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt('admin'),
            "remember_token" => str_random(10)
        ]);
        factory(App\User::class, 10)->create();
    }
}
