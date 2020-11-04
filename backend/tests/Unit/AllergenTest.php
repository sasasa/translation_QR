<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Allergen;
use App\Item;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllergenTest extends TestCase
{
    use RefreshDatabase;
    use ArraySimilarTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('AllergensTableSeeder');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    public function test_Translatable()
    {
        $allergen = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'hoge',
            'allergen_key' => 'hoge',
        ]);
        $this->assertSame($allergen->lang_jp, '日本語(ja_JP)');
    }

    public function test_getNameJpAttribute()
    {
        $allergen_jp = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげほげ',
            'allergen_key' => 'hoge',
        ]);
        $allergen_en = Allergen::create([
            'lang' => 'en_US',
            'allergen_name' => 'hogehoge',
            'allergen_key' => 'hoge',
        ]);
        $this->assertSame($allergen_jp->name_jp, $allergen_jp->allergen_name);
        $this->assertSame($allergen_en->name_jp, $allergen_jp->allergen_name);
    }
    
    public function test_saveOtherLangByKey()
    {
        $allergen = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげほげ',
            'allergen_key' => 'hoge',
        ]);
        $allergen->saveOtherLangByKey();

        $this->assertDatabaseHas('allergens', [
            'lang' => 'en_US',
            'allergen_name' => '【ほげほげ】の翻訳を入れてください',
            'allergen_key' => 'hoge',
        ]);
        $this->assertDatabaseHas('allergens', [
            'lang' => 'zh_CN',
            'allergen_name' => '【ほげほげ】の翻訳を入れてください',
            'allergen_key' => 'hoge',
        ]);
        $this->assertDatabaseHas('allergens', [
            'lang' => 'ko_KR',
            'allergen_name' => '【ほげほげ】の翻訳を入れてください',
            'allergen_key' => 'hoge',
        ]);
    }

    public function test_getHashAttribute()
    {
        $hoge_jp = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげ',
            'allergen_key' => 'hoge',
        ]);
        $hige_jp = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ひげ',
            'allergen_key' => 'hige',
        ]);
        $hoge_en = Allergen::create([
            'lang' => 'en_US',
            'allergen_name' => 'hoge',
            'allergen_key' => 'hoge',
        ]);
        $this->assertSame($hoge_jp->hash, $hoge_en->hash);
        $this->assertNotSame($hoge_jp->hash, $hige_jp->hash);
    }

    public function test_items()
    {
        $allergen = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげ',
            'allergen_key' => 'hoge',
        ]);
        $this->assertCount(0, $allergen->items->toArray());

        $array1 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ1',
            'item_key' => 'hoge1',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ];
        $item1 = Item::create($array1);
        $item1->allergenSet([$allergen->id]);
        $array2 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ2',
            'item_key' => 'hoge2',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ];
        $item2 = Item::create($array2);
        $item2->allergenSet([$allergen->id]);
        
        $allergen->refresh();
        // dd($allergen->items->toArray());

        $this->assertCount(2, $allergen->items->toArray());
    }
}
