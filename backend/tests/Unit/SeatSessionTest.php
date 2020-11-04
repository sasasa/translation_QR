<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeatSessionTest extends TestCase
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
        $session = new \App\SeatSession([
            'session_state' => "in_use",
            'seat_id' => 1
        ]);
        $session->set_hash();
        $session->save();

        $this->assertSame($session->stateJp, '利用中(in_use)');
        $this->assertSame($session->state_jp, '利用中(in_use)');
    }

    public function test_set_hash()
    {
        $session = new \App\SeatSession([
            'session_state' => "in_use",
            'seat_id' => 1
        ]);
        $this->assertNull($session->session_key);
        $session->set_hash();
        $session->save();
        $this->assertIsString($session->session_key);
    }
}
