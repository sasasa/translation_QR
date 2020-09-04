<?php

use Illuminate\Database\Seeder;

class AllergensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // egg
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'たまご',
            'allergen_key' => 'egg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Egg',
            'allergen_key' => 'egg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '鸡蛋',
            'allergen_key' => 'egg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '계란',
            'allergen_key' => 'egg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // milk
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '牛乳',
            'allergen_key' => 'milk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Milk',
            'allergen_key' => 'milk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '牛奶',
            'allergen_key' => 'milk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '우유',
            'allergen_key' => 'milk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // wheat
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '小麦',
            'allergen_key' => 'wheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Wheat',
            'allergen_key' => 'wheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '小麦',
            'allergen_key' => 'wheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '밀',
            'allergen_key' => 'wheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // buckwheat
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'そば',
            'allergen_key' => 'buckwheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Buckwheat',
            'allergen_key' => 'buckwheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '荞',
            'allergen_key' => 'buckwheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '메밀',
            'allergen_key' => 'buckwheat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // peanut
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '落花生',
            'allergen_key' => 'peanut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Peanut',
            'allergen_key' => 'peanut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '花生',
            'allergen_key' => 'peanut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '땅콩',
            'allergen_key' => 'peanut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // shrimp
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'えび',
            'allergen_key' => 'shrimp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Shrimp',
            'allergen_key' => 'shrimp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '虾',
            'allergen_key' => 'shrimp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '새우',
            'allergen_key' => 'shrimp',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // crab
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'かに',
            'allergen_key' => 'crab',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Crab',
            'allergen_key' => 'crab',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '蟹',
            'allergen_key' => 'crab',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '게',
            'allergen_key' => 'crab',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // squid
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'いか',
            'allergen_key' => 'squid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Squid',
            'allergen_key' => 'squid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '乌贼',
            'allergen_key' => 'squid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '오징어',
            'allergen_key' => 'squid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // abalone
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'あわび',
            'allergen_key' => 'abalone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Abalone',
            'allergen_key' => 'abalone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '鲍鱼',
            'allergen_key' => 'abalone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '전복',
            'allergen_key' => 'abalone',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // salmonroe
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'いくら',
            'allergen_key' => 'salmonroe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Salmon Roe',
            'allergen_key' => 'salmonroe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '三文鱼子',
            'allergen_key' => 'salmonroe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '연어알',
            'allergen_key' => 'salmonroe',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // salmon
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'さけ',
            'allergen_key' => 'salmon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Salmon',
            'allergen_key' => 'salmon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '三文鱼',
            'allergen_key' => 'salmon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '연어',
            'allergen_key' => 'salmon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // mackerel
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'さば',
            'allergen_key' => 'mackerel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Mackerel',
            'allergen_key' => 'mackerel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '鲭鱼',
            'allergen_key' => 'mackerel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '고등어',
            'allergen_key' => 'mackerel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // apple
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'りんご',
            'allergen_key' => 'apple',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Apple',
            'allergen_key' => 'apple',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '苹果',
            'allergen_key' => 'apple',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '사과',
            'allergen_key' => 'apple',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // peach
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'もも',
            'allergen_key' => 'peach',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Peach',
            'allergen_key' => 'peach',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '桃子',
            'allergen_key' => 'peach',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '복숭아',
            'allergen_key' => 'peach',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // kiwi
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'キウイ',
            'allergen_key' => 'kiwi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Kiwi',
            'allergen_key' => 'kiwi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '猕猴桃',
            'allergen_key' => 'kiwi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '키위',
            'allergen_key' => 'kiwi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // orange
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'オレンジ',
            'allergen_key' => 'orange',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Orange',
            'allergen_key' => 'orange',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '橙子',
            'allergen_key' => 'orange',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '주황색',
            'allergen_key' => 'orange',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // banana
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'バナナ',
            'allergen_key' => 'banana',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Banana',
            'allergen_key' => 'banana',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '香蕉',
            'allergen_key' => 'banana',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '바나나',
            'allergen_key' => 'banana',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // walnut
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'くるみ',
            'allergen_key' => 'walnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Walnut',
            'allergen_key' => 'walnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '核桃',
            'allergen_key' => 'walnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '호두',
            'allergen_key' => 'walnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // soybean
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '大豆',
            'allergen_key' => 'soybean',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Soybean',
            'allergen_key' => 'soybean',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '黄豆',
            'allergen_key' => 'soybean',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '대두',
            'allergen_key' => 'soybean',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // matsutakemushroom
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'まつたけ',
            'allergen_key' => 'matsutakemushroom',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Matsutake mushroom',
            'allergen_key' => 'matsutakemushroom',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '松茸蘑菇',
            'allergen_key' => 'matsutakemushroom',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '송이',
            'allergen_key' => 'matsutakemushroom',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // yam
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'やまいも',
            'allergen_key' => 'yam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Yam',
            'allergen_key' => 'yam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '山药',
            'allergen_key' => 'yam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '참마',
            'allergen_key' => 'yam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // gelatin
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'ゼラチン',
            'allergen_key' => 'gelatin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Gelatin',
            'allergen_key' => 'gelatin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '明胶',
            'allergen_key' => 'gelatin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '젤라틴',
            'allergen_key' => 'gelatin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // beef
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '牛肉',
            'allergen_key' => 'beef',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Beef',
            'allergen_key' => 'beef',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '牛肉',
            'allergen_key' => 'beef',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '쇠고기',
            'allergen_key' => 'beef',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // pork
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '豚肉',
            'allergen_key' => 'pork',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Pork',
            'allergen_key' => 'pork',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '豚肉',
            'allergen_key' => 'pork',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '돼지고기',
            'allergen_key' => 'pork',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // chicken
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => '鶏肉',
            'allergen_key' => 'chicken',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Chicken',
            'allergen_key' => 'chicken',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '鸡',
            'allergen_key' => 'chicken',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '닭고기',
            'allergen_key' => 'chicken',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // sesame
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'ごま',
            'allergen_key' => 'sesame',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Sesame',
            'allergen_key' => 'sesame',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '芝麻',
            'allergen_key' => 'sesame',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '참깨',
            'allergen_key' => 'sesame',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // cashewnut
        DB::table('allergens')->insert([
            'lang' => 'ja_JP',
            'allergen_name' => 'カシューナッツ',
            'allergen_key' => 'cashewnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'en_US',
            'allergen_name' => 'Cashew nut',
            'allergen_key' => 'cashewnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'zh_CN',
            'allergen_name' => '腰果',
            'allergen_key' => 'cashewnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('allergens')->insert([
            'lang' => 'ko_KR',
            'allergen_name' => '캐슈 너트',
            'allergen_key' => 'cashewnut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
