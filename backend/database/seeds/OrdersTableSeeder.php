<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 一つも買われない商品
        $items = \App\Item::whereNotIn('id', [1, 2, 3, 4])->get();
        \App\SeatSession::all()->each(function(\App\SeatSession $seatSession) use($items){
            $order_num = mt_rand(2, 12);
            $is_take_out = mt_rand(0, 1);
            $items->random($order_num)->each(function(\App\Item $item) use($seatSession, $is_take_out){

                if ($is_take_out) {
                    DB::table('orders')->insert([
                        'seat_session_id' => $seatSession->id,
                        'item_id' => $item->id,
                        'item_jp_id' => $item->jp()->id,
                        'order_state' => 'preparation',
                        'order_price' => $item->item_price,
                        // テイクアウトかどうか
                        'is_take_out' => true,
                        // 消費税率
                        'tax_rate' => 0.08,
                        // 消費税額
                        'sales_tax' => ceil(bcmul($item->item_price, 0.08, 1)),
                        // 税込み金額
                        'tax_included_price' => ceil(bcmul($item->item_price, 1.08, 1)),
                        'created_at' => $seatSession->created_at,
                        'updated_at' => $seatSession->created_at,
                    ]);
                } else {
                    DB::table('orders')->insert([
                        'seat_session_id' => $seatSession->id,
                        'item_id' => $item->id,
                        'item_jp_id' => $item->jp()->id,
                        'order_state' => 'preparation',
                        'order_price' => $item->item_price,
                        // テイクアウトかどうか
                        'is_take_out' => false,
                        // 消費税率
                        'tax_rate' => 0.1,
                        // 消費税額
                        'sales_tax' => ceil(bcmul($item->item_price, 0.1, 1)),
                        // 税込み金額
                        'tax_included_price' => ceil(bcmul($item->item_price, 1.1, 1)),
                        'created_at' => $seatSession->created_at,
                        'updated_at' => $seatSession->created_at,
                    ]);
                }
            });
            $sum = $seatSession->orders->map(function(\App\Order $order){
                return $order->tax_included_price;
            })->sum();
            $payment = new \App\Payment();
            $payment->insert([
                'tax_included_price' => $sum,
                'seat_session_id' => $seatSession->id,
                'created_at' => $seatSession->created_at,
                // 'created_at' => now(),
                'updated_at' => $seatSession->created_at,
                // 'updated_at' => now(),
            ]);
        });
    }
}
