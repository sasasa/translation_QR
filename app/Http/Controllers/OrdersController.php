<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdersController extends Controller
{

    public function index()
    {
        // dd(Carbon::today());
        return view('orders.index', [
        ]);
    }

    public function json_orders()
    {
        $two_hour_ago = Carbon::now()->subHours(2)->toTimeString();
        // 2時間前からの注文のみ取得
        return response()->json([
            'order_states' => \App\Order::$order_states,
            'orders' => \App\Order::orderBy('id', 'DESC')->
                whereDate('created_at', '>=', Carbon::today())->
                whereTime('created_at', '>=', $two_hour_ago)->
                with(['item_jp', 'seatSession.seat'])->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $req)
    {
        $seat = \App\Seat::where('seat_hash', $req->seat_hash)->first();
        if (!$seat)
        {
            return false;
        }
        $seatSession = $seat->seatSession;
        if ($seatSession->session_key != $req->session_key)
        {
            return false;
        }

        $ret = [];
        \DB::beginTransaction();
        try {
            collect($req->cart)->each(function ($val, $idx) use($seatSession, $req, &$ret){
                foreach ($val as $id => $number) {
                    $item = \App\Item::findOrFail($id);
                    for($i=1; $i<=$number; $i++){
                        $order = \App\Order::createByItem($item, $seatSession, $req);
                        if($order->is_take_out) {
                            $key = $order->item->item_name. '(ID'. $order->id. ')'. \Lang::get('message.takeout', [], $req->lang);
                        } else {
                            $key = $order->item->item_name. '(ID'. $order->id. ')';
                        }

                        $ret[$key] = $order->tax_included_price;
                    }
                }
            });
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }

        return [
            'messages' => $ret,
            'ordered_orders' => $seatSession->orders,
        ];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function takeout(Request $req, \App\Order $order)
    {
        $order->takeout($req);
        $order->save();
        if( $req->is_take_out ) {
            // 消費税率
            $takeout = 'テイクアウト';
        } else {
            // 消費税率
            $takeout = '店内飲食';
        }        
        return [
            'updated_at' => $order->updated_at,
            'message' => $order->item_jp->item_name.
                '(ID'.$order->id.')を'. $takeout. 'に更新しました',
        ];
    }

    public function update(Request $req, \App\Order $order)
    {
        $order->order_state = $req->order_state;
        $order->save();
        return [
            'updated_at' => $order->updated_at,
            'message' => $order->item_jp->item_name.
                '(ID'.$order->id.')を'. $order->state_jp. 'に更新しました',
        ];
    }

    public function destroy($id)
    {
        //
    }
}
