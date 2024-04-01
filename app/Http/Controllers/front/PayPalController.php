<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;

class PayPalController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->initialize([
            'clientId' => env('PAYPAL_CLIENT_ID'),
            'secret' => env('PAYPAL_CLIENT_SECRET'),
            'testMode' => true // Or false if you're not in test mode
        ]);
    }

    public function paypals()
    {
        if (Session::has('order_id')) {
            $orderDetails = Orders::with('orders_products', 'user')->where('id', Session::get('order_id'))->first()->toArray();
            return view('client.paypal.paypal')->with(compact('orderDetails'));
        } else {
            return redirect('/cart');
        }
    }

    public function pay(Request $request)
    {
        try {
            $paypal_amount = round(Session::get('grand_total') / 80, 2);
            $response = $this->gateway->purchase([
                'amount' => $paypal_amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ])->send();

            if ($response->isRedirect()) {
                return $response->redirect(); // Note: Call the method and return its result
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ]);
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                // Your payment success handling logic here
                return "Payment is Successful. Your Transaction Id is: " . $arr['id'];
            } else {
                return redirect()->route('errors');
            }
        } else {
            return 'Payment declined!!';
        }
    }

    public function errors()
    {
        return 'User declined the payment!';
    }
}
