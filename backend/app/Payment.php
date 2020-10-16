<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // ステータス（=リスト登録中（注文前）, preparation=準備中, printing=プリント中, afterpaying=清算後）
    public static $payment_states = [
        'preparation' => '準備中',
        'printing' => 'プリント中',
        'afterpaying' => '清算後',
    ];

    public function getStateJpAttribute()
    {
        return self::$payment_states[$this->payment_state]. '('. $this->payment_state. ')';
    }

    public function seatSession()
    {
        return $this->belongsTo('App\SeatSession');
    }
}
