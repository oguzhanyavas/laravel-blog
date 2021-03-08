<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
          'name' => 'Oğuzhan Yavaş',
          'email' => 'oguzhan.yavas54@gmail.com',
          'password' => Hash::make('oksn1234'),
        ]);
    }
}
