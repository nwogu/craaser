<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Gabriel Nwogu',
            'phone' => '080137507119',
            'email' => 'nwogugabriel@gmail.com',
            'password' => bcrypt('Saintangel7'),
            'company_id' => 1,
            'role_id' => 1
        ]);
    }
}
