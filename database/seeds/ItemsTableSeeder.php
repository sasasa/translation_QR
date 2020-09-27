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
            // if (!Storage::disk('public')->exists('han1.jpg')) 
            // {
            //     if ( Storage::disk('public')->exists('han.jpg') ) {
            //         Storage::disk('public')->copy('han.jpg', 'han'. $i. '.jpg');
            //     } else {
            //         throw new Exception('storage/app/public内にhan.jpgが存在しないのでSeedingを終了する');
            //     }
            //     if ( Storage::disk('public')->exists('drink.jpg') ) {
            //         Storage::disk('public')->copy('drink.jpg', 'drink'. $i. '.jpg');
            //     } else {
            //         throw new Exception('storage/app/public内にdrink.jpgが存在しないのでSeedingを終了する');
            //     }
            //     if ( Storage::disk('public')->exists('set.jpg') ) {
            //         Storage::disk('public')->copy('set.jpg', 'set'. $i. '.jpg');
            //     } else {
            //         throw new Exception('storage/app/public内にset.jpgが存在しないのでSeedingを終了する');
            //     }
            //     if ( Storage::disk('public')->exists('carbonara.jpg') ) {
            //         Storage::disk('public')->copy('carbonara.jpg', 'carbonara'. $i. '.jpg');
            //     } else {
            //         throw new Exception('storage/app/public内にcarbonara.jpgが存在しないのでSeedingを終了する');
            //     }
            // }

            // 単品
            $item = new \App\Item();
            $item->fill([
                'lang' => 'ja_JP',
                'item_name' => 'チーズバーガー【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => 'チーズバーガー【'. $i. '】の説明',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 13,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenSet([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ]);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'en_US',
                'item_name' => 'cheeseburger【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => 'cheeseburger【'. $i. '】description',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 14,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'zh_CN',
                'item_name' => '芝士汉堡包【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => '芝士汉堡包【'. $i. '】描述',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 15,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'ko_KR',
                'item_name' => '치즈 버거【'. $i. '】',
                'item_key' => 'hamburger'. $i,
                'item_desc' => '치즈 버거【'. $i. '】설명',
                'image_path' => 'han'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 16,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'ja_JP',
                'item_name' => 'カルボナーラ【'. $i. '】',
                'item_key' => 'carbonara'. $i,
                'item_desc' => 'カルボナーラ【'. $i. '】の説明',
                'image_path' => 'carbonara'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 17,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenSet([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ]);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'en_US',
                'item_name' => 'carbonara【'. $i. '】',
                'item_key' => 'carbonara'. $i,
                'item_desc' => 'carbonara【'. $i. '】description',
                'image_path' => 'carbonara'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 18,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'zh_CN',
                'item_name' => '卡博纳拉【'. $i. '】',
                'item_key' => 'carbonara'. $i,
                'item_desc' => '卡博纳拉【'. $i. '】描述',
                'image_path' => 'carbonara'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 19,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'ko_KR',
                'item_name' => '까르보나라【'. $i. '】',
                'item_key' => 'carbonara'. $i,
                'item_desc' => '까르보나라【'. $i. '】설명',
                'image_path' => 'carbonara'. $i. '.jpg',
                'item_price' => 300,
                'genre_id' => 20,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            // ドリンク
            $item = new \App\Item();
            $item->fill([
                'lang' => 'ja_JP',
                'item_name' => 'コーラ【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => 'コーラ【'. $i. '】の説明',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 5,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenSet([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ]);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'en_US',
                'item_name' => 'cola【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => 'cola【'. $i. '】description',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 6,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            
            $item = new \App\Item();
            $item->fill([
                'lang' => 'zh_CN',
                'item_name' => '可乐【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => '可乐【'. $i. '】描述',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 7,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'ko_KR',
                'item_name' => '콜라【'. $i. '】',
                'item_key' => 'cola'. $i,
                'item_desc' => '콜라【'. $i. '】설명',
                'image_path' => 'drink'. $i. '.jpg',
                'item_price' => 100,
                'genre_id' => 8,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);


            // セット
            $item = new \App\Item();
            $item->fill([
                'lang' => 'ja_JP',
                'item_name' => '定食【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '定食【'. $i. '】の説明',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 9,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenSet([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ]);

            $item = new \App\Item();
            $item->fill([
                'lang' => 'en_US',
                'item_name' => 'set meal【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => 'set meal【'. $i. '】description',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 10,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);


            $item = new \App\Item();
            $item->fill([
                'lang' => 'zh_CN',
                'item_name' => '套餐【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '套餐【'. $i. '】描述',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 11,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);
            

            $item = new \App\Item();
            $item->fill([
                'lang' => 'ko_KR',
                'item_name' => '정식【'. $i. '】',
                'item_key' => 'set meal'. $i,
                'item_desc' => '정식【'. $i. '】설명',
                'image_path' => 'set'. $i. '.jpg',
                'item_price' => 1000,
                'genre_id' => 12,
                'item_order' => $i,
            ]);
            $item->save();
            $item->allergenCopy([
                0 => "1",
                1 => "5",
                2 => "9",
                3 => "13",
                4 => "17",
                5 => "21",
                6 => "25",
                7 => "29",
                8 => "33",
                9 => "37",
                10 => "41",
                11 => "45",
                12 => "49",
                13 => "53",
                14 => "57",
                15 => "61",
                16 => "65",
                17 => "69",
                18 => "73",
                19 => "77",
                20 => "81",
                21 => "85",
                22 => "89",
                23 => "93",
                24 => "97",
                25 => "101",
                26 => "105",
            ], $item->lang);
        }
    }
}
