<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Allergen;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllergenTest extends TestCase
{
    use RefreshDatabase;

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
        $this->assertSame($allergen->Lang_jp, '日本語(ja_JP)');
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
        $this->assertSame($allergen_jp->Name_jp, $allergen_jp->allergen_name);
        $this->assertSame($allergen_en->Name_jp, $allergen_jp->allergen_name);
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
}
