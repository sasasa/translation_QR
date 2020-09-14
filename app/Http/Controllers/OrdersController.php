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
        // 2時間 前からの注文のみ取得
        $two_hour_ago = Carbon::now()->subHours(2)->toTimeString();
        // 30分 前のお会計のみ取得
        $thirty_minute_ago = Carbon::now()->subMinutes(30)->toTimeString();
        return response()->json([
            'order_states' => \App\Order::$order_states,
            'payment_states' => \App\Payment::$payment_states,
            'orders' => \App\Order::orderBy('id', 'DESC')->
                whereDate('created_at', '>=', Carbon::today())->
                whereTime('created_at', '>=', $two_hour_ago)->
                with(['item_jp', 'seatSession.seat'])->get(),

            'payments' => \App\Payment::orderBy('id', 'DESC')->
                whereDate('created_at', '>=', Carbon::today())->
                whereTime('created_at', '>=', $thirty_minute_ago)->
                with(['seatSession.seat'])->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function print(\App\SeatSession $seatSession)
    {
        $ordered_orders = \App\Order::where('seat_session_id', $seatSession->id)->with('item')->get();
        $all_price = $ordered_orders->map(function($order) {
            return $order->tax_included_price;
        })->sum();
        return view('orders.print', [
            'seatSession' => $seatSession,
            'ordered_orders' => $ordered_orders,
            'all_items' => $ordered_orders->count(),
            'all_price' => $all_price,
            'time' => $seatSession->payment->created_at,
            'now' => now(),
        ]);
    }

    public function pay(Request $req)
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

        return [
            'ok' => true,
        ];
    }


    public function json_ordered_orders(Request $req, $seat_hash, $lang)
    {
        $seat = \App\Seat::where('seat_hash', $seat_hash)->first();
        if (!$seat)
        {
            return false;
        }
        $seatSession = $seat->seatSession;
        if ($seatSession->session_key != $req->session_key)
        {
            return false;
        }

        \DB::beginTransaction();
        try {
            $seat->seat_state = 'empty';
            $seat->save();
            $seatSession->session_state = 'end_of_use';
            $seatSession->save();

            $ordered_orders = \App\Order::where('seat_session_id', $seatSession->id)->with('item')->get();
            $sum_tax_included_price = $ordered_orders->map(function ($order, $key) {
                return $order->tax_included_price;
            })->sum();
            $payment = new \App\Payment();
            $payment->tax_included_price = $sum_tax_included_price;
            $payment->seat_session_id = $seatSession->id;
            $payment->save();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }

        return response()->json([
            'ordered_orders' => $ordered_orders,
        ]);
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

        return [
            'updated_at' => $order->updated_at,
            'message' => $order->item_jp->item_name.
                '(ID'.$order->id.')を'. $order->take_out_jp. 'に更新しました',
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
