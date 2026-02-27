<?php

use App\Livewire\Host\HostDashboard\HostDashboard;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use \App\Livewire\Host\Auth\HostSignup;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('vendor')->name('vendor.')->middleware('auth:vendor')->group(function () {
    // Dashboard (already exists, rename if needed)
    Route::get('/dashboard', \App\Livewire\Vendor\Dashboard\Index::class)->name('dashboard');

    // New pages
    Route::get('/calendar', \App\Livewire\Vendor\Calendar\Index::class)->name('calendar');
    Route::get('/messages', \App\Livewire\Vendor\Messages\Index::class)->name('messages');
    Route::get('/storefront', \App\Livewire\Vendor\Storefront\Index::class)->name('storefront');
    Route::get('/payments', \App\Livewire\Vendor\Payments\Index::class)->name('payments');
    Route::get('/reviews', \App\Livewire\Vendor\Reviews\Index::class)->name('reviews');
    Route::get('/bookings', \App\Livewire\Vendor\Bookings\Index::class)->name('bookings');
    Route::get('/analytics', \App\Livewire\Vendor\Analytics\Index::class)->name('analytics');
    Route::get('/profile', \App\Livewire\Vendor\Profile\Index::class)->name('profile'); // For vendor profile editing
});



Route::prefix('host')->name('host.')->group(function () {
    // Guest Routes (Not Authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/signup', HostSignup::class)->name('host-signup');
        Route::get('/verify-otp', \App\Livewire\Host\Auth\HostVerifyOtp::class)->name('verify-otp');
        Route::get('/login', \App\Livewire\Host\Auth\HostLogin::class)->name('host-login');
        Route::get('/forgot-password', function () {
            // Create this component later
            return 'Forgot Password Page';
        })->name('forgot-password');
    });

    // Authenticated Routes
    Route::middleware('auth:host')->group(function () {
        // Dashboard
        Route::get('/dashboard', HostDashboard::class)->name('host-dashboard');
        Route::get('/host/vendors/category/{category}', \App\Livewire\Host\Vendors\CategoryPage::class)
            ->name('host.vendors.category');
        // Vendors
        Route::prefix('vendors')->name('vendors.')->group(function () {
            Route::get('/', \App\Livewire\Host\Vendors\Index::class)->name('index');
            Route::get('/{business}', \App\Livewire\Host\Vendors\Detail::class)->name('detail');
        });

        Route::prefix('venues')->name('venues.')->group(function () {
            Route::get('/', \App\Livewire\Host\Vendors\Index::class)->name('index');
            Route::get('/{business}', \App\Livewire\Host\Vendors\Detail::class)->name('detail');
        });


        // Bookings
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', \App\Livewire\Host\Bookings\Index::class)->name('index');
//            Route::get('/create', \App\Livewire\Host\Bookings\Create::class)->name('create');
//            Route::get('/{booking}', \App\Livewire\Host\Bookings\Show::class)->name('show');
//            Route::get('/{booking}/edit', \App\Livewire\Host\Bookings\Edit::class)->name('edit');
        });

        // Guests
        Route::prefix('guests')->name('guests.')->group(function () {
            Route::get('/', \App\Livewire\Host\Guests\Index::class)->name('index');
//            Route::get('/groups', \App\Livewire\Host\Guests\Groups::class)->name('groups');
        });

        // Checklists
        Route::prefix('checklists')->name('checklists.')->group(function () {
            Route::get('/', \App\Livewire\Host\Checklists\Personalized::class)->name('index');
            Route::get('/personalized', \App\Livewire\Host\Checklists\Personalized::class)->name('personalized');
        });



        // Logout
        Route::post('/logout', function () {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('host.host-login');
        })->name('logout');
    });
});




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
