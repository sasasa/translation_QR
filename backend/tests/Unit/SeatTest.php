<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Endroid\QrCode\QrCode;

class SeatTest extends TestCase
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
        $seat = new \App\Seat([
            'seat_name' => 'S1',
            'seat_state' => 'empty',
            'how_many' => 4,
        ]);
        $seat->set_hash();
        $seat->save();
        
        $this->assertSame($seat->state_jp, '空き(empty)');
    }

    public function test_getQrCodeAttribute()
    {
        $seat = new \App\Seat([
            'seat_name' => 'S1',
            'seat_state' => 'empty',
            'how_many' => 4,
        ]);
        $seat->set_hash();
        $seat->save();

        $this->assertIsObject($seat->qrCode);
        $this->assertInstanceOf(QrCode::class, $seat->qrCode);
        $this->assertInstanceOf(QrCode::class, $seat->qr_code);
    }
    
    public function test_set_hash()
    {
        $seat = new \App\Seat([
            'seat_name' => 'S1',
            'seat_state' => 'empty',
            'how_many' => 4,
        ]);
        $this->assertNull($seat->seat_hash);
        $seat->set_hash();
        $seat->save();

        $this->assertIsString($seat->seat_hash);
    }

    public function test_createSession1()
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

        $this->assertSame($seat->createSession(), $session->session_key);
    }

    public function test_createSession2()
    {
        $seat = new \App\Seat([
            'seat_name' => 'S1',
            'seat_state' => 'empty',
            'how_many' => 4,
        ]);
        $seat->set_hash();
        $seat->save();

        $session1 = new \App\SeatSession();
        $session1->session_state = "end_of_use";
        $session1->seat_id = $seat->id;
        $session1->set_hash();
        $session1->save();

        $session2 = new \App\SeatSession();
        $session2->session_state = "end_of_use";
        $session2->seat_id = $seat->id;
        $session2->set_hash();
        $session2->save();
        
        $this->assertNotSame($seat->createSession(), $session1->session_key);
        $this->assertNotSame($seat->createSession(), $session2->session_key);
        $this->assertNotSame($seat->seat_state, 'empty');
        $this->assertSame($seat->seat_state, 'presence');
    }

    public function test_forSelect()
    {
        $this->seed('SeatsTableSeeder');
        $ret = ['' => '座席を選択してください',];
        \App\Seat::orderBy('id', 'ASC')->each(function($seat) use(&$ret){
            $ret[$seat->seat_hash] = $seat->seat_name;
        });

        $this->assertArraySimilar(\App\Seat::forSelect(), $ret);
    }
}
