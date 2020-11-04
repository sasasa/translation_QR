<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Item;
use App\SeatSession;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use ArraySimilarTrait;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    public function test_getStateJpAttribute()
    {
        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => 1,
            'item_jp_id' => 1,
            'order_state' => 'preparation',
            'order_price' => 100,
            // テイクアウトかどうか
            'is_take_out' => true,
            // 消費税率
            'tax_rate' => 0.08,
            // 消費税額
            'sales_tax' => ceil(bcmul(100, 0.08, 1)),
            // 税込み金額
            'tax_included_price' => ceil(bcmul(100, 1.08, 1)),
        ]);
        
        $this->assertSame($order->state_jp, '準備中(preparation)');
        $this->assertSame($order->takeOut_jp, 'テイクアウト');
    }

    public function test_getTakeOutJpAttribute()
    {
        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => 1,
            'item_jp_id' => 1,
            'order_state' => 'preparation',
            'order_price' => 100,
            // テイクアウトかどうか
            'is_take_out' => true,
            // 消費税率
            'tax_rate' => 0.08,
            // 消費税額
            'sales_tax' => ceil(bcmul(100, 0.08, 1)),
            // 税込み金額
            'tax_included_price' => ceil(bcmul(100, 1.08, 1)),
        ]);

        $this->assertSame($order->takeOut_jp, 'テイクアウト');
    }

    public function test_createByItem1()
    {
        $item = \App\Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
            'is_out_of_stock' => true,
        ]);
        $session = new \App\SeatSession();
        $session->session_state = "in_use";
        $session->seat_id = 1;
        $session->set_hash();
        $session->save();
        $is_take_out = true;

        $order = \App\Order::createByItem($item, $session, $is_take_out);
        $this->assertNull($order);
    }

    public function test_createByItem2()
    {
        $item = \App\Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
            'is_out_of_stock' => false,
        ]);
        $session = new \App\SeatSession();
        $session->session_state = "in_use";
        $session->seat_id = 1;
        $session->set_hash();
        $session->save();
        $is_take_out = true;

        $order = \App\Order::createByItem($item, $session, $is_take_out);
        
        $this->assertSame($order->item->id, $item->id);
        $this->assertSame($order->seatSession->id, $session->id);
        
        $this->assertDatabaseHas('orders', [
            'seat_session_id' => $session->id,
            'item_id' => $item->id,
            'item_jp_id' => $item->id,
            'order_state' => 'preparation',
            'order_price' => $item->item_price,
            'is_take_out' => $is_take_out,
            'tax_rate' => 0.08,
            'sales_tax' => ceil(bcmul($item->item_price, 0.08, 1)),
            'tax_included_price' => ceil(bcmul($item->item_price, 1.08, 1)),
        ]);
    }

    public function test_takeout1()
    {
        $item = \App\Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
            'is_out_of_stock' => false,
        ]);
        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => $item->id,
            'item_jp_id' => $item->id,
            'order_state' => 'preparation',
            'order_price' => 1000,
            'is_take_out' => false,
            'tax_rate' => 0.01,
            'sales_tax' => ceil(bcmul($item->item_price, 0.01, 1)),
            'tax_included_price' => ceil(bcmul($item->item_price, 1.01, 1)),
        ]);
        $is_take_out = true;
        $order->takeout($is_take_out);

        $this->assertSame($order->is_take_out, $is_take_out);
        $this->assertSame($order->tax_rate, 0.08);
        $this->assertSame($order->sales_tax, ceil(bcmul($item->item_price, 0.08, 1)));
        $this->assertSame($order->tax_included_price, ceil(bcmul($item->item_price, 1.08, 1)));
    }

    public function test_takeout2()
    {
        $item = \App\Item::create([
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
            'is_out_of_stock' => false,
        ]);
        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => $item->id,
            'item_jp_id' => $item->id,
            'order_state' => 'preparation',
            'order_price' => $item->item_price,
            'is_take_out' => true,
            'tax_rate' => 0.001,
            'sales_tax' => ceil(bcmul($item->item_price, 0.001, 1)),
            'tax_included_price' => ceil(bcmul($item->item_price, 1.001, 1)),
        ]);
        $is_take_out = false;
        $order->takeout($is_take_out);

        $this->assertSame($order->is_take_out, $is_take_out);
        $this->assertSame($order->tax_rate, 0.1);
        $this->assertSame($order->sales_tax, ceil(bcmul($item->item_price, 0.1, 1)));
        $this->assertSame($order->tax_included_price, ceil(bcmul($item->item_price, 1.1, 1)));
    }

    public function test_item_and_item_jp()
    {
        $array1 = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'hoge.jpg',
        ];
        $item1 = Item::create($array1);
        $array2 = [
            'lang' => 'ja_JP',
            'item_name' => 'もげもげ',
            'item_key' => 'moge',
            'item_desc' => 'アイテム詳細',
            'item_order' => 10,
            'item_price' => 1000,
            'genre_id' => 1,
            'image_path' => 'moge.jpg',
        ];
        $item2 = Item::create($array2);
        $order = \App\Order::create([
            'seat_session_id' => 1,
            'item_id' => $item1->id,
            'item_jp_id' => $item1->id,
            'order_state' => 'preparation',
            'order_price' => $item1->item_price,
            // テイクアウトかどうか
            'is_take_out' => true,
            // 消費税率
            'tax_rate' => 0.08,
            // 消費税額
            'sales_tax' => ceil(bcmul(100, 0.08, 1)),
            // 税込み金額
            'tax_included_price' => ceil(bcmul(100, 1.08, 1)),
        ]);
        
        $this->assertNotNull($order->item);
        $this->assertSame($order->item->id, $item1->id);
        $this->assertSame($order->item_jp->id, $item1->id);
        $order->item_id = $item2->id;
        $order->item_jp_id = $item2->id;
        $order->save();
        $order->refresh();
        $this->assertSame($order->item->id, $item2->id);
        $this->assertSame($order->item_jp->id, $item2->id);
    }

    public function test_seatSession()
    {
        $session = new SeatSession([
            'session_state' => "in_use",
            'seat_id' => 1
        ]);
        $session->set_hash();
        $session->save();

        $order = \App\Order::create([
            'seat_session_id' => $session->id,
            'item_id' => 1,
            'item_jp_id' => 1,
            'order_state' => 'preparation',
            'order_price' => 1000,
            // テイクアウトかどうか
            'is_take_out' => true,
            // 消費税率
            'tax_rate' => 0.08,
            // 消費税額
            'sales_tax' => ceil(bcmul(100, 0.08, 1)),
            // 税込み金額
            'tax_included_price' => ceil(bcmul(100, 1.08, 1)),
        ]);
        $this->assertNotNull($order->seatSession);
        $this->assertSame($order->seatSession->id, $session->id);
    }
}
