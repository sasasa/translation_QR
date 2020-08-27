<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Endroid\QrCode\QrCode;
use Ramsey\Uuid\Uuid;

class Seat extends Model
{
    public static $rules = [
        'seat_name' => 'required|max:20|unique:seats,seat_name',
    ];
    public static $update_rules = [
        'seat_name' => 'required|max:20',
    ];
    
    protected $fillable = [
        'seat_name',
    ];
    // 席の状態
    public static $seat_states = [
        'empty' => '清算が終わり、席に誰も着いていない',
        'presence' => '席に着いて注文中',
        'waiting' => '出ていない料理が一つでもある',
        'all_out' => '料理が全て出ている',
    ];

    public function getstateJpAttribute()
    {
        return self::$seat_states[$this->seat_state]. '('. $this->seat_state. ')';
    }

    public function getqrCodeAttribute()
    {
        return new QrCode(env('APP_URL', '') .'/'. $this->seat_hash .'/ja/drink/items/');
    }

    public function set_hash()
    {
        $this->seat_hash = hash('sha256', Uuid::uuid4());
    }
}
