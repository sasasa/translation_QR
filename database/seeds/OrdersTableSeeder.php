<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = \App\Item::find(1);
        $seat_session_ID = \App\SeatSession::max('id');

        DB::table('orders')->insert([
            'seat_session_id' => $seat_session_ID,
            'item_id' => 1,
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

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
