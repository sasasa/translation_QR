<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Item;
use App\Allergen;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
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
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $this->assertSame($item->Lang_jp, '日本語(ja_JP)');
    }

    public function test_allergenSet()
    {
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $allergen_egg = Allergen::find(1);
        $allergen_milk = Allergen::find(5);
        $item->allergenSet([$allergen_egg->id, $allergen_milk->id]);

        $this->assertDatabaseHas('allergen_item', [
            'allergen_id' => $allergen_egg->id,
            'item_id' => $item->id,
        ]);
        $this->assertDatabaseHas('allergen_item', [
            'allergen_id' => $allergen_milk->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_allergenCopy()
    {
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $item_en = Item::create([
            'lang' => 'en_US',
            'item_name' => 'hogehoge',
            'item_key' => 'hoge',
            'item_desc' => 'hogehoge desc',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $allergen_egg = Allergen::find(1);
        $allergen_milk = Allergen::find(5);
        $item->allergenSet([$allergen_egg->id, $allergen_milk->id]);
        $item_en->allergenCopy([$allergen_egg->id, $allergen_milk->id], 'en_US');
        
        $this->assertDatabaseHas('allergen_item', [
            'allergen_id' => 2,
            'item_id' => $item_en->id,
        ]);
        $this->assertDatabaseHas('allergen_item', [
            'allergen_id' => 6,
            'item_id' => $item_en->id,
        ]);
    }

    public function test_allergenIds()
    {
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $allergen_egg = Allergen::find(1);
        $allergen_milk = Allergen::find(5);
        $item->allergenSet([$allergen_egg->id, $allergen_milk->id]);
        
        $this->assertSame($item->allergenIds(), [
            $allergen_egg->id,
            $allergen_milk->id
        ]);
    }

    public function test_jp1()
    {
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $this->assertSame($item->jp(), $item);
    }

    public function test_jp2()
    {
        $item = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $item_en = Item::create([
            'lang' => 'en_US',
            'item_name' => 'hogehoge',
            'item_key' => 'hoge',
            'item_desc' => 'Item desc',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $this->assertEquals($item_en->jp(), Item::find($item->id));
    }

    public function test_getHashAttribute()
    {
        $hoge_jp = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $hige_jp = Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ひげひげ',
            'item_key' => 'hige',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $hoge_en = Item::create([
            'lang' => 'en_US',
            'item_name' => 'hogehoge',
            'item_key' => 'hoge',
            'item_desc' => 'Item desc',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ]);
        $this->assertSame($hoge_jp->hash, $hoge_en->hash);
        $this->assertNotSame($hoge_jp->hash, $hige_jp->hash);
    }
}
