<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Arr;

class ApiJsonItemsTest extends TestCase
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

    public function test_json_items()
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
        
        $genre_jp_attr = [
            'genre_key' => 'hige',
            'genre_name' => 'ひげひげ',
            'lang' => 'ja_JP',
            'genre_order' => 1,
        ];
        $genre_jp = \App\Genre::create($genre_jp_attr);
        $hoge_jp_attr = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => '10',
            'item_price' => '1000',
            'genre_id' => $genre_jp->id,
            'image_path' => 'hoge.jpg',
        ];
        \App\Item::create($hoge_jp_attr);
        
        $response = $this->json('POST', '/api/json_items', [
            'seat_hash' => $seat->seat_hash,
            'session_key' => $session->session_key,
            'lang' => 'ja',
            'genre' => 'hige',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['items' => [
                Arr::except($hoge_jp_attr, ['lang', 'item_key', 'item_order', 'genre_id'])
            ]])
            ->assertJson(['genres' => [$genre_jp_attr]])
            ->assertJson(['ordered_orders' => []]);
            
    }
}
