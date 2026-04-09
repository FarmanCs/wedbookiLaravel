{{-- resources/views/livewire/vendor/dashboard/vendor-dashboard.blade.php --}}
<div class="vd-root">

    {{-- ========== BACKGROUND CANVAS ========== --}}
    <div class="vd-bg-canvas" aria-hidden="true">
        <div class="vd-bg-orb vd-bg-orb--1"></div>
        <div class="vd-bg-orb vd-bg-orb--2"></div>
        <div class="vd-bg-orb vd-bg-orb--3"></div>
        <div class="vd-bg-grid"></div>
    </div>

    <div class="vd-container">

        {{-- ========== FLASH MESSAGES ========== --}}
        @if (session('success'))
            <div class="vd-flash vd-flash--success" x-data x-init="setTimeout(() => $el.remove(), 4500)">
                <div class="vd-flash__icon">
                    <x-heroicon-s-check-circle />
                </div>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="vd-flash__close">
                    <x-heroicon-s-x-mark />
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="vd-flash vd-flash--error" x-data x-init="setTimeout(() => $el.remove(), 4500)">
                <div class="vd-flash__icon">
                    <x-heroicon-s-exclamation-circle />
                </div>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="vd-flash__close">
                    <x-heroicon-s-x-mark />
                </button>
            </div>
        @endif

        {{-- ========== HERO / WELCOME CARD (Updated with small icons, no shimmer line) ========== --}}
        <div class="vd-hero vd-animate" style="--delay:0s">
            {{-- Top border is now static gradient (no animation) --}}
            <div class="vd-hero__inner">
                <div class="vd-hero__content">
                    <p class="vd-hero__eyebrow">
                        <x-heroicon-s-star class="vd-hero__eyebrow-icon" />
                        Welcome back to WedbookI
                    </p>
                    <h1 class="vd-hero__title">{{ $vendor->full_name ?? 'Vendor' }}</h1>

                    {{-- Enhanced bio section with small info icons --}}
                    <div class="vd-hero__bio">
                        <p class="vd-hero__bio-text">
                            {{ $vendor->about ?: 'No description provided yet. Add your bio to let clients know who you are.' }}
                        </p>
                        <div class="vd-hero__meta">
                            @if ($vendor->email)
                                <div class="vd-hero__meta-item">
                                    <x-heroicon-s-envelope class="vd-hero__meta-icon" />
                                    <span>{{ $vendor->email }}</span>
                                </div>
                            @endif
                            @if ($vendor->phone_no)
                                <div class="vd-hero__meta-item">
                                    <x-heroicon-s-phone class="vd-hero__meta-icon" />
                                    <span>{{ $vendor->country_code }} {{ $vendor->phone_no }}</span>
                                </div>
                            @endif
                            @if ($vendor->city || $vendor->country)
                                <div class="vd-hero__meta-item">
                                    <x-heroicon-s-map-pin class="vd-hero__meta-icon" />
                                    <span>{{ collect([$vendor->city, $vendor->country])->filter()->join(', ') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="vd-hero__actions">
                        <button wire:click="openProfileModal" class="vd-btn vd-btn--primary">
                            <x-heroicon-s-pencil-square />
                            Edit Profile
                        </button>
                    </div>
                </div>
                <div class="vd-hero__avatar-wrap">
                    <div class="vd-hero__avatar-ring"></div>
                    <div class="vd-hero__avatar">{{ $vendor->initials() }}</div>
                    <div class="vd-hero__avatar-badge">
                        <x-heroicon-s-check-badge />
                    </div>
                </div>
            </div>

            {{-- Upcoming Events Strip --}}
            @if (!empty($upcomingEvents))
                <div class="vd-hero__events">
                    <div class="vd-hero__events-label">
                        <x-heroicon-s-calendar />
                        Upcoming Events
                    </div>
                    <div class="vd-events-grid">
                        @foreach ($upcomingEvents as $event)
                            <div class="vd-event-card">
                                <div class="vd-event-card__days">{{ $event['days_until'] }}<span>d</span></div>
                                <div class="vd-event-card__info">
                                    <p class="vd-event-card__name">{{ $event['host_name'] }}</p>
                                    <p class="vd-event-card__date">
                                        {{ \Carbon\Carbon::parse($event['event_date'])->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- ========== STATS ROW ========== --}}
        <div class="vd-stats-row">
            <div class="vd-stat vd-stat--rose vd-animate" style="--delay:.08s">
                <div class="vd-stat__icon">
                    <x-heroicon-s-eye />
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Page Visitors</span>
                    <span class="vd-stat__value">{{ number_format($pageVisitors) }}</span>
                </div>
                <span class="vd-stat__badge">+12%</span>
            </div>
            <div class="vd-stat vd-stat--amber vd-animate" style="--delay:.14s">
                <div class="vd-stat__icon">
                    <x-heroicon-s-document-text />
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Total Bookings</span>
                    <span class="vd-stat__value">{{ number_format($totalBookings) }}</span>
                </div>
                <span class="vd-stat__badge">+8%</span>
            </div>
            <div class="vd-stat vd-stat--emerald vd-animate" style="--delay:.20s">
                <div class="vd-stat__icon">
                    <x-heroicon-s-currency-dollar />
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Total Revenue</span>
                    <span class="vd-stat__value">Rs {{ number_format($totalRevenue, 0) }}</span>
                </div>
                <span class="vd-stat__badge">+5%</span>
            </div>
            <div class="vd-stat vd-stat--violet vd-animate" style="--delay:.26s">
                <div class="vd-stat__icon">
                    <x-heroicon-s-share />
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Social Clicks</span>
                    <span class="vd-stat__value">{{ number_format($socialClicks) }}</span>
                </div>
                <span class="vd-stat__badge">+23%</span>
            </div>
        </div>

        {{-- ========== MAIN GRID ========== --}}
        <div class="vd-main-grid">

            {{-- LEFT: Bookings + Reviews --}}
            <div class="vd-left-col">

                {{-- Recent Bookings --}}
                <div class="vd-card vd-animate" style="--delay:.18s">
                    <div class="vd-card__header vd-card__header--green">
                        <div class="vd-card__header-left">
                            <div class="vd-card__icon vd-card__icon--green">
                                <x-heroicon-s-document-duplicate />
                            </div>
                            <div>
                                <h2 class="vd-card__title">Recent Bookings</h2>
                                <p class="vd-card__subtitle">Your latest booking requests</p>
                            </div>
                        </div>
                        <a href="{{ route('vendor.bookings') }}" class="vd-link">
                            View all
                            <x-heroicon-s-arrow-right />
                        </a>
                    </div>
                    <div class="vd-table-wrap">
                        <table class="vd-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                    <tr>
                                        <td class="vd-table__mono">{{ $booking['custom_id'] }}</td>
                                        <td class="vd-table__muted">{{ $booking['created'] }}</td>
                                        <td>
                                            @if ($booking['status_color'] === 'green')
                                                <span class="vd-badge vd-badge--green">
                                                    <span class="vd-badge__dot vd-badge__dot--pulse"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @else
                                                <span class="vd-badge vd-badge--red">
                                                    <span class="vd-badge__dot"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="vd-table__amount">{{ $booking['amount'] }}</td>
                                        <td>
                                            <button class="vd-icon-btn">
                                                <x-heroicon-s-ellipsis-horizontal />
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="vd-table__empty">
                                            <x-heroicon-s-inbox class="w-10 h-10 mx-auto opacity-40" />
                                            <p>No bookings yet</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Latest Reviews --}}
                <div class="vd-card vd-animate" style="--delay:.26s">
                    <div class="vd-card__header vd-card__header--amber">
                        <div class="vd-card__header-left">
                            <div class="vd-card__icon vd-card__icon--amber">
                                <x-heroicon-s-star />
                            </div>
                            <h2 class="vd-card__title">Latest Reviews</h2>
                        </div>
                    </div>
                    <div class="vd-card__body">
                        @if (empty($reviews))
                            <div class="vd-empty-state">
                                <x-heroicon-s-chat-bubble-left-right class="w-12 h-12 mx-auto opacity-35" />
                                <p>No reviews yet. Great work brings great reviews!</p>
                            </div>
                        @else
                            <div class="vd-reviews">
                                @foreach ($reviews as $review)
                                    <div class="vd-review">
                                        <div class="vd-review__avatar">{{ substr($review['name'], 0, 1) }}</div>
                                        <div class="vd-review__content">
                                            <div class="vd-review__top">
                                                <span class="vd-review__name">{{ $review['name'] }}</span>
                                                <div class="vd-stars">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <x-heroicon-s-star
                                                            class="{{ $i < $review['rating'] ? 'vd-star--filled' : 'vd-star--empty' }}" />
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="vd-review__comment">"{{ $review['comment'] }}"</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT: Actions + Credits + Rating --}}
            <div class="vd-right-col">

                {{-- Quick Actions --}}
                <div class="vd-card vd-animate" style="--delay:.22s">
                    <div class="vd-card__header">
                        <div class="vd-card__header-left">
                            <div class="vd-card__icon vd-card__icon--amber">
                                <x-heroicon-s-bolt />
                            </div>
                            <h2 class="vd-card__title">Quick Actions</h2>
                        </div>
                    </div>
                    <div class="vd-card__body">
                        <div class="vd-actions">
                            <button wire:click="openBusinessModal" class="vd-action vd-action--indigo">
                                <div class="vd-action__icon">
                                    <x-heroicon-s-building-office />
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Manage Businesses</span>
                                    <span class="vd-action__desc">Add or edit your businesses</span>
                                </div>
                                <x-heroicon-s-chevron-right class="vd-action__arrow" />
                            </button>
                            <button wire:click="openAvailabilityModal" class="vd-action vd-action--emerald">
                                <div class="vd-action__icon">
                                    <x-heroicon-s-calendar-days />
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Update Availability</span>
                                    <span class="vd-action__desc">Set your available dates</span>
                                </div>
                                <x-heroicon-s-chevron-right class="vd-action__arrow" />
                            </button>
                            <a href="{{ route('vendor.packages') }}" class="vd-action vd-action--sky">
                                <div class="vd-action__icon">
                                    <x-heroicon-s-cube />
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Create Package</span>
                                    <span class="vd-action__desc">Define your service packages</span>
                                </div>
                                <x-heroicon-s-chevron-right class="vd-action__arrow" />
                            </a>
                            <button wire:click="openMessageModal" class="vd-action vd-action--violet">
                                <div class="vd-action__icon">
                                    <x-heroicon-s-chat-bubble-left-ellipsis />
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Message Clients</span>
                                    <span class="vd-action__desc">Respond to inquiries</span>
                                </div>
                                <x-heroicon-s-chevron-right class="vd-action__arrow" />
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Credits Card --}}
                <div class="vd-credits-card vd-animate" style="--delay:.30s">
                    <div class="vd-credits-card__shine"></div>
                    <div class="vd-credits-card__orb vd-credits-card__orb--1"></div>
                    <div class="vd-credits-card__orb vd-credits-card__orb--2"></div>
                    <div class="vd-credits-card__inner">
                        <div class="vd-credits-card__header">
                            <span class="vd-credits-card__label">Available Credits</span>
                            <div class="vd-credits-card__badge">
                                <x-heroicon-s-currency-dollar />
                            </div>
                        </div>
                        <div class="vd-credits-card__amount">{{ number_format($credits, 0) }}</div>
                        <p class="vd-credits-card__hint">Credits available to use</p>
                        <a href="{{ route('vendor.credits') }}" class="vd-credits-card__btn">
                            Purchase more credits
                            <x-heroicon-s-arrow-right />
                        </a>
                    </div>
                </div>

                {{-- Rating Summary --}}
                <div class="vd-card vd-rating-card vd-animate" style="--delay:.36s">
                    <h3 class="vd-rating-card__title">Overall Rating</h3>
                    <div class="vd-rating-card__score">
                        <span class="vd-rating-card__number">{{ number_format($rating, 1) }}</span>
                        <span class="vd-rating-card__max">/5</span>
                    </div>
                    <div class="vd-stars vd-stars--lg">
                        @for ($i = 0; $i < 5; $i++)
                            <x-heroicon-s-star
                                class="{{ $i < floor($rating) ? 'vd-star--filled' : 'vd-star--empty' }}" />
                        @endfor
                    </div>
                    <p class="vd-rating-card__count">{{ $ratingCount }} {{ Str::plural('review', $ratingCount) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== MODALS ========== --}}

    {{-- Availability Modal --}}
    @if ($showAvailabilityModal)
        <div class="vd-modal-backdrop" wire:click.self="closeAvailabilityModal">
            <div class="vd-modal">
                <div class="vd-modal__header vd-modal__header--green">
                    <div class="vd-modal__header-icon">
                        <x-heroicon-s-calendar-days />
                    </div>
                    <h2 class="vd-modal__title">Update Availability</h2>
                    <button wire:click="closeAvailabilityModal" class="vd-modal__close">
                        <x-heroicon-s-x-mark />
                    </button>
                </div>
                <div class="vd-modal__body">
                    <div class="vd-field">
                        <label class="vd-label">Select Business</label>
                        <select wire:model="selectedBusiness" class="vd-select">
                            <option value="">Choose a business</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Slot Duration (minutes)</label>
                        <input type="number" wire:model="slotDuration" min="15" max="480"
                            class="vd-input" placeholder="60" />
                    </div>
                    <div class="vd-notice vd-notice--green">
                        <x-heroicon-s-information-circle />
                        Set your availability slot duration for bookings.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeAvailabilityModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveAvailability" class="vd-btn vd-btn--green">
                        <x-heroicon-s-check />
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Message Modal --}}
    @if ($showMessageModal)
        <div class="vd-modal-backdrop" wire:click.self="closeMessageModal">
            <div class="vd-modal">
                <div class="vd-modal__header vd-modal__header--violet">
                    <div class="vd-modal__header-icon">
                        <x-heroicon-s-chat-bubble-left-ellipsis />
                    </div>
                    <h2 class="vd-modal__title">Message Clients</h2>
                    <button wire:click="closeMessageModal" class="vd-modal__close">
                        <x-heroicon-s-x-mark />
                    </button>
                </div>
                <div class="vd-modal__body">
                    <div class="vd-field">
                        <label class="vd-label">Subject</label>
                        <input type="text" wire:model="messageSubject" class="vd-input"
                            placeholder="Message subject..." />
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Message</label>
                        <textarea wire:model="messageBody" rows="5" class="vd-textarea" placeholder="Your message here..."></textarea>
                    </div>
                    <div class="vd-notice vd-notice--violet">
                        <x-heroicon-s-information-circle />
                        Your message will be sent to interested clients.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeMessageModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="sendMessage" class="vd-btn vd-btn--violet">
                        <x-heroicon-s-paper-airplane />
                        Send Message
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit Profile Modal --}}
    @if ($showProfileModal)
        <div class="vd-modal-backdrop" wire:click.self="closeProfileModal">
            <div class="vd-modal vd-modal--tall">
                <div class="vd-modal__header vd-modal__header--indigo">
                    <div class="vd-modal__header-icon">
                        <x-heroicon-c-square-3-stack-3d />
                    </div>
                    <h2 class="vd-modal__title">Edit Profile</h2>
                    <button wire:click="closeProfileModal" class="vd-modal__close">
                        <x-heroicon-s-x-mark />
                    </button>
                </div>
                <div class="vd-modal__body vd-modal__body--scroll">
                    <div class="vd-field">
                        <label class="vd-label">Full Name</label>
                        <input type="text" wire:model="profile.full_name" class="vd-input" />
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Email</label>
                        <input type="email" wire:model="profile.email" class="vd-input" />
                    </div>
                    <div class="vd-field-row">
                        <div class="vd-field">
                            <label class="vd-label">Phone</label>
                            <input type="text" wire:model="profile.phone_no" class="vd-input" />
                        </div>
                        <div class="vd-field vd-field--sm">
                            <label class="vd-label">Country Code</label>
                            <input type="text" wire:model="profile.country_code" class="vd-input" />
                        </div>
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">About</label>
                        <textarea wire:model="profile.about" rows="3" class="vd-textarea"></textarea>
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Profile Image</label>
                        <input type="file" wire:model="profile_image" class="vd-file-input" />
                        @if ($profile_image_preview)
                            <img src="{{ $profile_image_preview }}" class="vd-img-preview" />
                        @endif
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeProfileModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveProfile" class="vd-btn vd-btn--indigo">
                        <x-heroicon-s-check />
                        Save Profile
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Manage Business Modal --}}
    @if ($showBusinessModal)
        <div class="vd-modal-backdrop" wire:click.self="closeBusinessModal">
            <div class="vd-modal vd-modal--tall">
                <div class="vd-modal__header vd-modal__header--indigo">
                    <div class="vd-modal__header-icon">
                        <x-heroicon-s-building-office />
                    </div>
                    <h2 class="vd-modal__title">{{ isset($businessForm['id']) ? 'Edit' : 'Add' }} Business</h2>
                    <button wire:click="closeBusinessModal" class="vd-modal__close">
                        <x-heroicon-s-x-mark />
                    </button>
                </div>
                <div class="vd-modal__body vd-modal__body--scroll">
                    <div class="vd-field">
                        <label class="vd-label">Business Name</label>
                        <input type="text" wire:model="businessForm.company_name" class="vd-input"
                            placeholder="e.g., Grand Marquee" />
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Category</label>
                        <select wire:model="businessForm.category_id" class="vd-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Description</label>
                        <textarea wire:model="businessForm.business_desc" rows="3" class="vd-textarea"
                            placeholder="Describe your business..."></textarea>
                    </div>
                    <div class="vd-field-row">
                        <div class="vd-field">
                            <label class="vd-label">Business Email</label>
                            <input type="email" wire:model="businessForm.business_email" class="vd-input"
                                placeholder="contact@example.com" />
                        </div>
                        <div class="vd-field">
                            <label class="vd-label">Business Phone</label>
                            <input type="text" wire:model="businessForm.business_phone" class="vd-input"
                                placeholder="+92 300 1234567" />
                        </div>
                    </div>
                    <div class="vd-field">
                        <label class="vd-label">Street Address</label>
                        <input type="text" wire:model="businessForm.street_address" class="vd-input"
                            placeholder="123 Main St" />
                    </div>
                    <div class="vd-field-row">
                        <div class="vd-field">
                            <label class="vd-label">City</label>
                            <input type="text" wire:model="businessForm.city" class="vd-input"
                                placeholder="Lahore" />
                        </div>
                        <div class="vd-field">
                            <label class="vd-label">Country</label>
                            <input type="text" wire:model="businessForm.country" class="vd-input"
                                placeholder="Pakistan" />
                        </div>
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeBusinessModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveBusiness" class="vd-btn vd-btn--indigo">
                        <x-heroicon-s-check />
                        {{ isset($businessForm['id']) ? 'Update' : 'Create' }} Business
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Boost Modal --}}
    @if ($showBoostModal)
        <div class="vd-modal-backdrop" wire:click.self="closeBoostModal">
            <div class="vd-modal">
                <div class="vd-modal__header vd-modal__header--amber">
                    <div class="vd-modal__header-icon">
                        <x-heroicon-s-rocket-launch />
                    </div>
                    <h2 class="vd-modal__title">Boost Your Business</h2>
                    <button wire:click="closeBoostModal" class="vd-modal__close">
                        <x-heroicon-s-x-mark />
                    </button>
                </div>
                <div class="vd-modal__body">
                    <div class="vd-field">
                        <label class="vd-label">Select Business to Boost</label>
                        <select wire:model="boostBusinessId" class="vd-select">
                            <option value="">Choose a business</option>
                            @foreach ($boostBusinesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vd-notice vd-notice--amber">
                        <x-heroicon-s-information-circle />
                        Boosting makes your business appear more prominently in search results.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeBoostModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="confirmBoost" class="vd-btn vd-btn--amber">
                        <x-heroicon-s-check />
                        Confirm Boost
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        /* ===== DESIGN TOKENS ===== */
        :root {
            --vd-font: 'Outfit', system-ui, -apple-system, sans-serif;
            --vd-bg: #f9f8fe;
            --vd-surface: #ffffff;
            --vd-surface-alt: #f5f3ff;
            --vd-border: rgba(110, 90, 200, 0.08);
            --vd-border-hover: rgba(110, 90, 200, 0.18);
            --vd-text-primary: #18152e;
            --vd-text-secondary: #55507a;
            --vd-text-muted: #8a86a8;
            --vd-radius-sm: 12px;
            --vd-radius-md: 16px;
            --vd-radius-lg: 24px;
            --vd-radius-xl: 32px;
            --vd-shadow-sm: 0 2px 8px rgba(80, 70, 150, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
            --vd-shadow-md: 0 8px 20px -6px rgba(80, 70, 150, 0.12), 0 2px 6px rgba(0, 0, 0, 0.02);
            --vd-shadow-lg: 0 20px 35px -12px rgba(80, 70, 150, 0.18), 0 4px 10px -2px rgba(0, 0, 0, 0.03);
            --vd-glass-bg: rgba(255, 255, 255, 0.75);
            --vd-glass-border: rgba(255, 255, 255, 0.5);
            /* accent palette */
            --c-rose: #f43f5e;
            --c-rose-bg: #fff1f4;
            --c-rose-border: rgba(244, 63, 94, 0.12);
            --c-amber: #f59e0b;
            --c-amber-bg: #fffbeb;
            --c-amber-border: rgba(245, 158, 11, 0.12);
            --c-emerald: #10b981;
            --c-emerald-bg: #f0fdf9;
            --c-emerald-border: rgba(16, 185, 129, 0.12);
            --c-violet: #8b5cf6;
            --c-violet-bg: #f5f3ff;
            --c-violet-border: rgba(139, 92, 246, 0.12);
            --c-indigo: #6366f1;
            --c-indigo-bg: #eef2ff;
            --c-indigo-border: rgba(99, 102, 241, 0.12);
            --c-sky: #0ea5e9;
            --c-sky-bg: #f0f9ff;
            --c-sky-border: rgba(14, 165, 233, 0.12);
            --c-green: #22c55e;
            --c-green-bg: #f0fdf4;
            --c-green-border: rgba(34, 197, 94, 0.12);
        }

        .dark {
            --vd-bg: #0b0a15;
            --vd-surface: #131124;
            --vd-surface-alt: #1a1730;
            --vd-border: rgba(140, 120, 220, 0.12);
            --vd-border-hover: rgba(140, 120, 220, 0.25);
            --vd-text-primary: #ede9ff;
            --vd-text-secondary: #9d97c4;
            --vd-text-muted: #6b668f;
            --vd-glass-bg: rgba(19, 17, 36, 0.7);
            --vd-glass-border: rgba(255, 255, 255, 0.05);
            --c-rose-bg: rgba(244, 63, 94, 0.08);
            --c-amber-bg: rgba(245, 158, 11, 0.08);
            --c-emerald-bg: rgba(16, 185, 129, 0.08);
            --c-violet-bg: rgba(139, 92, 246, 0.08);
            --c-indigo-bg: rgba(99, 102, 241, 0.08);
            --c-sky-bg: rgba(14, 165, 233, 0.08);
            --c-green-bg: rgba(34, 197, 94, 0.08);
        }

        /* ===== ROOT ===== */
        .vd-root {
            font-family: var(--vd-font);
            min-height: 100vh;
            background: var(--vd-bg);
            color: var(--vd-text-primary);
            position: relative;
            overflow-x: hidden;
        }

        /* ===== BACKGROUND CANVAS ===== */
        .vd-bg-canvas {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .vd-bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            will-change: transform;
        }

        .vd-bg-orb--1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #a78bfa 0%, transparent 70%);
            top: -150px;
            right: -150px;
            animation: orb-drift 25s ease-in-out infinite;
        }

        .vd-bg-orb--2 {
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #34d399 0%, transparent 70%);
            bottom: 10%;
            left: -100px;
            animation: orb-drift 28s ease-in-out infinite reverse;
        }

        .vd-bg-orb--3 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
            top: 45%;
            right: 20%;
            animation: orb-drift 20s ease-in-out infinite 4s;
        }

        .vd-bg-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(var(--vd-border) 1px, transparent 1px), linear-gradient(90deg, var(--vd-border) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
        }

        @keyframes orb-drift {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(40px, -50px) scale(1.05);
            }

            66% {
                transform: translate(-30px, 30px) scale(0.95);
            }
        }

        /* ===== CONTAINER ===== */
        .vd-container {
            max-width: 1340px;
            margin: 0 auto;
            padding: 32px 28px;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes spin-slow {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shimmer {
            from {
                transform: translateX(-100%) rotate(25deg);
            }

            to {
                transform: translateX(200%) rotate(25deg);
            }
        }

        .vd-animate {
            opacity: 0;
            animation: fade-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) var(--delay, 0s) forwards;
        }

        /* ===== FLASH MESSAGES ===== */
        .vd-flash {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            backdrop-filter: blur(8px);
            background: var(--vd-glass-bg);
            font-size: 0.875rem;
            font-weight: 500;
            animation: slide-down 0.3s ease forwards;
            box-shadow: var(--vd-shadow-sm);
        }

        .vd-flash--success {
            background: var(--c-emerald-bg);
            border-color: var(--c-emerald-border);
            color: #065f46;
        }

        .dark .vd-flash--success {
            color: #6ee7b7;
        }

        .vd-flash--error {
            background: var(--c-rose-bg);
            border-color: var(--c-rose-border);
            color: #9f1239;
        }

        .dark .vd-flash--error {
            color: #fda4af;
        }

        .vd-flash__icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .vd-flash span {
            flex: 1;
        }

        .vd-flash__close {
            width: 20px;
            height: 20px;
            opacity: 0.6;
            cursor: pointer;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.15s;
        }

        .vd-flash__close:hover {
            opacity: 1;
        }

        /* ===== HERO (Updated: no shimmer line, small info icons) ===== */
        .vd-hero {
            background: var(--vd-glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--vd-glass-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: var(--vd-shadow-lg);
            overflow: hidden;
            position: relative;
        }

        /* Static gradient top border (no animation) */
        .vd-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8b5cf6, #6366f1, #0ea5e9, #10b981, #f59e0b);
        }

        .vd-hero__inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: center;
            padding: 44px 48px;
        }

        @media (max-width: 768px) {
            .vd-hero__inner {
                grid-template-columns: 1fr;
                padding: 32px 28px;
            }
        }

        .vd-hero__eyebrow {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--c-violet);
            margin-bottom: 10px;
        }

        .vd-hero__eyebrow-icon {
            width: 14px;
            height: 14px;
        }

        .vd-hero__title {
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 40%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 18px;
        }

        .vd-hero__bio {
            max-width: 480px;
            margin-bottom: 28px;
            padding: 16px 18px;
            background: var(--vd-surface-alt);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-md);
        }

        .vd-hero__bio-text {
            font-size: 0.9375rem;
            line-height: 1.6;
            color: var(--vd-text-secondary);
            margin-bottom: 14px;
        }

        .vd-hero__meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .vd-hero__meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8125rem;
            color: var(--vd-text-muted);
        }

        .vd-hero__meta-icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: var(--c-violet);
        }

        .vd-hero__avatar-wrap {
            position: relative;
            width: 160px;
            height: 160px;
            flex-shrink: 0;
        }

        .vd-hero__avatar-ring {
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #8b5cf6, #6366f1, #0ea5e9, #10b981, #8b5cf6);
            animation: spin-slow 10s linear infinite;
            opacity: 0.8;
        }

        .vd-hero__avatar {
            position: absolute;
            inset: 6px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--c-violet-bg), var(--c-indigo-bg));
            border: 3px solid var(--vd-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 800;
            color: var(--c-violet);
            letter-spacing: -0.02em;
        }

        .vd-hero__avatar-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--c-amber), #ea580c);
            border: 2px solid var(--vd-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .vd-hero__avatar-badge svg {
            width: 16px;
            height: 16px;
        }

        .vd-hero__events {
            border-top: 1px solid var(--vd-border);
            padding: 24px 48px;
            background: var(--vd-surface-alt);
        }

        .vd-hero__events-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--vd-text-muted);
            margin-bottom: 16px;
        }

        .vd-events-grid {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .vd-event-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-md);
            min-width: 220px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .vd-event-card:hover {
            border-color: var(--vd-border-hover);
            box-shadow: var(--vd-shadow-sm);
        }

        .vd-event-card__days {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--c-violet);
            line-height: 1;
            min-width: 40px;
        }

        .vd-event-card__days span {
            font-size: 0.875rem;
            font-weight: 600;
            opacity: 0.7;
        }

        .vd-event-card__name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--vd-text-primary);
        }

        .vd-event-card__date {
            font-size: 0.75rem;
            color: var(--vd-text-muted);
            margin-top: 2px;
        }

        /* ===== BUTTON SYSTEM ===== */
        .vd-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: var(--vd-radius-sm);
            font-size: 0.875rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            text-decoration: none;
            backdrop-filter: blur(4px);
        }

        .vd-btn svg {
            width: 16px;
            height: 16px;
        }

        .vd-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -6px rgba(0, 0, 0, 0.1);
        }

        .vd-btn:active {
            transform: translateY(0);
        }

        .vd-btn--primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        }

        .vd-btn--ghost {
            background: var(--vd-surface-alt);
            border-color: var(--vd-border);
            color: var(--vd-text-secondary);
        }

        .vd-btn--green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .vd-btn--indigo {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
        }

        .vd-btn--violet {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .vd-btn--amber {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        /* ===== STATS ROW ===== */
        .vd-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        @media (max-width: 900px) {
            .vd-stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .vd-stats-row {
                grid-template-columns: 1fr;
            }
        }

        .vd-stat {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            background: var(--vd-glass-bg);
            backdrop-filter: blur(8px);
            border: 1px solid var(--vd-glass-border);
            border-radius: var(--vd-radius-lg);
            box-shadow: var(--vd-shadow-sm);
            transition: all 0.2s;
        }

        .vd-stat:hover {
            border-color: var(--vd-border-hover);
            box-shadow: var(--vd-shadow-md);
            transform: translateY(-2px);
        }

        .vd-stat__icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .vd-stat:hover .vd-stat__icon {
            transform: scale(1.05);
        }

        .vd-stat__icon svg {
            width: 22px;
            height: 22px;
            color: white;
        }

        .vd-stat--rose .vd-stat__icon {
            background: linear-gradient(135deg, var(--c-rose), #fb7185);
        }

        .vd-stat--amber .vd-stat__icon {
            background: linear-gradient(135deg, var(--c-amber), #fbbf24);
        }

        .vd-stat--emerald .vd-stat__icon {
            background: linear-gradient(135deg, var(--c-emerald), #34d399);
        }

        .vd-stat--violet .vd-stat__icon {
            background: linear-gradient(135deg, var(--c-violet), #a78bfa);
        }

        .vd-stat__body {
            flex: 1;
        }

        .vd-stat__label {
            font-size: 0.75rem;
            color: var(--vd-text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .vd-stat__value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--vd-text-primary);
            letter-spacing: -0.02em;
        }

        .vd-stat__badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 999px;
            background: var(--c-emerald-bg);
            color: var(--c-emerald);
            border: 1px solid var(--c-emerald-border);
        }

        /* ===== MAIN GRID ===== */
        .vd-main-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 1024px) {
            .vd-main-grid {
                grid-template-columns: 1fr;
            }
        }

        .vd-left-col,
        .vd-right-col {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* ===== CARD ===== */
        .vd-card {
            background: var(--vd-glass-bg);
            backdrop-filter: blur(8px);
            border: 1px solid var(--vd-glass-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: var(--vd-shadow-sm);
            overflow: hidden;
            transition: all 0.2s;
        }

        .vd-card:hover {
            border-color: var(--vd-border-hover);
            box-shadow: var(--vd-shadow-md);
        }

        .vd-card__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--vd-border);
            background: var(--vd-surface-alt);
        }

        .vd-card__header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .vd-card__icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vd-card__icon svg {
            width: 18px;
            height: 18px;
            color: white;
        }

        .vd-card__icon--green {
            background: linear-gradient(135deg, var(--c-green), #16a34a);
        }

        .vd-card__icon--amber {
            background: linear-gradient(135deg, var(--c-amber), #d97706);
        }

        .vd-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--vd-text-primary);
        }

        .vd-card__subtitle {
            font-size: 0.75rem;
            color: var(--vd-text-muted);
            margin-top: 2px;
        }

        .vd-card__body {
            padding: 24px;
        }

        /* ===== TABLE ===== */
        .vd-table-wrap {
            overflow-x: auto;
        }

        .vd-table {
            width: 100%;
            font-size: 0.8125rem;
            border-collapse: collapse;
        }

        .vd-table th {
            padding: 12px 20px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--vd-text-muted);
        }

        .vd-table td {
            padding: 14px 20px;
            border-top: 1px solid var(--vd-border);
            color: var(--vd-text-primary);
        }

        .vd-table tbody tr:hover {
            background: var(--vd-surface-alt);
        }

        .vd-table__mono {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
        }

        .vd-table__muted {
            color: var(--vd-text-muted);
        }

        .vd-table__amount {
            font-weight: 700;
        }

        .vd-table__empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--vd-text-muted);
        }

        .vd-table__empty p {
            margin-top: 12px;
            font-size: 0.875rem;
        }

        /* ===== BADGE ===== */
        .vd-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid;
        }

        .vd-badge__dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .vd-badge--green {
            background: var(--c-green-bg);
            color: #166534;
            border-color: var(--c-green-border);
        }

        .dark .vd-badge--green {
            color: #86efac;
        }

        .vd-badge--red {
            background: var(--c-rose-bg);
            color: #9f1239;
            border-color: var(--c-rose-border);
        }

        .dark .vd-badge--red {
            color: #fda4af;
        }

        .vd-badge__dot--pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* ===== ICON BTN ===== */
        .vd-icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vd-text-muted);
            transition: background 0.15s, color 0.15s;
        }

        .vd-icon-btn:hover {
            background: var(--vd-surface-alt);
            color: var(--vd-text-primary);
        }

        .vd-icon-btn svg {
            width: 18px;
            height: 18px;
        }

        /* ===== REVIEWS ===== */
        .vd-reviews {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .vd-review {
            display: flex;
            gap: 14px;
            padding: 16px;
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-md);
            background: var(--vd-surface-alt);
            transition: border-color 0.2s;
        }

        .vd-review:hover {
            border-color: var(--vd-border-hover);
        }

        .vd-review__avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .vd-review__top {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }

        .vd-review__name {
            font-size: 0.875rem;
            font-weight: 600;
        }

        .vd-review__comment {
            font-size: 0.8125rem;
            color: var(--vd-text-secondary);
            line-height: 1.55;
        }

        /* ===== STARS ===== */
        .vd-stars {
            display: flex;
            gap: 2px;
        }

        .vd-stars svg {
            width: 14px;
            height: 14px;
        }

        .vd-stars--lg svg {
            width: 22px;
            height: 22px;
        }

        .vd-star--filled {
            color: #f59e0b;
        }

        .vd-star--empty {
            color: #d1d5db;
        }

        .dark .vd-star--empty {
            color: #374151;
        }

        /* ===== EMPTY STATE ===== */
        .vd-empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 44px 20px;
            color: var(--vd-text-muted);
            text-align: center;
        }

        .vd-empty-state p {
            font-size: 0.875rem;
            max-width: 240px;
        }

        /* ===== QUICK ACTIONS ===== */
        .vd-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .vd-action {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            cursor: pointer;
            background: none;
            width: 100%;
            text-align: left;
            text-decoration: none;
            transition: all 0.2s;
        }

        .vd-action:hover {
            box-shadow: var(--vd-shadow-sm);
            transform: translateX(4px);
        }

        .vd-action--indigo {
            background: var(--c-indigo-bg);
            border-color: var(--c-indigo-border);
        }

        .vd-action--emerald {
            background: var(--c-emerald-bg);
            border-color: var(--c-emerald-border);
        }

        .vd-action--sky {
            background: var(--c-sky-bg);
            border-color: var(--c-sky-border);
        }

        .vd-action--violet {
            background: var(--c-violet-bg);
            border-color: var(--c-violet-border);
        }

        .vd-action__icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .vd-action:hover .vd-action__icon {
            transform: scale(1.08);
        }

        .vd-action__icon svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .vd-action--indigo .vd-action__icon {
            background: linear-gradient(135deg, var(--c-indigo), #4f46e5);
        }

        .vd-action--emerald .vd-action__icon {
            background: linear-gradient(135deg, var(--c-emerald), #059669);
        }

        .vd-action--sky .vd-action__icon {
            background: linear-gradient(135deg, var(--c-sky), #0284c7);
        }

        .vd-action--violet .vd-action__icon {
            background: linear-gradient(135deg, var(--c-violet), #7c3aed);
        }

        .vd-action__text {
            flex: 1;
        }

        .vd-action__title {
            display: block;
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--vd-text-primary);
        }

        .vd-action__desc {
            display: block;
            font-size: 0.75rem;
            color: var(--vd-text-muted);
            margin-top: 2px;
        }

        .vd-action__arrow {
            width: 18px;
            height: 18px;
            color: var(--vd-text-muted);
            transition: transform 0.2s;
        }

        .vd-action:hover .vd-action__arrow {
            transform: translateX(4px);
        }

        /* ===== CREDITS CARD ===== */
        .vd-credits-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--vd-radius-xl);
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
            box-shadow: 0 12px 40px rgba(99, 102, 241, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .vd-credits-card__shine {
            position: absolute;
            top: -30%;
            left: -20%;
            width: 60%;
            height: 160%;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
            transform: rotate(15deg);
            animation: shimmer 5s linear infinite;
            pointer-events: none;
        }

        .vd-credits-card__orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .vd-credits-card__orb--1 {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            top: -60px;
            right: -40px;
        }

        .vd-credits-card__orb--2 {
            width: 120px;
            height: 120px;
            background: rgba(0, 0, 0, 0.12);
            bottom: -30px;
            left: -20px;
        }

        .vd-credits-card__inner {
            position: relative;
            z-index: 1;
            padding: 32px;
        }

        .vd-credits-card__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .vd-credits-card__label {
            font-size: 0.9375rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
        }

        .vd-credits-card__badge {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .vd-credits-card__badge svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .vd-credits-card__amount {
            font-size: 3.8rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .vd-credits-card__hint {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 24px;
        }

        .vd-credits-card__btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: var(--vd-radius-md);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: all 0.2s;
        }

        .vd-credits-card__btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        .vd-credits-card__btn svg {
            width: 16px;
            height: 16px;
        }

        /* ===== RATING CARD ===== */
        .vd-rating-card .vd-card__body {
            text-align: center;
            padding: 32px 24px;
        }

        .vd-rating-card__title {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--vd-text-secondary);
            margin-bottom: 16px;
        }

        .vd-rating-card__score {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .vd-rating-card__number {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .vd-rating-card__max {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--vd-text-muted);
        }

        .vd-rating-card .vd-stars {
            justify-content: center;
            margin-bottom: 10px;
        }

        .vd-rating-card__count {
            font-size: 0.875rem;
            color: var(--vd-text-muted);
        }

        /* ===== MODALS ===== */
        .vd-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(10, 8, 20, 0.7);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1000;
            animation: fade-in 0.2s ease;
        }

        .vd-modal {
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 520px;
            animation: scale-in 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        .vd-modal--tall {
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .vd-modal__header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 28px;
            border-bottom: 1px solid var(--vd-border);
            background: var(--vd-surface-alt);
        }

        .vd-modal__header-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vd-modal__header-icon svg {
            width: 20px;
            height: 20px;
            color: white;
        }

        .vd-modal__header--green .vd-modal__header-icon {
            background: linear-gradient(135deg, var(--c-green), #16a34a);
        }

        .vd-modal__header--violet .vd-modal__header-icon {
            background: linear-gradient(135deg, var(--c-violet), #7c3aed);
        }

        .vd-modal__header--indigo .vd-modal__header-icon {
            background: linear-gradient(135deg, var(--c-indigo), #4f46e5);
        }

        .vd-modal__header--amber .vd-modal__header-icon {
            background: linear-gradient(135deg, var(--c-amber), #d97706);
        }

        .vd-modal__title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--vd-text-primary);
            flex: 1;
        }

        .vd-modal__close {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vd-text-muted);
            transition: background 0.15s;
        }

        .vd-modal__close:hover {
            background: var(--vd-border);
            color: var(--vd-text-primary);
        }

        .vd-modal__body {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .vd-modal__body--scroll {
            overflow-y: auto;
            flex: 1;
        }

        .vd-modal__footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 28px;
            border-top: 1px solid var(--vd-border);
            background: var(--vd-surface-alt);
        }

        /* ===== FORM FIELDS ===== */
        .vd-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .vd-field--sm {
            max-width: 130px;
        }

        .vd-field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .vd-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--vd-text-secondary);
            letter-spacing: 0.02em;
        }

        .vd-input,
        .vd-select,
        .vd-textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: var(--vd-radius-sm);
            border: 1px solid var(--vd-border);
            background: var(--vd-bg);
            color: var(--vd-text-primary);
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .vd-input:focus,
        .vd-select:focus,
        .vd-textarea:focus {
            border-color: var(--c-indigo);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .vd-textarea {
            resize: vertical;
        }

        .vd-file-input {
            font-size: 0.8125rem;
            color: var(--vd-text-secondary);
        }

        .vd-img-preview {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--vd-border);
            margin-top: 10px;
        }

        /* ===== NOTICE ===== */
        .vd-notice {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            font-size: 0.8125rem;
        }

        .vd-notice svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .vd-notice--green {
            background: var(--c-green-bg);
            border-color: var(--c-green-border);
            color: #166534;
        }

        .dark .vd-notice--green {
            color: #86efac;
        }

        .vd-notice--violet {
            background: var(--c-violet-bg);
            border-color: var(--c-violet-border);
            color: #5b21b6;
        }

        .dark .vd-notice--violet {
            color: #c4b5fd;
        }

        .vd-notice--amber {
            background: var(--c-amber-bg);
            border-color: var(--c-amber-border);
            color: #92400e;
        }

        .dark .vd-notice--amber {
            color: #fde68a;
        }

        /* ===== LINK ===== */
        .vd-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--c-emerald);
            text-decoration: none;
            transition: gap 0.2s;
        }

        .vd-link:hover {
            gap: 10px;
        }

        .vd-link svg {
            width: 14px;
            height: 14px;
        }
    </style>
</div>
