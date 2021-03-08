<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $pages = ['Hakkimizda','Kariye','Vizyonumuz','Misyonuzmuz'];
        $count=0;
        foreach ($pages as $page) {
            $title = $page;
            DB::table('pages')->insert([
                'title' => $title,
                'image' => 'https://picsum.photos/800/400',
                'content' => $faker->text(400),
                'slug' => Str::slug($title),
                'order' => $count,
                'status' => 1,
                'created_at' =>  $faker->dateTime($max = 'now'),
                'updated_at' => date('Y-m-d H:i:s'),
              ]);
            $count += 1;
        }
    }
}
