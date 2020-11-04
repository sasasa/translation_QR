<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Payment;
use App\SeatSession;

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
        $payment = Payment::create([
            'seat_session_id' => 1,
            'tax_included_price' => 1000,
            'payment_state' => 'preparation',
        ]);
        $this->assertSame($payment->state_jp, '準備中(preparation)');
    }

    public function test_seatSession()
    {
        $session = new SeatSession([
            'session_state' => "in_use",
            'seat_id' => 1
        ]);
        $session->set_hash();
        $session->save();

        $payment = Payment::create([
            'seat_session_id' => $session->id,
            'tax_included_price' => 1000,
            'payment_state' => 'preparation',
        ]);
        $this->assertNotNull($payment->seatSession);
        $this->assertSame($payment->seatSession->id, $session->id);
    }
}
