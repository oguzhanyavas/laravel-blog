<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 20; $i++) {
            $title = $faker->sentence(6);
            DB::table('articles')->insert([
            'user_id' => rand(1, 3),
            'category_id' => rand(1, 6),
            'title' => $title,
            'image' => 'https://picsum.photos/800/400',
            'content' => $faker->text(400),
            'hit' => rand(0, 200),
            'slug' => Str::slug($title),
            'status' => 1,
            'created_at' =>  $faker->dateTime($max = 'now'),
            'updated_at' => date('Y-m-d H:i:s'),

          ]);
        }
    }
}
