<?php

namespace App\Livewire\Vendor\Auth;

use App\Mail\Vendor\VendorOtpMail;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth.split')]
class VendorSignup extends Component
{
    public $full_name = '';
    public $email = '';
    public $phone_no = '';
    public $country_code = '+92';
    public $password = '';
    public $password_confirmation = '';
    public $error_message = '';
    public $success_message = '';
    public $loading = false;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:vendors,email',
        'phone_no' => 'required|string|max:20',
        'country_code' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'full_name.required' => 'Full name is required.',
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email address is already registered.',
        'phone_no.required' => 'Phone number is required.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
    ];

    public function signup()
    {

        $this->loading = true;
        $this->error_message = '';
        $this->success_message = '';

        try {

            // ✅ VALIDATE FIRST
            $this->validate();

            // Create vendor
            $vendor = Vendor::create([
                'full_name' => $this->full_name,
                'email' => $this->email,
                'phone_no' => $this->phone_no,
                'country_code' => $this->country_code,
                'password' => Hash::make($this->password),
                'signup_method' => 'email',
            ]);

            // Generate OTP
            $otp = rand(100000, 999999);
            $vendor->update([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);


            // Send OTP via email
            try {
                Mail::mailer('smtp')->to($vendor->email)->send(new VendorOtpMail($otp, $vendor->full_name));
            } catch (\Exception $e) {
                Log::error('Failed to send OTP email', [
                    'vendor_id' => $vendor->id,
                    'email' => $vendor->email,
                    'error' => $e->getMessage(),
                    'error_code' => $e->getCode(),
                    'trace' => $e->getTraceAsString(),
                ]);

                $this->error_message = 'Failed to send OTP email. Error: ' . $e->getMessage();
                $this->loading = false;
                return;
            }

            // Store vendor ID in session
            session(['vendor_signup_id' => $vendor->id]);

            Log::info('Vendor signup completed, redirecting to OTP verification', [
                'vendor_id' => $vendor->id,
                'session_id' => session()->getId(),
            ]);

            // Clear form data
            $this->reset([
                'full_name',
                'email',
                'phone_no',
                'password',
                'password_confirmation',
            ]);

            $this->loading = false;

            // Set success message
            $this->success_message = 'Signup successful! Redirecting to OTP verification...';

            // Redirect to OTP verification page
            return redirect()->route('vendor.verify-otp');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed during signup', [
                'errors' => $e->errors(),
            ]);
            $this->loading = false;
            throw $e;
        } catch (\Exception $e) {
            Log::error('Signup error', [
                'error' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'trace' => $e->getTraceAsString(),
            ]);

            if (str_contains($e->getMessage(), 'vendors_email_unique')) {
                $this->error_message = 'This email address is already registered. Please login instead.';
            } else {
                $this->error_message = 'Something went wrong. Please try again.';
            }
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.vendor.auth.vendor-signup');
    }
}
