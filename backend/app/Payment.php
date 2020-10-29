<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'seat_session_id',
        'tax_included_price',
        'payment_state',
    ];

    // ステータス（=リスト登録中（注文前）, preparation=準備中, printing=プリント中, afterpaying=精算後）
    public static $payment_states = [
        'preparation' => '準備中',
        'printing' => 'プリント中',
        'afterpaying' => '精算後',
    ];

    public function getStateJpAttribute(): string
    {
        return self::$payment_states[$this->payment_state]. '('. $this->payment_state. ')';
    }

    public function seatSession(): object
    {
        return $this->belongsTo('App\SeatSession');
    }
}
