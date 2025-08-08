<?php

namespace App\Http\Controllers\home;

use App\Models\Courses;
use App\Models\Enrollments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClickPayController
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

    public function showPaymentForm(Courses $course)
    {
        return view('payment.form', compact('course'));
    }

    public function initiatePayment(Request $request, Courses $course)
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
            "callback" => route('pay.callback', ['course' => $course]),
            "return" => route('pay.success', ['course' => $course]),
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

    public function callback(Request $request, Courses $course)
    {
        $paypageId = $request->query('pay_page_id');
        $transactionId = $request->query('transaction_id');

        if (!$paypageId || !$transactionId) {
            return redirect()->route('pay.fail')->withErrors('Missing payment details.');
        }

        // تحقق من حالة الدفع
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

                    return redirect()->route('pay.success', ['course' => $course]);
                }
            }

            return redirect()->route('pay.fail');

        } catch (\Exception $e) {
            Log::error('ClickPay Verification Error', ['message' => $e->getMessage()]);
            return redirect()->route('pay.fail');
        }
    }

    public function success(Courses $course)
    {
        Enrollments::create([
            'user_id' => auth()->user()->id,
            'courses_id' => $course->id,
            'price' => $course->price,
            'enrolled' => 'yes',
        ]);
        return view('payment.success');
    }
}