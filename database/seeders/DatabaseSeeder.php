<?php

namespace Database\Seeders;

use Database\Seeders\Admin\PermissionSeeder;
use Database\Seeders\Admin\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // First, seed independent tables
        $this->call([
            // Admin & Auth (no foreign dependencies)
            RoleSeeder::class,
            PermissionSeeder::class,
            \Database\Seeders\Admin\AdminSeeder::class,
            \Database\Seeders\Auth\UserSeeder::class,

            // Utility & Content (mostly independent)
            \Database\Seeders\Utility\CountrySeeder::class,
            \Database\Seeders\Utility\CounterSeeder::class,
            \Database\Seeders\Utility\PrivacyPolicySeeder::class,
            \Database\Seeders\Utility\RefundPolicySeeder::class,
            \Database\Seeders\Utility\TermsAndConditionSeeder::class,
            \Database\Seeders\Content\CmsSettingsSeeder::class,
            \Database\Seeders\Content\BlogCategorySeeder::class,
            \Database\Seeders\Content\AdminFaqSeeder::class,
            \Database\Seeders\Feature\FeatureSeeder::class,

            // Categories
            \Database\Seeders\Category\CategorySeeder::class,
            \Database\Seeders\Category\SubCategorySeeder::class,

            // Hosts & Vendors
            \Database\Seeders\Host\HostSeeder::class,
            \Database\Seeders\Vendor\VendorSeeder::class,

            // Businesses (depends on vendors & categories)
            \Database\Seeders\Business\BusinessSeeder::class,

            // Vendor Packages & Timings (depends on vendors/businesses)
            \Database\Seeders\Vendor\VendorPackageSeeder::class,
            \Database\Seeders\Vendor\VendorTimingSeeder::class,

            // Business related (packages, services, venues, extra services)
            \Database\Seeders\Business\PackageSeeder::class,
            \Database\Seeders\Business\ServiceSeeder::class,
            \Database\Seeders\Business\VenueSeeder::class,
            \Database\Seeders\Feature\ExtraServiceSeeder::class,

            // Timing (depends on businesses)
            \Database\Seeders\Timing\TimingSeeder::class,
            \Database\Seeders\Timing\ChecklistTemplateSeeder::class,
            \Database\Seeders\Timing\ChecklistSeeder::class,
            \Database\Seeders\Timing\PersonalizedChecklistSeeder::class,

            // Host budgets & sessions (depends on hosts)
            \Database\Seeders\Host\BudgetSeeder::class,
            \Database\Seeders\Host\HostSessionSeeder::class,

            // Subscriptions & Plans
            \Database\Seeders\Subscription\PlanSeeder::class,
            \Database\Seeders\Subscription\CreditPlanSeeder::class,
            \Database\Seeders\Feature\AdminPackageSeeder::class,

            // Many-to-many feature relationships
            \Database\Seeders\Feature\FeaturePackageSeeder::class,
            \Database\Seeders\Feature\FeaturePlanSeeder::class,

            // Bookings (depends on hosts, businesses, vendors, packages)
            \Database\Seeders\Booking\BookingSeeder::class,

            // Invoices & Transactions (depends on bookings)
            \Database\Seeders\Booking\InvoiceSeeder::class,
            \Database\Seeders\Booking\TransactionSeeder::class,

            // Reviews (depends on hosts & businesses)
            \Database\Seeders\Booking\ReviewSeeder::class,
            \Database\Seeders\Booking\ReviewReplySeeder::class,

            // Guests & Favourites (depends on hosts & businesses)
            \Database\Seeders\Guest\GuestSeeder::class,
            \Database\Seeders\Guest\GuestGroupSeeder::class,
            \Database\Seeders\Guest\FavouriteSeeder::class,

            // Communication (depends on various models)
            \Database\Seeders\Communication\ChatSeeder::class,
            \Database\Seeders\Communication\MessageSeeder::class,
            \Database\Seeders\Communication\NotificationSeeder::class,
            \Database\Seeders\Communication\SupportQuerySeeder::class,

            // Blogs (depends on blog categories)
            \Database\Seeders\Content\BlogSeeder::class,
            \Database\Seeders\Content\AdminFaqSeeder::class,

            // Analytics (depends on businesses)
            \Database\Seeders\Analytics\BusinessViewSeeder::class,
            \Database\Seeders\Analytics\BusinessSocialClickSeeder::class,

            // Subscription transactions (depends on businesses & plans)
            \Database\Seeders\Subscription\PlanTransactionSeeder::class,
            \Database\Seeders\Subscription\SubscriptionSeeder::class,
            \Database\Seeders\Subscription\SubscriptionFeatureSeeder::class,
            \Database\Seeders\Subscription\CreditsTransactionSeeder::class,
        ]);
    }
}