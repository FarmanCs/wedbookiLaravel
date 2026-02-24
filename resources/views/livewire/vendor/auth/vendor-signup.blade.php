<div class="flex flex-col gap-6">

    <div class="flex items-center justify-center gap-1">
        <x-auth-header
            title="Create a vendor account"
            description="Enter your details below to create your vendor account"
        />
    </div>

    <!-- Error Message Alert -->
    @if ($error_message)
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm animate-fadeIn">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span>{{ $error_message }}</span>
            </div>
        </div>
    @endif

    <!-- Success Message Alert -->
    @if ($success_message)
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm animate-fadeIn">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ $success_message }}</span>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="signup" class="flex flex-col gap-6">

        <!-- Full Name -->
        <div>
            <flux:input
                label="Full Name"
                placeholder="Your full name"
                wire:model="full_name"
                type="text"
                required
                autofocus
            />
            @error('full_name')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <flux:input
                type="email"
                label="Email Address"
                placeholder="email@example.com"
                wire:model="email"
                required
            />
            @error('email')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Country Code + Phone Number -->
        <div class="flex gap-3">
            <div class="w-24 shrink-0">
                <flux:input
                    label="Code"
                    wire:model="country_code"
                    type="text"
                    placeholder="+92"
                />
                @error('country_code')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex-1">
                <flux:input
                    label="Phone Number"
                    placeholder="3001234567"
                    wire:model="phone_no"
                    type="tel"
                    required
                />
                @error('phone_no')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div>
            <flux:input
                type="password"
                label="Password"
                placeholder="Enter a strong password"
                wire:model="password"
                viewable
                required
            />
            @error('password')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">At least 8 characters</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <flux:input
                type="password"
                label="Confirm Password"
                placeholder="Confirm your password"
                wire:model="password_confirmation"
                viewable
                required
            />
            @error('password_confirmation')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <flux:button
            type="submit"
            class="w-full"
            :disabled="$loading"
            wire:loading.attr="disabled"
        >
            <span wire:loading.remove>Create Vendor Account</span>
            <span wire:loading class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Creating Account...
            </span>
        </flux:button>
    </form>

    <!-- Login Link -->
    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
        Already have an account?
        <flux:link href="{{ route('vendor.login') }}" wire:navigate>
            <span class="text-blue-500 dark:text-blue-400 hover:underline">Log in</span>
        </flux:link>
    </div>

    <!-- Terms Link -->
    <div class="text-center text-xs text-zinc-500 dark:text-zinc-500">
        By creating an account, you agree to our
        <a href="#" class="text-blue-500 dark:text-blue-400 hover:underline">Terms of Service</a>
        and
        <a href="#" class="text-blue-500 dark:text-blue-400 hover:underline">Privacy Policy</a>
    </div>
</div>
