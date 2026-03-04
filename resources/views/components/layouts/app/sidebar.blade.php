<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <!-- Venue Management (if authenticated as host) -->
            @if(auth('host')->check())
                <flux:navlist variant="outline" class="mt-4">
                    <flux:navlist.group :heading="__('Wedding Planning')" class="grid">
                        <flux:navlist.item icon="building-storefront" :href="route('host.venues.index')" :current="request()->routeIs('host.venues.*')" wire:navigate>
                            {{ __('Venues') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="users" :href="route('host.vendors.index')" :current="request()->routeIs('host.vendors.*')" wire:navigate>
                            {{ __('Vendors') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="clipboard-list" :href="route('host.bookings.index')" :current="request()->routeIs('host.bookings.*')" wire:navigate>
                            {{ __('Bookings') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="users-group" :href="route('host.guests.index')" :current="request()->routeIs('host.guests.*')" wire:navigate>
                            {{ __('Guests') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="check-list" :href="route('host.checklists.index')" :current="request()->routeIs('host.checklists.*')" wire:navigate>
                            {{ __('Checklists') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
            @endif

            <!-- Vendor Management (if authenticated as vendor) -->
            @if(auth('vendor')->check())
                <flux:navlist variant="outline" class="mt-4">
                    <flux:navlist.group :heading="__('Vendor Management')" class="grid">
                        <flux:navlist.item icon="calendar" :href="route('vendor.calendar')" :current="request()->routeIs('vendor.calendar')" wire:navigate>
                            {{ __('Calendar') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="envelope" :href="route('vendor.messages')" :current="request()->routeIs('vendor.messages')" wire:navigate>
                            {{ __('Messages') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="building-storefront" :href="route('vendor.storefront')" :current="request()->routeIs('vendor.storefront')" wire:navigate>
                            {{ __('Storefront') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="credit-card" :href="route('vendor.payments')" :current="request()->routeIs('vendor.payments')" wire:navigate>
                            {{ __('Payments') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="star" :href="route('vendor.reviews')" :current="request()->routeIs('vendor.reviews')" wire:navigate>
                            {{ __('Reviews') }}
                        </flux:navlist.item>
                        <flux:navlist.item icon="chart-bar" :href="route('vendor.analytics')" :current="request()->routeIs('vendor.analytics')" wire:navigate>
                            {{ __('Analytics') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
            @endif

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            @if(auth()->check() || auth('host')->check() || auth('vendor')->check())
                <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                    @php
                        $user = auth()->user() ?? auth('host')->user() ?? auth('vendor')->user();
                        $fullName = $user?->full_name ?? $user?->name ?? 'User';
                        $email = $user?->email ?? '';
                        $initials = $user?->initials() ?? strtoupper(substr($fullName, 0, 1));
                    @endphp

                    <flux:profile
                        :full_name="$fullName"
                        :initials="$initials"
                        icon:trailing="chevrons-up-down"
                        data-test="sidebar-menu-button"
                    />

                    <flux:menu class="w-[220px]">
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ $initials }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ $fullName }}</span>
                                        @if($email)
                                            <span class="truncate text-xs">{{ $email }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @endif
        </flux:sidebar>

        <!-- Mobile User Menu -->
        @if(auth()->check() || auth('host')->check() || auth('vendor')->check())
            <flux:header class="lg:hidden">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

                <flux:spacer />

                <flux:dropdown position="top" align="end">
                    @php
                        $mobileUser = auth()->user() ?? auth('host')->user() ?? auth('vendor')->user();
                        $mobileFullName = $mobileUser?->full_name ?? $mobileUser?->name ?? 'User';
                        $mobileEmail = $mobileUser?->email ?? '';
                        $mobileInitials = $mobileUser?->initials() ?? strtoupper(substr($mobileFullName, 0, 1));
                    @endphp

                    <flux:profile
                        :initials="$mobileInitials"
                        icon-trailing="chevron-down"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ $mobileInitials }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ $mobileFullName }}</span>
                                        @if($mobileEmail)
                                            <span class="truncate text-xs">{{ $mobileEmail }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </flux:header>
        @endif

        {{ $slot }}

        @fluxScripts
    </body>
</html>