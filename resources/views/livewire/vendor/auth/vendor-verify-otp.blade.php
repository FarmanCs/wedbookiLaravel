<div class="flex flex-col gap-6">

    <x-auth-header
        title="Verify your account"
        description="Enter the 6-digit code sent to your email"
    />

    @if (session()->has('message'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="verify" class="flex flex-col gap-6">

        {{-- OTP Input --}}
        <div>
            <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">
                Verification Code
            </label>
            <input
                type="text"
                id="otp"
                wire:model="otp"
                placeholder="000000"
                maxlength="6"
                inputmode="numeric"
                class="w-full px-4 py-3 text-center text-3xl tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                autocomplete="off"
            />
            @error('otp')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Verify Button --}}
        <button
            type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 disabled:bg-gray-400 text-white font-medium py-3 px-4 rounded-lg transition duration-200"
            wire:loading.attr="disabled"
        >
            <span wire:loading.remove>Verify Account</span>
            <span wire:loading class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Verifying...
            </span>
        </button>

    </form>

    {{-- Resend OTP --}}
    <div class="text-center border-t border-gray-200 pt-6">
        <p class="text-sm text-gray-600 mb-3">
            Didn't receive the code?
        </p>
        <button
            wire:click="resendOtp"
            type="button"
            class="text-sm font-medium text-blue-500 hover:text-blue-700 hover:underline disabled:text-gray-400 disabled:cursor-not-allowed transition"
            wire:loading.attr="disabled"
            @if($resendCooldownSeconds > 0) disabled @endif
        >
            <span wire:loading.remove wire:target="resendOtp">
                @if($resendCooldownSeconds > 0)
                    Resend Code ({{ $resendCooldownSeconds }}s)
                @else
                    Resend Code
                @endif
            </span>
            <span wire:loading wire:target="resendOtp" class="flex items-center justify-center gap-1 inline-flex">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Resending...
            </span>
        </button>

        @if($resendLimitReached)
            <p class="text-xs text-red-600 mt-2">
                Too many resend attempts. Please try again later.
            </p>
        @endif
    </div>

    {{-- Back to Signup --}}
    <div class="text-center text-sm text-gray-600 border-t border-gray-200 pt-6">
        Wrong email?
        <a href="{{ route('vendor.signup') }}" class="text-blue-500 hover:text-blue-700 font-medium hover:underline">
            Sign up again
        </a>
    </div>

</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        // Auto-focus on OTP input
        document.getElementById('otp')?.focus();

        // Allow only numeric input
        const otpInput = document.getElementById('otp');
        if (otpInput) {
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Auto-submit on 6 digits
            otpInput.addEventListener('input', function(e) {
                if (this.value.length === 6) {
                    document.querySelector('form')?.requestSubmit();
                }
            });
        }
    });
</script>
