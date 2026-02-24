@component('mail::message')
# Account Verification

Hi {{ $vendorName }},

Your OTP verification code is:

@component('mail::panel')
# {{ $otp }}
@endcomponent

This code will expire in 10 minutes.

If you didn't request this code, please ignore this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
