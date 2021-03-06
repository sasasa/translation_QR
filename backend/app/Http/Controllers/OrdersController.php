<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\SeatCheckable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\Collection;
use PayPay\OpenPaymentAPI\Client;
use PayPay\OpenPaymentAPI\Models\CreateQrCodePayload;

class OrdersController extends Controller
{
    use SeatCheckable;

    public function index()
    {
        // dd(Carbon::today());
        return view('orders.index', [
        ]);
    }

    // API
    public function json_ordered_orders(Request $req)
    {
        [$seat, $seatSession] = $this->seatCheck($req->session_key, $req->seat_hash);
        if(!$seatSession) {
            return false;
        }

        return response()->json([
            'ordered_orders' => $seatSession->orders,
        ]);
    }

    // API
    public function json_orders()
    {
        // 2時間前
        $two_hour_ago = Carbon::now()->subHours(2)->toTimeString();
        // 30分前
        // $thirty_minute_ago = Carbon::now()->subMinutes(30)->toTimeString();

        return response()->json([
            'order_states' => \App\Order::$order_states,
            'payment_states' => \App\Payment::$payment_states,
            'orders' => \App\Order::orderBy('id', 'DESC')->
                whereDate('created_at', '>=', Carbon::today())->
                whereTime('created_at', '>=', $two_hour_ago)->
                with(['item_jp', 'seatSession.seat'])->get(),

            'payments' => \App\Payment::orderBy('id', 'DESC')->
                whereDate('created_at', '>=', Carbon::today())->
                whereTime('created_at', '>=', $two_hour_ago)->
                with(['seatSession.seat'])->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function print(\App\SeatSession $seatSession)
    {
        $ordered_orders = \App\Order::whereIn('order_state', ['preparation', 'delivered'])->
                                    where('seat_session_id', $seatSession->id)->with('item_jp')->get();
        $all_price = $ordered_orders->map(function(\App\Order $order) {
            return $order->tax_included_price;
        })->sum();

        return view('orders.print', [
            'seatSession' => $seatSession,
            'ordered_orders' => $ordered_orders->groupBy('is_take_out')->map(function(Collection $ary) {
                return $ary->groupBy('item_jp.item_name');
            }),
            'all_items' => $ordered_orders->count(),
            'all_price' => $all_price,
            'time' => $seatSession->payment->created_at,
            'now' => now(),
        ]);
    }

    public function paypay(Request $req)
    {
        [$seat, $seatSession] = $this->seatCheck($req->session_key, $req->seat_hash);
        if(!$seatSession) {
            return false;
        }
        $ordered_orders = \App\Order::orderedOrders($seatSession)->get();

        $sum_tax_included_price = $ordered_orders->map(function(\App\Order $order) {
            return $order->tax_included_price;
        })->sum();

        $client = new Client([
            'API_KEY' => env('PAYPAY_API_KEY', 'Laravel'),
            'API_SECRET'=> env('PAYPAY_API_SECRET', 'Laravel'),
            'MERCHANT_ID' => env('PAYPAY_MERCHANT_ID', 'Laravel')
        ], false);
        // dd($client);

        $payload = new CreateQrCodePayload();
        $payload->setMerchantPaymentId("my_payment_id" . \time());
        $payload->setCodeType("ORDER_QR");
        $amount = [
            "amount" => $sum_tax_included_price,
            "currency" => "JPY"
        ];
        $payload->setAmount($amount);
        $payload->setOrderDescription('画面を確認しますのでお支払い後そのままお待ちください');
        $payload->setRedirectType('WEB_LINK');
        $payload->setRedirectUrl(env('APP_URL', '') .'/'.
                                $req->seat_hash .'/items#/thanks/'. $req->lang. '/paypay');
        $payload->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1');

        //=================================================================
        // Calling the method to create a qr code
        //=================================================================
        $response = $client->code->createQRCode($payload);
        // 処理がうまくいってなかったら抜ける
        if($response['resultInfo']['code'] !== 'SUCCESS') {
            return;
        } else {
            $this->paymentTransaction($seat, $req);

            return [
                'ok' => true,
                'redirectUrl' => $response['data']['url'],
            ];
        }
    }

    // API
    public function pay(Request $req)
    {
        [$seat, $seatSession] = $this->seatCheck($req->session_key, $req->seat_hash);
        if(!$seatSession) {
            return false;
        }

        return [
            'ok' => true,
        ];
    }

    private function paymentTransaction(\App\Seat $seat, Request $req)
    {
        DB::beginTransaction();
        try {
            $seat->seat_state = 'payment';
            $seat->save();

            $seatSession = $seat->seatSession;
            $seatSession->session_state = 'end_of_use';
            $seatSession->save();

            $ordered_orders = \App\Order::orderedOrders($seatSession)->get();
            $sum_tax_included_price = $ordered_orders->map(function (\App\Order $order) {
                return $order->tax_included_price;
            })->sum();
            $payment = new \App\Payment();
            $payment->tax_included_price = $sum_tax_included_price;
            $payment->seat_session_id = $seatSession->id;
            if ($req->payment) {
                $payment->payment_state = 'paypay';
                $payment->is_paypay = true;
            }
            $payment->save();
            DB::commit();
        } catch (\Exception $e) {
            \Debugbar::info('----------------------------------');
            DB::rollback();
        }
        return [$ordered_orders, $sum_tax_included_price];
    }

    // API
    public function json_payment(Request $req)
    {
        [$seat, $seatSession] = $this->seatCheck($req->session_key, $req->seat_hash);
        if(!$seatSession) {
            return false;
        }
        if ($req->payment) {
            // paypay支払いなどの時はこのタイミングですでに席セッションは切れて次のセッションが始まっている。
            // よってひとつ前に存在しているセッションを取得しなければならない。
            $seatSession = \App\SeatSession::where('seat_id', $seat->id)->
                                                orderBy('id', 'DESC')->
                                                offset(1)->first();

            $ordered_orders = \App\Order::orderedOrders($seatSession)->get();
            $sum_tax_included_price = $ordered_orders->map(function (\App\Order $order) {
                return $order->tax_included_price;
            })->sum();
        } else {
            [$ordered_orders, $sum_tax_included_price] = $this->paymentTransaction($seat, $req);
        }

        return response()->json([
            'ordered_orders' => $ordered_orders->groupBy('is_take_out')->map(function(Collection $ary) {
                return $ary->groupBy('item.item_name');
            }),
            'all_items' => $ordered_orders->count(),
            'all_price' => $sum_tax_included_price,
        ]);
    }

    // API
    public function store(Request $req)
    {
        [$seat, $seatSession] = $this->seatCheck($req->session_key, $req->seat_hash);
        if(!$seatSession) {
            return false;
        }

        $ret = [];
        DB::beginTransaction();
        try {
            collect($req->cart)->each(function ($val) use($seatSession, $req, &$ret){
                foreach ($val as $id => $number) {
                    $item = \App\Item::findOrFail($id);
                    for($i=1; $i<=$number; $i++){
                        $order = \App\Order::createByItem($item, $seatSession, $req->is_take_out);

                        if ($order) {
                            if($order->is_take_out) {
                                $key = $order->item->item_name. '(ID'. $order->id. ')'. Lang::get('message.takeout', [], $req->lang);
                            } else {
                                $key = $order->item->item_name. '(ID'. $order->id. ')';
                            }
                            $ret[$key] = $order->tax_included_price;
                        } else {
                            $ret[$item->item_name. '('. Lang::get('message.sorry_out_of_stock', [], $req->lang). ')'] = 0;
                        }

                    }
                }
            });
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return [
            'messages' => $ret,
            'ordered_orders' => $seatSession->orders,
        ];
    }

    // API
    public function takeout(Request $req, \App\Order $order)
    {
        $order->takeout($req->is_take_out);
        $order->save();

        return [
            'updated_at' => $order->updated_at,
            'message' => $order->item_jp->item_name.
                '(ID'.$order->id.')を'. $order->take_out_jp. 'に更新しました',
        ];
    }

    // API
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

    public function aggregate(Request $req)
    {
        if( $req->search_start_at ) {
            $start_time = new Carbon($req->search_start_at);
        } else {
            $start_time = Carbon::today()->subYear();
        }
        if( $req->search_end_at ) {
            $end_time = new Carbon($req->search_end_at);
        } else {
            $end_time = Carbon::tomorrow();
        }

        if( $req->aggregate === 'sales' ) {
            $orders = \App\Order::select(DB::raw('sum(tax_included_price) as order_count, item_id'))->
                                groupBy('item_id')->with('item')->
                                whereDate('created_at', '>=', $start_time)->
                                whereDate('created_at', '<', $end_time)->get();
        } else {
            $orders = \App\Order::select(DB::raw('count(*) as order_count, item_id'))->
                                groupBy('item_id')->with('item')->
                                whereDate('created_at', '>=', $start_time)->
                                whereDate('created_at', '<', $end_time)->get();
        }
        $items = \App\Item::select('item_key')->distinct()->get()->map(function(\App\Item $item) {
            return $item->item_key;
        });

        Carbon::setWeekStartsAt(Carbon::SUNDAY); // 週の最初を日曜日に設定
        Carbon::setWeekEndsAt(Carbon::SATURDAY); // 週の最後を土曜日に設定
        $dt = Carbon::today();
        $last_week = Carbon::today()->subWeeks(1); // 前の週の曜日
        $last_month = Carbon::today()->subMonths(1); // 前の月の曜日

        return view('orders.aggregate', [
            'orders' => $orders->groupBy('item.item_key')->map(function(Collection $orders) {
                return $orders->map(function(\App\Order $order) {
                    return $order->order_count;
                })->sum();
            })->sortDesc(),
            'items' => $items,
            'aggregate' => $req->aggregate,

            'search_start_at' => str_replace(" ", "T", $start_time),
            'search_end_at' => str_replace(" ", "T", $end_time),

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
