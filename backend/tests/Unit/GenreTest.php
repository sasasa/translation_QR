<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Genre;
use App\Item;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenreTest extends TestCase
{
    use RefreshDatabase;
    use ArraySimilarTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('GenresTableSeeder');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    public function test_Translatable()
    {
        $genre = Genre::create([
            'lang' => 'ja_JP',
            'genre_name' => 'hoge',
            'genre_key' => 'hoge',
        ]);
        $this->assertSame($genre->Lang_jp, '日本語(ja_JP)');
    }

    public function test_optionsForSelectByLang()
    {
        $options = Genre::optionsForSelectByLang('ja_JP');

        $this->assertSame($options, [
            9 => "セット(set-meals)[日本語(ja_JP)]",
            5 => "飲み物(drink)[日本語(ja_JP)]",
            17 => "パスタ(pasta)[日本語(ja_JP)]",
            1 => "食べ物(food)[日本語(ja_JP)]",
            13 => "ハンバーガー(hamburger)[日本語(ja_JP)]",
        ]);
    }

    public function test_optionsForSelectWithOut()
    {
        $options = Genre::optionsForSelectWithOut();

        $this->assertSame($options, [
            9 => "セット(set-meals)[日本語(ja_JP)]",
            10 => 'Set Meals(set-meals)[英語(en_US)]',
            11 => '套餐(set-meals)[中国語(zh_CN)]',
            12 => '세트(set-meals)[韓国語(ko_KR)]',
            5 => '飲み物(drink)[日本語(ja_JP)]',
            6 => 'Drink(drink)[英語(en_US)]',
            7 => '饮料(drink)[中国語(zh_CN)]',
            8 => '음료(drink)[韓国語(ko_KR)]',
            17 => 'パスタ(pasta)[日本語(ja_JP)]',
            18 => 'pasta(pasta)[英語(en_US)]',
            19 => '面食(pasta)[中国語(zh_CN)]',
            20 => '파스타(pasta)[韓国語(ko_KR)]',
            1 => '食べ物(food)[日本語(ja_JP)]',
            2 => 'Food(food)[英語(en_US)]',
            3 => '单点(food)[中国語(zh_CN)]',
            4 => '단품(food)[韓国語(ko_KR)]',
            13 => 'ハンバーガー(hamburger)[日本語(ja_JP)]',
            14 => 'hamburger(hamburger)[英語(en_US)]',
            15 => '汉堡包(hamburger)[中国語(zh_CN)]',
            16 => '햄버거(hamburger)[韓国語(ko_KR)]',
        ]);
    }

    public function test_optionsForGenreKey()
    {
        $options = Genre::optionsForGenreKey();

        $this->assertArraySimilar($options, [
            '' => 'ジャンルキーを選択してください',
            'food' => 'food',
            'drink' => 'drink',
            'set-meals' => 'set-meals',
            'hamburger' => 'hamburger',
            'pasta' => 'pasta',
        ]);
    }

    public function test_optionsForSelectParents()
    {
        $options = Genre::optionsForSelectParents();

        $this->assertArraySimilar($options, [
            '' => '階層構造にする場合は選択してください',
            9 => "セット(set-meals)[日本語(ja_JP)]",
            10 => 'Set Meals(set-meals)[英語(en_US)]',
            11 => '套餐(set-meals)[中国語(zh_CN)]',
            12 => '세트(set-meals)[韓国語(ko_KR)]',
            5 => '飲み物(drink)[日本語(ja_JP)]',
            6 => 'Drink(drink)[英語(en_US)]',
            7 => '饮料(drink)[中国語(zh_CN)]',
            8 => '음료(drink)[韓国語(ko_KR)]',
            1 => '食べ物(food)[日本語(ja_JP)]',
            2 => 'Food(food)[英語(en_US)]',
            3 => '单点(food)[中国語(zh_CN)]',
            4 => '단품(food)[韓国語(ko_KR)]',
        ]);
    }

    public function test_optionsForSelectParentsByLangForInstance1()
    {
        $options = Genre::where('genre_name', 'パスタ')->
                        first()->
                        optionsForSelectParentsByLangForInstance();

        $this->assertArraySimilar($options, [
            9 => "セット(set-meals)[日本語(ja_JP)]",
            5 => '飲み物(drink)[日本語(ja_JP)]',
            1 => '食べ物(food)[日本語(ja_JP)]',
            '' => '階層構造にする場合は選択してください',
        ]);
    }

    public function test_optionsForSelectParentsByLangForInstance2()
    {
        $options = Genre::where('genre_name', '飲み物')->
                        first()->
                        optionsForSelectParentsByLangForInstance();

        $this->assertArraySimilar($options, [
            9 => "セット(set-meals)[日本語(ja_JP)]",
            1 => '食べ物(food)[日本語(ja_JP)]',
            '' => '階層構造にする場合は選択してください',
        ]);
    }

    public function test_saveOtherLangByKey()
    {
        $genre = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
            'parent_id' => 1,
        ]);
        $genre->saveOtherLangByKey();
        $this->assertDatabaseHas('genres', [
            'genre_key' => 'hoge',
            'genre_name' => '【ほげほげ】の翻訳を入れてください',
            'lang' => 'en_US',
            'genre_order' => 1,
            'parent_id' => 2,
        ]);
        $this->assertDatabaseHas('genres', [
            'genre_key' => 'hoge',
            'genre_name' => '【ほげほげ】の翻訳を入れてください',
            'lang' => 'zh_CN',
            'genre_order' => 1,
            'parent_id' => 3,
        ]);
        $this->assertDatabaseHas('genres', [
            'genre_key' => 'hoge',
            'genre_name' => '【ほげほげ】の翻訳を入れてください',
            'lang' => 'ko_KR',
            'genre_order' => 1,
            'parent_id' => 4,
        ]);
    }

    public function test_getHashAttribute()
    {
        $hoge_jp = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);
        $hige_jp = Genre::create([
            'genre_key' => 'hige',
            'genre_name' => 'ひげひげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);
        $hoge_en = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'hogehoge',
            'lang' => 'en_US',
            'genre_order' => 1,
        ]);
        $this->assertSame($hoge_jp->hash, $hoge_en->hash);
        $this->assertNotSame($hoge_jp->hash, $hige_jp->hash);
    }

    public function test_items()
    {
        $genre = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);
        $this->assertCount(0, $genre->items->toArray());

        $array1 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ1',
            'item_key' => 'hoge1',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => $genre->id,
            'image_path' => 'hoge.jpg',
        ];
        $item1 = Item::create($array1);
        $array2 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ2',
            'item_key' => 'hoge2',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => $genre->id,
            'image_path' => 'hoge.jpg',
        ];
        $item2 = Item::create($array2);

        $genre->refresh();
        $this->assertCount(2, $genre->items->toArray());
    }

    public function test_item()
    {
        $genre = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);
        $this->assertNull($genre->item);

        $array1 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ1',
            'item_key' => 'hoge1',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => $genre->id,
            'image_path' => 'hoge.jpg',
        ];
        $item1 = Item::create($array1);
        $array2 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ2',
            'item_key' => 'hoge2',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => $genre->id,
            'image_path' => 'hoge.jpg',
        ];
        $item2 = Item::create($array2);

        $genre->refresh();
        $this->assertNotNull($genre->item);
    }

    public function test_parent_and_children()
    {
        $genre = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
            'parent_id' => null,
        ]);
        $this->assertNull($genre->parent);
        
        $parent = Genre::create([
            'genre_key' => 'parent',
            'genre_name' => '親',
            'lang' => 'ja_JP',
            'genre_order' => 1,
            'parent_id' => null,
        ]);
        $this->assertCount(0, $parent->children->toArray());

        $genre->parent_id = $parent->id;
        $genre->save();
        $genre->refresh();
        $parent->refresh();

        $this->assertNotNull($genre->parent);
        $this->assertCount(1, $parent->children->toArray());
    }
}
