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

    public function update(Request $req, \App\Payment $payment)
    {
        $payment->payment_state = $req->payment_state;
        $payment->save();
        return [
            'updated_at' => $payment->updated_at,
            'message' => $payment->seatSession->seat->seat_name.
                '(ID'.$payment->id.')を'. $payment->state_jp. 'に更新しました',
        ];
    }


    public function destroy($id)
    {
        //
    }
}
