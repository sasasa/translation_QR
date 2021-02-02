<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
        if ($req->payment_state === 'preparation' || $req->payment_state === 'printing') {
            $payment->is_paypay = false;
        } else if ($req->payment_state === 'paypay') {
            $payment->is_paypay = true;
        }

        $payment->payment_state = $req->payment_state;
        $payment->save();
        $seat = $payment->seatSession->seat;


        if ($payment->payment_state === 'afterpaying') {
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

    public function sum_total(Request $req)
    {
        if( $req->search_start_at ) {
            $start_time = new Carbon($req->search_start_at);
        } else {
            $start_time = Carbon::today();
        }
        if( $req->search_end_at ) {
            $end_time = new Carbon($req->search_end_at);
        } else {
            $end_time = Carbon::tomorrow();
        }

        $payment_query = \App\Payment::query();
        $payment_query->whereDate('created_at', '>=', $start_time)->whereDate('created_at', '<', $end_time);

        if ( $req->payment_service === "paypay" ) {
            $payment_service = "paypay";
            $payments = $payment_query->where('is_paypay', true)->paginate(100);

            $sum_sales = $payment_query->where('is_paypay', true)->sum('tax_included_price');

            $count = $payment_query->where('is_paypay', true)->count('tax_included_price');
        } else {
            $payment_service = "all";
            $payments = $payment_query->paginate(100);

            $sum_sales = $payment_query->sum('tax_included_price');

            $count = $payment_query->count('tax_included_price');
        }

        Carbon::setWeekStartsAt(Carbon::SUNDAY); // 週の最初を日曜日に設定
        Carbon::setWeekEndsAt(Carbon::SATURDAY); // 週の最後を土曜日に設定
        $dt = Carbon::today();
        $last_week = Carbon::today()->subWeeks(1); // 前の週の曜日
        $last_month = Carbon::today()->subMonths(1); // 前の月の曜日

        return view('payments.sum_total', [
            'search_start_at' => str_replace(" ", "T", $start_time),
            'search_end_at' => str_replace(" ", "T", $end_time),
            'payments' => $payments,
            'sum_sales' => $sum_sales,
            'count' => $count,
            'payment_service' => $payment_service,

            'yesterday' => str_replace(" ", "T", Carbon::yesterday()),
            'today' => str_replace(" ", "T", Carbon::today()),
            'tomorrow' => str_replace(" ", "T", Carbon::tomorrow()),

            'lastOfWeek' => str_replace(" ", "T", $last_week->startOfWeek()),
            'startOfWeek' => str_replace(" ", "T", $dt->startOfWeek()),
            'nextOfWeek' => str_replace(" ", "T", $dt->endOfWeek()->addSeconds(1)),

            'lastOfMonth' => str_replace(" ", "T", $last_month->startOfMonth()),
            'startOfMonth' => str_replace(" ", "T", Carbon::now()->startOfMonth()),
            'nextOfMonth' => str_replace(" ", "T", Carbon::now()->endOfMonth()->addSeconds(1)),

        ]);
    }
}
