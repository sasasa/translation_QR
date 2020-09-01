<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        return view('orders.index', [
        ]);
    }

    public function json_orders()
    {
        return response()->json([
            'order_states' => \App\Order::$order_states,
            'orders' => \App\Order::orderBy('id', 'DESC')->with(['item', 'seatSession.seat'])->get(),
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
                        $ret[$order->item->item_name. '(ID'. $order->id. ')'] = $order->tax_included_price;
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
