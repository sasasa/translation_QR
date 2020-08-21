<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KEY food
        // ID 1
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => '食べ物',
            'genre_key' => 'food',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 2
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Food',
            'genre_key' => 'food',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 3
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '单点',
            'genre_key' => 'food',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 4
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '단품',
            'genre_key' => 'food',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // KEY drink
        // ID 5
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => '飲み物',
            'genre_key' => 'drink',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 6
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Drink',
            'genre_key' => 'drink',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 7
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '饮料',
            'genre_key' => 'drink',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 8
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '음료',
            'genre_key' => 'drink',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // KEY set-meals
        // ID 9
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => 'セット',
            'genre_key' => 'set-meals',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 10
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Set Meals',
            'genre_key' => 'set-meals',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 11
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '套餐',
            'genre_key' => 'set-meals',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 12
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '세트',
            'genre_key' => 'set-meals',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
