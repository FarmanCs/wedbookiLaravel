<div class="flex flex-col gap-6">

    <x-auth-header
        title="Verify your account"
        description="Enter the 6-digit code sent to your email"
    />

    @if (session()->has('message'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
        <div class="flex items-start gap-2">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
        <div class="flex items-start gap-2">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <form wire:submit.prevent="verify" class="flex flex-col gap-6">

        {{-- OTP Input --}}
        <div wire:ignore x-data>
            <flux:input
                label="Verification Code"
                type="text"
                placeholder="Enter 6-digit code"
                maxlength="6"
                x-model="$wire.otp"
                class="text-center text-2xl tracking-widest font-mono"
                inputmode="numeric"
                pattern="[0-9]*"
            />
            <p class="text-xs text-zinc-500 mt-2">
                Enter the 6-digit code sent to your email address
            </p>
        </div>

        @error('otp')
        <div class="text-red-500 text-sm bg-red-50 px-3 py-2 rounded">
            {{ $message }}
        </div>
        @enderror

        {{-- Verify Button --}}
        <flux:button
            type="submit"
            class="w-full"
            wire:loading.attr="disabled"
            @if($remainingAttempts <= 0) disabled @endif
        >
        <span wire:loading.remove>Verify Account</span>
        <span wire:loading>Verifying...</span>
        </flux:button>

        @if($remainingAttempts <= 0)
        <div class="text-red-600 text-sm text-center font-medium">
            Too many failed attempts. Please request a new code.
        </div>
        @endif

    </form>

    {{-- Resend OTP Section --}}
    <div class="border-t pt-6">
        <p class="text-sm text-zinc-600 mb-4 text-center">
            Didn't receive the code?
        </p>

        <button
            wire:click="resendOtp"
            type="button"
            class="w-full px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
            wire:loading.attr="disabled"
            @if($resendLimitReached) disabled @endif
        >
            <svg class="inline-block w-4 h-4 mr-2" wire:loading.remove wire:target="resendOtp" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span wire:loading.remove wire:target="resendOtp">Resend Code</span>
            <span wire:loading wire:target="resendOtp">Sending...</span>
        </button>

        @if($resendLimitReached)
        <p class="text-xs text-red-600 text-center mt-2">
            Maximum resend attempts reached. Please contact support.
        </p>
        @endif
    </div>

    {{-- Back to Signup --}}
    <div class="text-center text-sm text-zinc-600">
        Wrong email address?
        <a href="{{ route('Vendor/VendorSignup') }}" class="text-blue-500 hover:text-blue-700 font-medium">
            Sign up again
        </a>
    </div>

</div>
