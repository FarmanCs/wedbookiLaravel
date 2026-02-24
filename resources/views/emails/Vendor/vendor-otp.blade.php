<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account - Wedbooki</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 10px;
        }

        .logo-subtitle {
            font-size: 12px;
            color: #6b7280;
            letter-spacing: 2px;
        }

        .content {
            padding: 20px 0;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .message {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .otp-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            margin: 30px 0;
        }

        .otp-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .otp-code {
            font-size: 42px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
            word-spacing: 10px;
        }

        .otp-description {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 15px;
        }

        .info-box {
            background-color: #f9fafb;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .info-box p {
            font-size: 13px;
            color: #4b5563;
            margin: 5px 0;
        }

        .info-box strong {
            color: #1f2937;
        }

        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .warning p {
            font-size: 13px;
            color: #92400e;
            margin: 5px 0;
        }

        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 30px 0;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 30px;
        }

        .footer-link {
            color: #10b981;
            text-decoration: none;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .social-links {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #10b981;
            text-decoration: none;
            font-size: 11px;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .otp-code {
                font-size: 32px;
                letter-spacing: 4px;
            }

            .header {
                padding: 20px 0;
            }

            .greeting {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="logo">🎊 WEDBOOKI</div>
        <div class="logo-subtitle">VENDOR PORTAL</div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Greeting -->
        <div class="greeting">Hello {{ $name }},</div>

        <!-- Message -->
        <div class="message">
            <p>Thank you for signing up as a vendor on Wedbooki! We're excited to have you join our platform.</p>
            <p style="margin-top: 15px;">To complete your account setup and verify your email address, please use the OTP code below:</p>
        </div>

        <!-- OTP Code -->
        <div class="otp-section">
            <div class="otp-label">Your Verification Code</div>
            <div class="otp-code">{{ $otp }}</div>
            <div class="otp-description">
                This code will expire in {{ $expiryTime }} minutes
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <p>
                <strong>📋 Next Steps:</strong><br>
                1. Copy the OTP code above<br>
                2. Go back to the Wedbooki vendor signup page<br>
                3. Paste the code in the verification field<br>
                4. Complete your profile setup
            </p>
        </div>

        <!-- Warning -->
        <div class="warning">
            <p>
                <strong>⚠️ Important:</strong> If you didn't request this code or didn't sign up for Wedbooki, please ignore this email. Do not share your OTP code with anyone.
            </p>
        </div>

        <!-- Support -->
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <p style="font-size: 13px; color: #4b5563; margin-bottom: 10px;">
                <strong>Need Help?</strong><br>
                If you have any questions or didn't receive an OTP, please contact our support team.
            </p>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Wedbooki. All rights reserved.</p>
        <p style="margin-top: 10px; color: #9ca3af;">
            This is an automated email. Please do not reply to this message.
        </p>
        <div class="social-links">
            <a href="https://wedbooki.com">Website</a> •
            <a href="https://wedbooki.com/privacy">Privacy Policy</a> •
            <a href="https://wedbooki.com/terms">Terms of Service</a>
        </div>
    </div>
</div>
</body>
</html>
