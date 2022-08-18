<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save user data
        $user = Auth::user();

        // process checkout
        $code = 'STORE-' . mt_rand(00000,99999);
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();

        //transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => (int) $request->ship_total,
            'total_price' => (int) $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(00000,99999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // delete cart data
        Cart::where('users_id', Auth::user()->id)->delete();
        
        // konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // buat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'bri_va', 'bank_transfer', 'indomaret', 'shopeepay'
            ],
            'vtweb' => []
        ];

        try {
        // Get Snap Payment Page URL
        $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
        
        // Redirect to Snap Payment Page
        return redirect($paymentUrl);
        }
        catch (Exception $e) {
        echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::where('code',$order_id)->first();

        // handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                }
                else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        }

        else if($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        }

        else if($status == 'deny') {
            $transaction->transaction_status = 'CANCELLED';
        }

        else if($status == 'expire') {
            $transaction->transaction_status = 'CANCELLED';
        }

        else if($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }

        // simpan transaksi
        $transaction->save();
    }
}