<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Item;
use App\Allergen;
use App\Genre;

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

    public function test_genre()
    {
        $genre = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);

        $array = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ2',
            'item_key' => 'hoge2',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => $genre->id,
            'image_path' => 'hoge.jpg',
        ];
        $item = Item::create($array);
        $this->assertNotNull($item->genre);
        $this->assertSame($item->genre->id, $genre->id);
    }
    public function test_orders()
    {
        $array = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ];
        $item = Item::create($array);
        $this->assertCount(0, $item->orders->toArray());

        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => $item->id,
            'item_jp_id' => $item->id,
            'order_state' => 'preparation',
            'order_price' => $item->item_price,
            // テイクアウトかどうか
            'is_take_out' => true,
            // 消費税率
            'tax_rate' => 0.08,
            // 消費税額
            'sales_tax' => ceil(bcmul(100, 0.08, 1)),
            // 税込み金額
            'tax_included_price' => ceil(bcmul(100, 1.08, 1)),
        ]);

        $item->refresh();
        $this->assertCount(1, $item->orders->toArray());
    }
    public function test_allergens()
    {
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

        $allergen = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげ',
            'allergen_key' => 'hoge',
        ]);
        $this->assertCount(0, $item1->allergens->toArray());
        $item1->allergenSet([$allergen->id]);
        $item1->refresh();
        $this->assertCount(1, $item1->allergens->toArray());
    }

    public function test_scopeMySelect()
    {
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
        Item::create($array1);
        $item = Item::mySelect()->first();
        
        $this->assertArrayHasKey('id', $item->toArray());
        $this->assertArrayHasKey('image_path', $item->toArray());
        $this->assertArrayHasKey('item_name', $item->toArray());
        $this->assertArrayHasKey('item_price', $item->toArray());
        $this->assertArrayHasKey('item_desc', $item->toArray());
        $this->assertArrayHasKey('is_out_of_stock', $item->toArray());
        $this->assertArrayNotHasKey('genre_id', $item->toArray());
    }

    public function test_scopeWithAllergens()
    {
        $allergen = Allergen::create([
            'lang' => 'ja_JP',
            'allergen_name' => 'ほげ',
            'allergen_key' => 'hoge',
        ]);
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
        Item::create($array1);
        $item = Item::first();
        $item->allergenSet([$allergen->id]);
        $item = Item::withAllergens()->first();
        foreach($item->allergens->toArray() as $allergen) {
            $this->assertArrayHasKey('allergen_name', $allergen);
            $this->assertArrayHasKey('allergen_key', $allergen);
            $this->assertArrayNotHasKey('lang', $allergen);
        }
    }

    public function test_allForLangAndGenre()
    {
        $genre1 = Genre::create([
            'genre_key' => 'hoge',
            'genre_name' => 'ほげほげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ]);
        $genre2 = Genre::create([
            'genre_key' => 'moge',
            'genre_name' => 'もげもげ',
            'lang' => 'en_US',
            'genre_order' => 1,
        ]);

        $array1 = [
            'lang' => 'ja_JP',
            'item_name' => 'ひげひげ',
            'item_key' => 'hige',
            'item_desc' => 'アイテム詳細',
            'item_order' => 1000,
            'item_price' => 1000,
            'genre_id' => $genre1->id,
            'image_path' => 'hige.jpg',
        ];
        $item1 = Item::create($array1);
        $array2 = [
            'lang' => 'ja_JP',
            'item_name' => 'ぴよぴよ',
            'item_key' => 'piyo',
            'item_desc' => 'アイテム詳細',
            'item_order' => 100,
            'item_price' => 1000,
            'genre_id' => $genre1->id,
            'image_path' => 'piyo.jpg',
        ];
        $item2 = Item::create($array2);
        $array3 = [
            'lang' => 'en_US',
            'item_name' => 'piyopiyo',
            'item_key' => 'piyo',
            'item_desc' => 'アイテム詳細',
            'item_order' => 1000,
            'item_price' => 1000,
            'genre_id' => $genre2->id,
            'image_path' => 'piyo.jpg',
        ];
        $item3 = Item::create($array3);
        $array4 = [
            'lang' => 'ja_JP',
            'item_name' => 'とげとげ',
            'item_key' => 'toge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 100,
            'item_price' => 1000,
            'genre_id' => $genre1->id,
            'image_path' => 'toge.jpg',
        ];
        $item4 = Item::create($array4);

        $items = Item::allForLangAndGenre('ja', 'hoge')->get();
        // dd($items->toArray());
        $this->assertArraySimilar(
            $items->map(fn($item)=>$item->id)->toArray(),
            [$item1->id, $item4->id, $item2->id]
        );
    }
}
