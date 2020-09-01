<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function seatSession()
    {
        return $this->belongsTo('App\SeatSession');
    }

    public static function createByItem($item, $seatSession, $req)
    {
        $order = new \App\Order();
        $order->seat_session_id = $seatSession->id;
        $order->item_id = $item->id;
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
