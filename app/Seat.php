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
        'how_many',
    ];
    // 席の状態
    public static $seat_states = [
        'empty' => '空き',
        'presence' => '使用中',
    ];

    public function seatSessions()
    {
        return $this->hasMany('App\SeatSession');
    }
    public function seatSession()
    {
        // return $this->seatSessions()->orderBy('id', 'DESC')->first();
        return $this->hasOne('App\SeatSession')->orderBy('id', 'DESC');
    }

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

    public function createSession()
    {
        // 'in_use' => '利用中',
        // 'end_of_use' => '利用終了',
        if( $this->seatSession && $this->seatSession->session_state == "in_use" ) {
            // セッションはすでに開始されている
            return $this->seatSession->session_key;
        } else {
            $session = new \App\SeatSession();
            $session->session_state = "in_use";
            $session->seat_id = $this->id;
            $session->set_hash();
            $session->save();
            return $session->session_key;
        }
    }
}
