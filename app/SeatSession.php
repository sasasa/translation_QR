<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SeatSession extends Model
{
    protected $fillable = [
        'session_state',
        'seat_id',
    ];
    // 席の状態
    public static $session_states = [
        'in_use' => '利用中',
        'end_of_use' => '利用終了',
    ];

    public function seat()
    {
        return $this->belongsTo('App\Seat');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getstateJpAttribute()
    {
        return self::$session_states[$this->session_state]. '('. $this->session_state. ')';
    }

    public function set_hash()
    {
        $this->session_key = hash('sha256', Uuid::uuid4());
    }
}
