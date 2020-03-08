<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'JJ Gesulgon',
            'email' => 'jjgesulgon@gmail.com',
            'password' => bcrypt('Jjg12081994'),
            'created_at' => Carbon::now()
        ]);
    }
}