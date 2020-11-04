<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
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
        $payment = \App\Payment::create([
            'seat_session_id' => 1,
            'tax_included_price' => 1000,
            'payment_state' => 'preparation',
        ]);
        $this->assertSame($payment->state_jp, '準備中(preparation)');
    }
}
