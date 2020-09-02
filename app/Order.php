<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    // ステータス（=リスト登録中（注文前）, preparation=準備中, delivered=お届け後, cancel=キャンセル）
    // 席の状態
    public static $order_states = [
        'preparation' => '準備中',
        'delivered' => 'お届け済み',
        'cancel' => 'キャンセル',
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function item_jp()
    {
        
        return $this->belongsTo('App\Item', 'item_jp_id');
    }

    public function seatSession()
    {
        return $this->belongsTo('App\SeatSession');
    }

    public function getstateJpAttribute()
    {
        return self::$order_states[$this->order_state]. '('. $this->order_state. ')';
    }
    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::parse($date)->format('Y-m-d H:i:s');
    // }
    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::parse($date)->format('Y-m-d H:i:s');
    // }

    public static function createByItem($item, $seatSession, $req)
    {
        $order = new \App\Order();
        $order->seat_session_id = $seatSession->id;
        $order->item_id = $item->id;

        if ($item->lang !== 'ja_JP') {
            // 日本語メニューでないときは検索する
            $order->item_jp_id = \App\Item::where('item_key', $item->item_key)->where('lang', 'ja_JP')->first()->id;
        } else {
            $order->item_jp_id = $item->id;
        }

        $order->order_price = $item->item_price;
        $order->is_take_out = $req->is_take_out;
        if( $req->is_take_out ) {
            // 消費税率
            $order->tax_rate = 0.08;
        } else {
            // 消費税率
            $order->tax_rate = 0.10;
        }
        $order->sales_tax = ceil(bcmul($item->item_price, $order->tax_rate, 1));
        $order->tax_included_price = ceil(bcmul($item->item_price, 1 + $order->tax_rate, 1));
        $order->save();
        return $order;
    }
}
