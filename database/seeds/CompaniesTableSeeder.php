<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
            'name' => str_random(10),
            'slug' => str_random(5),
            'phone' => '080137507119',
            'email' => str_random(10).'@gmail.com'
        ]);
    }
}
