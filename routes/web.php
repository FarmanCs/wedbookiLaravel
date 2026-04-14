<?php

use App\Http\Controllers\Host\Booking\PaymentController;
use App\Http\Controllers\Vendor\Credits\CreditSuccessController;
use App\Livewire\Host\HostDashboard\HostDashboard;
use App\Livewire\Vendor\Dashboard\VendorDashboard;
use App\Livewire\Venue\VenueIndex;
use App\Livewire\Vendor\WeddingVendors;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use \App\Livewire\Host\Auth\HostSignup;
use App\Livewire\Host\Bookings\BookingComponent;
use App\Livewire\Vendor\Bookings\VendorBookingComponent;
use App\Livewire\Vendor\Business\CreateEditBusiness;
use App\Livewire\Vendor\Business\VendorBusiness;
use App\Livewire\Vendor\Packages\Packages;
use App\Livewire\Vendor\Plan\WeddingPlanner;
use App\Livewire\Vendor\VendorDetail;
use App\Livewire\Venue\Detail;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('vendor')->name('vendor.')->group(function () {

    // ── Guest Routes ──────────────────────────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('/signup', \App\Livewire\Vendor\Auth\VendorSignup::class)->name('signup');
        Route::get('/verify-otp', \App\Livewire\Vendor\Auth\VendorVerifyOtp::class)->name('verify-otp');
        Route::get('/login', \App\Livewire\Vendor\Auth\VendorLogin::class)->name('login');
        Route::get('/forgot-password', function () {
            return 'Forgot Password Page';
        })->name('forgot-password');
    });

    // ── IMPORTANT: credits/success MUST be declared BEFORE auth middleware group

    // ─────────────────────────────────────────────────────────────────────────
    Route::get('/credits/success', [CreditSuccessController::class, 'handle'])
        ->name('credits.success');

    Route::middleware('auth:vendor')->group(function () {
        // Dashboard
        Route::get('/dashboard', VendorDashboard::class)->name('dashboard');

        // New pages
        Route::get('/calendar', \App\Livewire\Vendor\Calendar\Index::class)->name('calendar');
        Route::get('/messages', \App\Livewire\Vendor\Messages\Index::class)->name('messages');
        Route::get('/storefront', \App\Livewire\Vendor\Storefront\Index::class)->name('storefront');
        Route::get('/payments', \App\Livewire\Vendor\Payments\Index::class)->name('payments');
        Route::get('/reviews', \App\Livewire\Vendor\Reviews\Index::class)->name('reviews');
        Route::get('/bookings', VendorBookingComponent::class)->name('bookings');
        Route::get('/analytics', \App\Livewire\Vendor\Analytics\Index::class)->name('analytics');

        // ✅ CREDITS — declared AFTER credits/success
        Route::get('/credits', \App\Livewire\Vendor\Credits\Plans::class)->name('credits');
        Route::get('/credits-center', \App\Livewire\Vendor\Credits\Credits::class)->name('credits.center');

        Route::prefix('business')->name('business.')->group(function () {
            Route::get('/', VendorBusiness::class)->name('index');
            Route::get('/create', CreateEditBusiness::class)->name('create');
            Route::get('/{business}/edit', CreateEditBusiness::class)->name('edit');
        });

        // Packages
        Route::get('/packages', Packages::class)->name('packages');

        // Profile
        Route::get('/profile', \App\Livewire\Vendor\Profile\Index::class)->name('profile');
    });

    Route::post('/logout', function () {
        Auth::guard('vendor')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('vendor.login');
    })->name('logout');
});

// ── Host Routes ───────────────────────────────────────────────────────────────
Route::prefix('host')->name('host.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/signup', HostSignup::class)->name('host-signup');
        Route::get('/verify-otp', \App\Livewire\Host\Auth\HostVerifyOtp::class)->name('verify-otp');
        Route::get('/login', \App\Livewire\Host\Auth\HostLogin::class)->name('login');
        Route::get('/forgot-password', fn() => 'Forgot Password')->name('forgot-password');
    });

    Route::middleware('auth:host')->group(function () {

        Route::get('/dashboard', HostDashboard::class)->name('dashboard');

        Route::prefix('vendors')->name('vendors.')->group(function () {
            Route::get('/', \App\Livewire\Host\Vendors\Index::class)->name('index');
            Route::get('/category/{category}', \App\Livewire\Host\Vendors\CategoryPage::class)->name('category');
            Route::get('/{business}', \App\Livewire\Host\Vendors\Detail::class)->name('detail');
        });

        Route::prefix('venues')->name('venues.')->group(function () {
            Route::get('/', VenueIndex::class)->name('index');
            Route::get('/{venue}', Detail::class)->name('detail');
        });

        // Route::get('/bookings', BookingComponent::class)->name('bookings.index');
        Route::prefix('bookings')->name('bookings.')->group(function () {

            // Main bookings list (Livewire component)
            Route::get('/', BookingComponent::class)->name('index');

            // Create new booking
            Route::get('/create', function () {
                return view('host.bookings.create');
            })->name('create');

            // View booking details
            Route::get('/{booking}', function ($booking) {
                return view('host.bookings.show', compact('booking'));
            })->name('show');

            // Edit booking
            Route::get('/{booking}/edit', function ($booking) {
                return view('host.bookings.edit', compact('booking'));
            })->name('edit');

            // Payment Routes
            Route::prefix('payment')->name('payment.')->group(function () {
                // Success callback from Stripe
                Route::get('/success/{booking}', [PaymentController::class, 'success'])
                    ->name('success');

                // Cancel callback from Stripe
                Route::get('/cancel', [PaymentController::class, 'cancel'])
                    ->name('cancel');
            });
        });
        Route::get('/guests', \App\Livewire\Host\Guests\Index::class)->name('guests.index');

        Route::prefix('checklists')->name('checklists.')->group(function () {
            Route::get('/', \App\Livewire\Host\Checklists\Personalized::class)->name('index');
            Route::get('/personalized', \App\Livewire\Host\Checklists\Personalized::class)->name('personalized');
        });

        Route::get('/messages', \App\Livewire\Host\Messages\Index::class)->name('messages');
        Route::get('/budget', \App\Livewire\Host\Budget\Index::class)->name('budget');

        Route::post('/logout', function () {
            Auth::guard('host')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('host.login');
        })->name('logout');
    });
});

// ── Public Routes ─────────────────────────────────────────────────────────────
Route::prefix('wedding-venues')->name('wedding-venues.')->group(function () {
    Route::get('/', VenueIndex::class)->name('index');
    Route::get('/{venue}', Detail::class)->name('detail');
});

Route::get('/wedding-vendors', WeddingVendors::class)->name('wedding-vendors.index');

Route::get('/vendor/{vendorId}', VendorDetail::class)
    ->name('vendor.detail')
    ->where('vendorId', '.*');

Route::get('/wedding-planner', WeddingPlanner::class)->name('wedding-planner');

Route::get('/search', function () {
    return app(VenueIndex::class)->render();
})->name('search');

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
