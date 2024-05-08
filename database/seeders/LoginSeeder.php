<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'role' => 'superadmin',
            'password' => Hash::make('admin'),
        ]);
    }
}
