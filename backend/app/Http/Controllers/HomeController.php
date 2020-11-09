<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPay\OpenPaymentAPI\Client;
use PayPay\OpenPaymentAPI\Models\CreateQrCodePayload;
use PayPay\OpenPaymentAPI\Models\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
        ]);
    }

    public function paypay()
    {
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
            "amount" => 1,
            "currency" => "JPY"
        ];
        $payload->setAmount($amount);
        $payload->setOrderDescription('ありがとうございました');
        $payload->setRedirectType('WEB_LINK');
        $payload->setRedirectUrl('https://paypay.ne.jp/');
        $payload->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1');

        //=================================================================
        // Calling the method to create a qr code
        //=================================================================
        $response = $client->code->createQRCode($payload);
        // 処理がうまくいってなかったら抜ける
        if($response['resultInfo']['code'] !== 'SUCCESS') {
            return;
        }

        return redirect($response['data']['url']);
        // Collectionに変換しておく
        // dd($response['data']);
        // $QRCodeResponse = collect($response['data']);
        // dd($QRCodeResponse);


        // //=================================================================
        // // Calling the method to get payment details
        // //=================================================================
        // $response = $client->payment->getPaymentDetails($QRCodeResponse['merchantPaymentId']);
        // // 処理がうまくいってなかったら抜ける
        // if($response['resultInfo']['code'] !== 'SUCCESS') {
        //     return;
        // }
        // // Collectionに変換しておく
        // $QRCodeDetails = collect($response['data']);
        // dd($QRCodeDetails);

        // //=================================================================
        // // Calling the method to cancel a Payment
        // //=================================================================
        // $response = $this->paypayClient->payment->cancelPayment($QRCodeResponse['merchantPaymentId']);
        // // 処理がうまくいってなかったら抜ける
        // if($response['resultInfo']['code'] !== 'REQUEST_ACCEPTED') {
        //     return;
        // }
        // // Collectionに変換しておく
        // $QRCodeCancel = collect($response['data']);
        // dd($QRCodeCancel);

    }
}
