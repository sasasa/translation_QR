<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'genre_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 2
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Food',
            'genre_key' => 'food',
            'genre_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 3
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '单点',
            'genre_key' => 'food',
            'genre_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 4
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '단품',
            'genre_key' => 'food',
            'genre_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // KEY drink
        // ID 5
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => '飲み物',
            'genre_key' => 'drink',
            'genre_order' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 6
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Drink',
            'genre_key' => 'drink',
            'genre_order' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 7
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '饮料',
            'genre_key' => 'drink',
            'genre_order' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 8
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '음료',
            'genre_key' => 'drink',
            'genre_order' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // KEY set-meals
        // ID 9
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => 'セット',
            'genre_key' => 'set-meals',
            'genre_order' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 10
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'Set Meals',
            'genre_key' => 'set-meals',
            'genre_order' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 11
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '套餐',
            'genre_key' => 'set-meals',
            'genre_order' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // ID 12
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '세트',
            'genre_key' => 'set-meals',
            'genre_order' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 13
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => 'ハンバーガー',
            'genre_key' => 'hamburger',
            'genre_order' => 1,
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 14
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'hamburger',
            'genre_key' => 'hamburger',
            'genre_order' => 1,
            'parent_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 15
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '汉堡包',
            'genre_key' => 'hamburger',
            'genre_order' => 1,
            'parent_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 16
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '햄버거',
            'genre_key' => 'hamburger',
            'genre_order' => 1,
            'parent_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 17
        DB::table('genres')->insert([
            'lang' => 'ja_JP',
            'genre_name' => 'パスタ',
            'genre_key' => 'pasta',
            'genre_order' => 10,
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 18
        DB::table('genres')->insert([
            'lang' => 'en_US',
            'genre_name' => 'pasta',
            'genre_key' => 'pasta',
            'genre_order' => 10,
            'parent_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 19
        DB::table('genres')->insert([
            'lang' => 'zh_CN',
            'genre_name' => '面食',
            'genre_key' => 'pasta',
            'genre_order' => 10,
            'parent_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID 20
        DB::table('genres')->insert([
            'lang' => 'ko_KR',
            'genre_name' => '파스타',
            'genre_key' => 'pasta',
            'genre_order' => 10,
            'parent_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
