<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"> <!-- اختيار اللغة تلقائيًا -->

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.confirm_payment') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f8f9fa;
            /* لون خلفية أفتح */
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            /* عرض أعرض شوية */
            background: white;
            padding: 40px;
            border-radius: 16px;
            /* زاوية أردب */
            box-shadow: 0 15px 40px rgba(23, 107, 152, 0.15);
            /* ظل أفتح شوية */
            border: 1px solid #e0e7ff;
            /* لون الحواف */
        }

        h2 {
            text-align: center;
            color: #176b98;
            /* لون العنوان */
            margin-bottom: 30px;
            /* مسافة أسفل أكتر */
            font-size: 28px;
            /* حجم الخط */
            font-weight: 600;
            /* سمك الخط */
        }

        .payment-info {
            background-color: #f0f7ff;
            /* لون خلفية قسم معلومات الدفع */
            border: 1px solid #c7d9f0;
            /* لون الحواف */
            border-radius: 12px;
            /* زاوية أردب */
            padding: 20px;
            /* مساحة داخليه */
            margin-bottom: 25px;
            font-size: 16px;
            /* حجم الخط */
            line-height: 1.7;
            /* مسافة السطور */
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            /* مسافة أسفل أكتر */
        }

        .info-label {
            color: #176b98;
            /* لون التسمية */
            font-weight: 600;
            /* سمك الخط */
        }

        .info-value {
            color: #4a5568;
            /* لون القيمة */
        }

        .amount {
            font-size: 24px;
            /* حجم الخط */
            font-weight: bold;
            color: #176b98;
            /* لون المبلغ */
            text-align: center;
            margin: 20px 0;
            /* مسافة */
            padding: 10px;
            background-color: #e6f4ff;
            /* لون خلفية المبلغ */
            border-radius: 8px;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            /* مسافة أسفل أكتر */
        }

        label {
            display: block;
            margin-bottom: 8px;
            /* مسافة أسفل أكتر */
            font-weight: 600;
            color: #176b98;
            /* لون التسمية */
        }

        input[type="text"] {
            width: 100%;
            padding: 14px 18px;
            /* مساحة داخليه أكتر */
            border: 1px solid #c7d9f0;
            /* لون الحواف */
            border-radius: 10px;
            /* زاوية أردب */
            background-color: #f8fafc;
            /* لون خلفية الحقل */
            color: #2d3748;
            /* لون النص */
            font-size: 16px;
            /* حجم الخط */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #176b98;
            /* لون الحافة وقت التركيز */
            outline: none;
            box-shadow: 0 0 8px rgba(23, 107, 152, 0.4);
            /* ظل وقت التركيز */
        }

        button {
            background-color: #176b98;
            /* لون الزر */
            color: #FE;
            /* لون النص */
            border: none;
            padding: 16px 24px;
            /* مساحة داخليه */
            width: 100%;
            font-size: 18px;
            /* حجم الخط */
            font-weight: 600;
            /* سمك الخط */
            border-radius: 10px;
            /* زاوية أردب */
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            /* مسافة من الأعلى */
        }

        button:hover {
            background-color: #0e4a6f;
            /* لون الزر وقت التمرير */
            transform: translateY(-2px);
            /* رفع الزر بسيط */
        }

        .footer {
            text-align: center;
            margin-top: 35px;
            /* مسافة من الأعلى */
            color: #a0aec0;
            /* لون نص التذييل */
            font-size: 14px;
            /* حجم الخط */
            padding-top: 20px;
            /* مسافة من الأعلى */
            border-top: 1px solid #e2e8f0;
            /* خط فاصل */
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        @media (min-width: 768px) {
            .grid-cols-md-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .gap-4 {
            gap: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .text-red-500 {
            color: #e53e3e;
        }

        .text-sm {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>{{ __('messages.confirm_payment') }}</h2>

        <!-- بيانات الدفع -->
        <div class="payment-info">
            <div class="info-item">
                <span class="info-label">{{ __('messages.amount') }}</span>
                <span class="info-value">{{ $price }} {{ config('services.clickpay.currency') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">{{ __('messages.name') }}</span>
                <span class="info-value">{{ Auth::user()->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">{{ __('messages.email') }}</span>
                <span class="info-value">{{ Auth::user()->email }}</span>
            </div>
        </div>

        <!-- نموذج الدفع -->
        <form action="{{ route('pay.initiate.store', $cart) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 grid-cols-md-2 gap-4">
                <div class="form-group">
                    <label for="address">{{ __('messages.address') }}</label>
                    <input type="text" name="address" id="address" required>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">{{ __('messages.phone') }}</label>
                    <input type="text" name="phone" id="phone" required>
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="city">{{ __('messages.city') }}</label>
                    <input type="text" name="city" id="city" required>
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="country">{{ __('messages.country') }}</label>
                    <input type="text" name="country" id="country" required>
                    @error('country')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="state">{{ __('messages.state') }}</label>
                    <input type="text" name="state" id="state" required>
                    @error('state')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="zip">{{ __('messages.zip') }}</label>
                    <input type="text" name="zip" id="zip" required>
                    @error('zip')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- بيانات مخفية -->
            <input type="hidden" name="amount" value="{{ $price }}">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="return_url" value="{{ route('pay.success.store', $cart) }}">
            <input type="hidden" name="callback_url" value="{{ route('pay.callback.store', $cart) }}">

            <button type="submit" class="mt-6">{{ __('messages.pay_now') }}</button>
        </form>

        <div class="footer">
            {{ __('messages.secured_by_clickpay') }}
        </div>
    </div>
</body>

</html>
