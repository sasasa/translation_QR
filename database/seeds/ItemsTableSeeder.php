<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 前提としてstorage/app/public内にdog.jpgが存在していること
        for($i = 1; $i <= 10; $i++) {
            if ( Storage::disk('public')->exists('han.jpg') ) {
                Storage::disk('public')->copy('han.jpg', 'han'. $i. '.jpg');
            } else {
                throw new Exception('storage/app/public内にhan.jpgが存在しないのでSeedingを終了する');
            }
            if ( Storage::disk('public')->exists('drink.jpg') ) {
                Storage::disk('public')->copy('drink.jpg', 'drink'. $i. '.jpg');
            } else {
                throw new Exception('storage/app/public内にdrink.jpgが存在しないのでSeedingを終了する');
            }
            if ( Storage::disk('public')->exists('set.jpg') ) {
                Storage::disk('public')->copy('set.jpg', 'set'. $i. '.jpg');
            } else {
                throw new Exception('storage/app/public内にset.jpgが存在しないのでSeedingを終了する');
            }
            // 単品
            DB::table('items')->insert([
                'lang' => 'ja_JP',
                'item_name' => 'ハンバーガー【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => 'ハンバーガー【'. $i. '】の説明',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'en_US',
                'item_name' => 'hamburger【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => 'hamburger【'. $i. '】description',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'zh_CN',
                'item_name' => '汉堡包【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => '汉堡包【'. $i. '】描述',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'ko_KR',
                'item_name' => '햄버거【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => '햄버거【'. $i. '】설명',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ドリンク
            DB::table('items')->insert([
                'lang' => 'ja_JP',
                'item_name' => 'コーラ【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => 'コーラ【'. $i. '】の説明',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'en_US',
                'item_name' => 'cola【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => 'cola【'. $i. '】description',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'zh_CN',
                'item_name' => '可乐【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => '可乐【'. $i. '】描述',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'ko_KR',
                'item_name' => '콜라【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => '콜라【'. $i. '】설명',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // セット
            DB::table('items')->insert([
                'lang' => 'ja_JP',
                'item_name' => '定食【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '定食【'. $i. '】の説明',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'en_US',
                'item_name' => 'set meal【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => 'set meal【'. $i. '】description',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'zh_CN',
                'item_name' => '套餐【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '套餐【'. $i. '】描述',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('items')->insert([
                'lang' => 'ko_KR',
                'item_name' => '정식【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '정식【'. $i. '】설명',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
