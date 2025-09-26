<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\cartItems;
use App\Models\orderdetails;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class gamePaymentController extends Controller
{
    protected $profileId;
    protected $serverKey;
    protected $clientKey;
    protected $currency;
    protected $baseUrl;

    public function __construct()
    {
        $this->profileId = config('services.clickpay.profile_id');
        $this->serverKey = config('services.clickpay.server_key');
        $this->clientKey = config('services.clickpay.client_key');
        $this->currency = config('services.clickpay.currency');
        $this->baseUrl = rtrim(config('services.clickpay.base_url'), '/');
    }

    public function showPaymentForm(cart $cart)
    {
        $cartitems = cartItems::where('cart_id', $cart->id)->get();
        $quantity = 0;
        $price = 0;
        foreach ($cartitems as $item) {
            $quantity += $item->quantity;
            $price += $item->games->price * $item->quantity;
        }
        return view('payment.storeForm', compact('cart', 'quantity', 'price'));
    }

    public function initiatePayment(Request $request, cart $cart)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.5',
            'email' => 'required|email',
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);
        $amount = $request->amount;
        $email = $request->email;
        $name = $request->name;

        $billingData = [
            'first_name' => explode(' ', $name)[0],
            'last_name' => explode(' ', $name)[1] ?? 'User',
            'email' => $email,
            'phone' => $request->phone,
            'address_line_1' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
        ];
        $payload = [
            "profile_id" => $this->profileId,
            "tran_type" => "sale",
            "tran_class" => "ecom",
            "cart_id" => uniqid('cart_'),
            "cart_description" => "Payment for products",
            "cart_currency" => $this->currency,
            "cart_amount" => $amount,
            "callback" => route('pay.callback.store', ['cart' => $cart]),
            "return" => route('pay.success.store', ['cart' => $cart]),
            "billing_details" => $billingData,
        ];


        $response = Http::withHeaders([
            'Authorization' => $this->serverKey,
            'Content-Type' => 'application/json'
        ])->post("{$this->baseUrl}/payment/request", $payload);
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['redirect_url'])) {
                return redirect()->away($data['redirect_url']);
            }
        }

        Log::error('ClickPay Initiation Failed', $response->json());
        return redirect()->back()->withErrors('Payment initiation failed. Please try again.');

    }

    public function callback(Request $request, cart $cart)
    {
        $paypageId = $request->query('pay_page_id');
        $transactionId = $request->query('transaction_id');

        if (!$paypageId || !$transactionId) {
            return redirect()->route('pay.fail')->withErrors('Missing payment details.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->serverKey,
            ])->get("{$this->baseUrl}/pay/connect/en/api/v1/verify", [
                        'pay_page_id' => $paypageId,
                        'transaction_id' => $transactionId,
                    ]);

            if ($response->successful()) {
                $result = $response->json();
                if ($result['transaction']['auth_result'] === 'A') {

                    return redirect()->route('pay.success', ['cart' => $cart]);
                }
            }

            return redirect()->route('pay.fail');

        } catch (\Exception $e) {
            Log::error('ClickPay Verification Error', ['message' => $e->getMessage()]);
            return redirect()->route('pay.fail');
        }
    }

    public function success(cart $cart)
    {
        $order = DB::transaction(function () use ($cart) {
            $cartitems = cartItems::where('cart_id', $cart->id)->get();

            $quantity = 0;
            $price = 0;

            foreach ($cartitems as $item) {
                $quantity += $item->quantity;
                $price += $item->games->price * $item->quantity;
            }
            $order = orders::create([
                'user_id' => $cart->user_id,
                'price' => $price,
                'transaction_type' => 'visa',
                'quantity' => $quantity
            ]);

            foreach ($cartitems as $item) {
                orderdetails::create([
                    'orders_id' => $order->id,
                    'games_id' => $item->games_id,
                    'quantity' => $item->quantity,
                    'price' => $item->games->price * $item->quantity
                ]);
                $item->delete();
            }
            return $order;
        });

        return view('payment.storesuccess', compact('order'));
    }
}