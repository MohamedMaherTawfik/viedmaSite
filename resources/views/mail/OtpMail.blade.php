<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            color: #333333;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .email-header {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .email-header h1 {
            color: white;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .email-body {
            padding: 40px 30px;
        }

        .welcome-text {
            font-size: 18px;
            margin-bottom: 20px;
            color: #374151;
        }

        .otp-container {
            text-align: center;
            margin: 30px 0;
        }

        .otp-code {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 8px;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        .otp-expiry {
            font-size: 14px;
            color: #6b7280;
            margin-top: 15px;
        }

        .security-tips {
            background-color: #f9fafb;
            border-left: 4px solid #4f46e5;
            padding: 15px 20px;
            margin: 30px 0;
            border-radius: 0 4px 4px 0;
        }

        .security-tips h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #374151;
        }

        .security-tips ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .security-tips li {
            font-size: 14px;
            margin-bottom: 5px;
            color: #6b7280;
        }

        .email-footer {
            padding: 20px 30px;
            background-color: #f3f4f6;
            border-radius: 0 0 8px 8px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        .support-link {
            color: #4f46e5;
            text-decoration: none;
        }

        @media (max-width: 480px) {
            .email-body {
                padding: 30px 20px;
            }

            .otp-code {
                font-size: 24px;
                letter-spacing: 6px;
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Verification Code</h1>
        </div>

        <div class="email-body">
            <p class="welcome-text">Hello {{ $user->name }},</p>
            <p>You're receiving this email because we received a request for authentication of your account. Use the
                verification code below to complete the process.</p>

            <div class="otp-container">
                <div class="otp-code">{{ $otp }}</div>
                <p class="otp-expiry">This code will expire in 10 minutes</p>
            </div>

            <p>If you didn't request this code, you can safely ignore this email. Someone might have entered your email
                address by mistake.</p>

            <div class="security-tips">
                <h3>Security Tips:</h3>
                <ul>
                    <li>Never share this code with anyone</li>
                    <li>We will never ask you for your password or this code</li>
                    <li>Make sure you're on the official website before entering this code</li>
                </ul>
            </div>

            <p>Thanks,<br>The {{ config('app.name') }} Team</p>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, please contact us at <a href="mailto:support@example.com"
                    class="support-link">support@example.com</a></p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>

</html>
