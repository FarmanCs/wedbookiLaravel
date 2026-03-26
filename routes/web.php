<?php

use App\Livewire\Host\HostDashboard\HostDashboard;
use App\Livewire\Vendor\Dashboard\VendorDashboard;
use App\Livewire\Venue\VenueIndex;
use App\Livewire\Vendor\WeddingVendors;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use \App\Livewire\Host\Auth\HostSignup;
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
    // Guest Routes (Not Authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/signup', \App\Livewire\Vendor\Auth\VendorSignup::class)->name('signup');
        Route::get('/verify-otp', \App\Livewire\Vendor\Auth\VendorVerifyOtp::class)->name('verify-otp');
        Route::get('/login', \App\Livewire\Vendor\Auth\VendorLogin::class)->name('login');
        Route::get('/forgot-password', function () {
            return 'Forgot Password Page';
        })->name('forgot-password');
    });

    // Authenticated Routes
    Route::middleware('auth:vendor')->group(function () {
        // Dashboard
        Route::get('/dashboard', VendorDashboard::class)->name('dashboard');

        // New pages
        Route::get('/calendar', \App\Livewire\Vendor\Calendar\Index::class)->name('calendar');
        Route::get('/messages', \App\Livewire\Vendor\Messages\Index::class)->name('messages');
        Route::get('/storefront', \App\Livewire\Vendor\Storefront\Index::class)->name('storefront');
        Route::get('/payments', \App\Livewire\Vendor\Payments\Index::class)->name('payments');
        Route::get('/reviews', \App\Livewire\Vendor\Reviews\Index::class)->name('reviews');
        Route::get('/bookings', \App\Livewire\Vendor\Bookings\Index::class)->name('bookings');
        Route::get('/analytics', \App\Livewire\Vendor\Analytics\Index::class)->name('analytics');

        Route::prefix('business')->name('business.')->group(function () {
            Route::get('/', VendorBusiness::class)->name('index');           // vendor.business.index
            Route::get('/create', CreateEditBusiness::class)->name('create'); // vendor.business.create
            Route::get('/{business}/edit', CreateEditBusiness::class)->name('edit'); // vendor.business.edit
        });

        // Packages
        Route::get('/packages', Packages::class)->name('packages');

        // Profile
        Route::get('/profile', \App\Livewire\Vendor\Profile\Index::class)->name('profile');
    });
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

        // Venues - Using Livewire Components
        Route::prefix('venues')->name('venues.')->group(function () {
            Route::get('/', VenueIndex::class)->name('index');
            Route::get('/{venue}', Detail::class)->name('detail');
        });

        // Bookings
        Route::prefix('bookings')->name('bookings.')->group(function () {
            Route::get('/', \App\Livewire\Host\Bookings\Index::class)->name('index');
        });

        // Guests
        Route::prefix('guests')->name('guests.')->group(function () {
            Route::get('/', \App\Livewire\Host\Guests\Index::class)->name('index');
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

// Public Venue Listing (Optional - for non-authenticated users)
Route::prefix('wedding-venues')->name('wedding-venues.')->group(function () {
    Route::get('/', VenueIndex::class)->name('index');
    Route::get('/{venue}', Detail::class)->name('detail');
});

Route::get('/wedding-vendors', WeddingVendors::class)
    ->name('wedding-vendors.index');

Route::get('/vendor/{vendorId}', VendorDetail::class)
    ->name('vendor.detail')
    ->where('vendorId', '.*');

// Route::get('/vendors/{slug}-{vendorId}', VendorDetail::class)
//     ->name('vendor.detail.slug');


Route::get('/wedding-planner', WeddingPlanner::class)->name('wedding-planner');

// Search route that maps to venue listing  
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
