<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Arr;

class ApiJsonPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    public function test_json_payment()
    {
        $seat = new \App\Seat([
            'seat_name' => 'S1',
            'seat_state' => 'empty',
            'how_many' => 4,
        ]);
        $seat->set_hash();
        $seat->save();

        $session = new \App\SeatSession();
        $session->session_state = "in_use";
        $session->seat_id = $seat->id;
        $session->set_hash();
        $session->save();

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
        \App\Order::create([
            'seat_session_id' => $session->id,
            'item_id' => $item->id,
            'item_jp_id' => $item->id,
            'order_state' => 'preparation',
            'order_price' => $item->item_price,
            'is_take_out' => false,
            'tax_rate' => 0.1,
            'sales_tax' => ceil(bcmul($item->item_price, 0.1, 1)),
            'tax_included_price' => ceil(bcmul($item->item_price, 1.1, 1)),
        ]);
        $ordered_orders = \App\Order::whereIn('order_state', ['preparation', 'delivered'])->
                                    where('seat_session_id', $session->id)->with('item')->get();

        $response = $this->json('POST', '/api/json_payment', [
            'seat_hash' => $seat->seat_hash,
            'session_key' => $session->session_key,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'ordered_orders' => $ordered_orders->groupBy('is_take_out')->map(function($ary) {
                    return $ary->groupBy('item.item_name');
                })->toArray(),
                'all_items' => '1',
                'all_price' => '1100',
            ]);
    }
}
