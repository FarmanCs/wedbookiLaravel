<?php

namespace App\Livewire\Vendor\Auth;

use App\Mail\Vendor\VendorOtpResendMail;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.auth.simple')]
class VendorVerifyOtp extends Component
{
    public $otp = '';
    public $vendor;
    public $attempts = 0;
    public $resendAttempts = 0;
    public $resendCooldownSeconds = 0;

    const OTP_ATTEMPTS_LIMIT = 5;
    const OTP_RESEND_ATTEMPTS_LIMIT = 3;
    const OTP_RESEND_COOLDOWN = 60; // seconds
    const OTP_EXPIRY_MINUTES = 10;

    public function mount()
    {
        // Check if there's a vendor_signup_id in session
        if (!session()->has('vendor_signup_id')) {
            session()->flash('error', 'No pending verification found.');
            return redirect()->route('vendor.signup');
        }

        // Get the vendor
        $this->vendor = Vendor::find(session('vendor_signup_id'));

        if (!$this->vendor) {
            session()->forget('vendor_signup_id');
            session()->flash('error', 'Invalid verification session.');
            return redirect()->route('vendor.signup');
        }

        // Initialize attempt counters from session
        $this->attempts = session('otp_attempts', 0);
        $this->resendAttempts = session('otp_resend_attempts', 0);

        // Check if too many attempts
        if ($this->attempts >= self::OTP_ATTEMPTS_LIMIT) {
            $this->dispatch('show-error', 'Too many verification attempts. Please request a new OTP.');
        }

        // Check rate limit cooldown
        $this->checkResendCooldown();
    }

    private function checkResendCooldown()
    {
        $rateLimitKey = 'otp_resend_' . $this->vendor->id;
        if (RateLimiter::tooManyAttempts($rateLimitKey, self::OTP_RESEND_ATTEMPTS_LIMIT)) {
            $this->resendCooldownSeconds = RateLimiter::availableIn($rateLimitKey);
        }
    }

    public function verify()
    {
        $this->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Check attempt limit
        if ($this->attempts >= self::OTP_ATTEMPTS_LIMIT) {
            $this->addError('otp', 'Too many failed attempts. Please request a new OTP code.');
            return;
        }

        $vendor = Vendor::find(session('vendor_signup_id'));

        if (!$vendor) {
            $this->addError('otp', 'Verification session expired. Please sign up again.');
            return;
        }

        // Check if OTP has expired
        if ($vendor->otp_expires_at && $vendor->otp_expires_at < now()) {
            $this->addError('otp', 'OTP has expired. Please request a new code.');
            return;
        }

        // Check if OTP matches
        if ($vendor->otp != $this->otp) {
            $this->attempts++;
            session(['otp_attempts' => $this->attempts]);

            $remainingAttempts = self::OTP_ATTEMPTS_LIMIT - $this->attempts;
            $message = 'Invalid OTP code. Please try again.';
            if ($remainingAttempts > 0) {
                $message .= " ({$remainingAttempts} attempt" . ($remainingAttempts > 1 ? 's' : '') . " remaining)";
            }

            $this->addError('otp', $message);
            return;
        }

        // Mark email as verified
        $vendor->update([
            'email_verified' => true,
            'otp' => null,
            'otp_expires_at' => null,
            'otp_attempt_count' => 0,
        ]);

        // Log in the vendor
        Auth::guard('vendor')->login($vendor);

        // Update last login
        $vendor->update(['last_login' => now()]);

        // Clear session
        session()->forget(['vendor_signup_id', 'otp_attempts', 'otp_resend_attempts']);
        session()->regenerate();

        // Redirect to dashboard
        session()->flash('success', 'Account verified successfully!');
        return redirect()->route('vendor.dashboard');
    }

    public function resendOtp()
    {
        try {
            // Check resend attempt limit
            if ($this->resendAttempts >= self::OTP_RESEND_ATTEMPTS_LIMIT) {
                $this->addError('otp', 'Too many resend requests. Please try again later.');
                return;
            }

            $vendor = Vendor::find(session('vendor_signup_id'));

            if (!$vendor) {
                $this->addError('otp', 'Verification session expired. Please sign up again.');
                return;
            }

            // Rate limiting: prevent resending OTP too frequently
            $rateLimitKey = 'otp_resend_' . $vendor->id;

            if (RateLimiter::tooManyAttempts($rateLimitKey, self::OTP_RESEND_ATTEMPTS_LIMIT)) {
                $seconds = RateLimiter::availableIn($rateLimitKey);
                $this->addError('otp', "Please wait {$seconds} second" . ($seconds > 1 ? 's' : '') . " before requesting another code.");
                return;
            }

            // Generate new OTP
            $newOtp = rand(100000, 999999);
            $vendor->update([
                'otp' => $newOtp,
                'otp_expires_at' => now()->addMinutes(self::OTP_EXPIRY_MINUTES),
                'otp_attempt_count' => 0,
            ]);

            // Send the OTP via email - using queue or sync
            Mail::mailer('smtp')->to($vendor->email)->send(new VendorOtpResendMail($newOtp, $vendor->full_name));

            // Update session counters only after successful send
            $this->resendAttempts++;
            session(['otp_resend_attempts' => $this->resendAttempts]);

            // Reset verification attempts on successful resend
            session(['otp_attempts' => 0]);
            $this->attempts = 0;
            $this->otp = '';

            // Rate limiting
            RateLimiter::hit($rateLimitKey, self::OTP_RESEND_COOLDOWN);

            // Check for upcoming cooldown
            $this->checkResendCooldown();

            $this->dispatch('show-success', 'A new OTP has been sent to ' . $vendor->email);
        } catch (\Exception $e) {
            Log::error('Failed to resend OTP email', [
                'vendor_id' => session('vendor_signup_id'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->addError('otp', 'Failed to send OTP. Please check your email configuration and try again later.');
        }
    }

    public function getResendButtonDisabledProperty()
    {
        return $this->resendAttempts >= self::OTP_RESEND_ATTEMPTS_LIMIT || $this->resendCooldownSeconds > 0;
    }

    public function render()
    {
        return view('livewire.vendor.auth.vendor-verify-otp', [
            'remainingAttempts' => self::OTP_ATTEMPTS_LIMIT - $this->attempts,
            'resendLimitReached' => $this->resendAttempts >= self::OTP_RESEND_ATTEMPTS_LIMIT,
            'resendCooldownSeconds' => $this->resendCooldownSeconds,
        ]);
    }
}
