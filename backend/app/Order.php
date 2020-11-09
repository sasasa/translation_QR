<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    protected $fillable = [
        'seat_session_id',
        'item_id',
        'item_jp_id',
        'order_state',
        'order_price',
        'is_take_out',
        'tax_rate',
        'sales_tax',
        'tax_included_price',
    ];

    // ステータス（=リスト登録中（注文前）, preparation=準備中, delivered=お届け後, cancel=キャンセル）
    // 席の状態
    public static $order_states = [
        'preparation' => '準備中',
        'delivered' => 'お届け済み',
        'cancel' => 'キャンセル',
    ];

    public function item(): object
    {
        return $this->belongsTo('App\Item');
    }
    public function item_jp(): object
    {
        return $this->belongsTo('App\Item', 'item_jp_id');
    }

    public function seatSession(): object
    {
        return $this->belongsTo('App\SeatSession');
    }

    public function getStateJpAttribute(): string
    {
        return self::$order_states[$this->order_state]. '('. $this->order_state. ')';
    }

    public function getTakeOutJpAttribute(): string
    {
        if ($this->is_take_out)
        {
            return "テイクアウト";
        } else {
            return "店内飲食";
        }
    }

    public static function createByItem(\App\Item $item, 
                                        \App\SeatSession $seatSession,
                                        bool $is_take_out): ?Order
    {
        if ($item->is_out_of_stock) {
            // 時間差で在庫切れなら注文を受けない
            return null;
        }

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
        $order->takeout($is_take_out);
        $order->save();
        return $order;
    }

    public function takeout(bool $is_take_out): void
    {
        $this->is_take_out = $is_take_out;
        if( $is_take_out ) {
            // 消費税率
            $this->tax_rate = 0.08;
        } else {
            // 消費税率
            $this->tax_rate = 0.10;
        }
        $this->sales_tax = ceil(bcmul($this->item->item_price, $this->tax_rate, 1));
        $this->tax_included_price = ceil(bcmul($this->item->item_price, 1 + $this->tax_rate, 1));
    }

    public static function orderedOrders(\App\SeatSession $seatSession): object
    {
        return self::whereIn('order_state', ['preparation', 'delivered'])->
                    where('seat_session_id', $seatSession->id)->with('item');
    }
}
