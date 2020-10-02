<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    // API
    public function update(Request $req, \App\Payment $payment)
    {
        $payment->payment_state = $req->payment_state;
        $payment->save();
        $seat = $payment->seatSession->seat;
        if ($payment->payment_state == 'afterpaying') {
            $seat->seat_state = 'empty';
            $seat->save();
        } else {
            $seat->seat_state = 'payment';
            $seat->save();
        }
        return [
            'updated_at' => $payment->updated_at,
            'message' => $seat->seat_name.
                '(ID'.$payment->id.')を'. $payment->state_jp. 'に更新しました',
        ];
    }


    public function destroy($id)
    {
        //
    }
}
