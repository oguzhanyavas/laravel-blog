<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'Okan Beydanol',
        'username' => 'oksn123',
        'email' => 'okan.beydanol@gmail.com',
        'password' => Hash::make('oksn1234'),
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now()

      ]);

        DB::table('users')->insert([
      'name' => 'Okan Beydanol',
      'username' => 'oksn12',
      'email' => 'okan.beydanoll@gmail.com',
      'password' => Hash::make('oksn1234'),
      'status' => 0,
      'created_at' => now(),
      'updated_at' => now()
    ]);
        DB::table('users')->insert([
    'name' => 'Okan Beydanol',
    'username' => 'oksn1',
    'email' => 'okan.beydanolll@gmail.com',
    'password' => Hash::make('oksn1234'),
    'status' => 0,
    'created_at' => now(),
    'updated_at' => now()
  ]);
    }
}
