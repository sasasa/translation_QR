<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Arr;

class ApiItemIdsTest extends TestCase
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

    public function test_item_ids()
    {
        $hoge_jp_attr = [
            'lang' => 'ja_JP',
            'item_name' => 'ほげほげ',
            'item_key' => 'hoge',
            'item_desc' => 'アイテム詳細',
            'item_order' => '10',
            'item_price' => '1000',
            'genre_id' => '1',
            'image_path' => 'hoge.jpg',
        ];
        $hoge_jp = \App\Item::create($hoge_jp_attr);
        
        $response = $this->json('POST', '/api/item_ids', [
            'itemIDs' => [$hoge_jp->id],
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(['items' => [
                Arr::except($hoge_jp_attr, ['lang', 'item_key', 'item_order', 'genre_id'])
            ]]);
    }
}
