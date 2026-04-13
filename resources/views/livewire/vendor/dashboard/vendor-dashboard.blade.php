{{-- resources/views/livewire/vendor/dashboard/vendor-dashboard.blade.php --}}
<div class="vd-root">

    {{-- ========== AMBIENT BACKGROUND ========== --}}
    <div class="vd-ambient-bg">
        <div class="vd-blob vd-blob--1"></div>
        <div class="vd-blob vd-blob--2"></div>
        <div class="vd-blob vd-blob--3"></div>
        <div class="vd-mesh-gradient"></div>
    </div>

    <div class="vd-container">

        {{-- ========== FLASH MESSAGES ========== --}}
        @if (session('success'))
            <div class="vd-toast vd-toast--success" x-data x-init="setTimeout(() => $el.remove(), 4500)">
                <div class="vd-toast__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="vd-toast__content">
                    <p class="vd-toast__title">Success</p>
                    <p class="vd-toast__message">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="vd-toast__close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="vd-toast vd-toast--error" x-data x-init="setTimeout(() => $el.remove(), 4500)">
                <div class="vd-toast__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="vd-toast__content">
                    <p class="vd-toast__title">Error</p>
                    <p class="vd-toast__message">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="vd-toast__close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        {{-- ========== HERO SECTION (ENHANCED) ========== --}}
        <section class="vd-hero-section vd-reveal">
            <div class="vd-hero-bg">
                <div class="vd-hero-gradient"></div>
                <div class="vd-hero-glow vd-hero-glow--1"></div>
                <div class="vd-hero-glow vd-hero-glow--2"></div>
            </div>

            <div class="vd-hero-content">
                <div class="vd-hero-left">
                    <p class="vd-hero-badge">
                        <span class="vd-badge-pulse"></span>
                        Welcome back to your workspace
                    </p>
                    <h1 class="vd-hero-title">{{ $vendor->full_name ?? 'Vendor' }}</h1>
                    <p class="vd-hero-subtitle">
                        {{ $vendor->about ?: 'Build your wedding business and connect with thousands of couples.' }}
                    </p>

                    <div class="vd-hero-meta">
                        @if ($vendor->email)
                            <div class="vd-meta-item">
                                <span class="vd-meta-icon">📧</span>
                                <span>{{ $vendor->email }}</span>
                            </div>
                        @endif
                        @if ($vendor->city || $vendor->country)
                            <div class="vd-meta-item">
                                <span class="vd-meta-icon">📍</span>
                                <span>{{ collect([$vendor->city, $vendor->country])->filter()->join(', ') }}</span>
                            </div>
                        @endif
                    </div>

                    <button wire:click="openProfileModal" class="vd-btn vd-btn--primary vd-btn--lg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Edit Profile
                    </button>
                </div>

                <div class="vd-hero-right">
                    <div class="vd-avatar-card">
                        <div class="vd-avatar-ring"></div>
                        <div class="vd-avatar-content">
                            <div class="vd-avatar-initials">{{ $vendor->initials() }}</div>
                            <div class="vd-avatar-badge">⭐</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upcoming Events Strip --}}
            @if (!empty($upcomingEvents))
                <div class="vd-events-strip">
                    <div class="vd-events-label">📅 Upcoming Events</div>
                    <div class="vd-events-scroll">
                        @foreach ($upcomingEvents as $event)
                            <div class="vd-event-pill">
                                <span class="vd-event-days">{{ $event['days_until'] }}d</span>
                                <div class="vd-event-details">
                                    <span class="vd-event-name">{{ $event['host_name'] }}</span>
                                    <span
                                        class="vd-event-date">{{ \Carbon\Carbon::parse($event['event_date'])->format('d M') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        {{-- ========== STATS GRID (ENHANCED) ========== --}}
        <div class="vd-stats-grid">
            @php
                $stats = [
                    [
                        'icon' => '👁️',
                        'label' => 'Page Visitors',
                        'value' => number_format($pageVisitors),
                        'change' => '+12%',
                        'color' => 'rose',
                    ],
                    [
                        'icon' => '📋',
                        'label' => 'Total Bookings',
                        'value' => number_format($totalBookings),
                        'change' => '+8%',
                        'color' => 'amber',
                    ],
                    [
                        'icon' => '💰',
                        'label' => 'Total Revenue',
                        'value' => 'Rs ' . number_format($totalRevenue, 0),
                        'change' => '+5%',
                        'color' => 'emerald',
                    ],
                    [
                        'icon' => '📱',
                        'label' => 'Social Clicks',
                        'value' => number_format($socialClicks),
                        'change' => '+23%',
                        'color' => 'violet',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="vd-stat-card vd-stat-{{ $stat['color'] }} vd-reveal"
                    style="--reveal-delay: {{ $loop->index * 0.08 }}s">
                    <div class="vd-stat-icon">{{ $stat['icon'] }}</div>
                    <div class="vd-stat-details">
                        <p class="vd-stat-label">{{ $stat['label'] }}</p>
                        <p class="vd-stat-value">{{ $stat['value'] }}</p>
                    </div>
                    <span class="vd-stat-change">{{ $stat['change'] }}</span>
                </div>
            @endforeach
        </div>

        {{-- ========== MAIN CONTENT GRID ========== --}}
        <div class="vd-content-grid">

            {{-- LEFT COLUMN --}}
            <div class="vd-content-left">

                {{-- BOOKINGS CARD --}}
                <div class="vd-card vd-reveal" style="--reveal-delay: 0.24s">
                    <div class="vd-card-header">
                        <div class="vd-card-title-group">
                            <span class="vd-card-icon">📑</span>
                            <div>
                                <h2 class="vd-card-title">Recent Bookings</h2>
                                <p class="vd-card-subtitle">Your latest booking requests</p>
                            </div>
                        </div>
                        <a href="{{ route('vendor.bookings') }}" class="vd-link-arrow">
                            View all
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <div class="vd-card-body">
                        <div class="vd-table-wrapper">
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
                                            <td class="vd-table-mono">{{ $booking['custom_id'] }}</td>
                                            <td class="vd-table-muted">{{ $booking['created'] }}</td>
                                            <td>
                                                <span
                                                    class="vd-badge {{ $booking['status_color'] === 'green' ? 'vd-badge--success' : 'vd-badge--pending' }}">
                                                    <i class="vd-badge-dot"></i>
                                                    {{ $booking['status'] }}
                                                </span>
                                            </td>
                                            <td class="vd-table-amount">{{ $booking['amount'] }}</td>
                                            <td class="vd-table-action">
                                                <button class="vd-icon-btn">⋯</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="vd-table-empty">
                                                <div class="vd-empty-state">
                                                    <span class="vd-empty-icon">📭</span>
                                                    <p>No bookings yet</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- REVIEWS CARD --}}
                <div class="vd-card vd-reveal" style="--reveal-delay: 0.32s">
                    <div class="vd-card-header">
                        <div class="vd-card-title-group">
                            <span class="vd-card-icon">⭐</span>
                            <h2 class="vd-card-title">Latest Reviews</h2>
                        </div>
                    </div>
                    <div class="vd-card-body">
                        @if (empty($reviews))
                            <div class="vd-empty-state">
                                <span class="vd-empty-icon">💬</span>
                                <p>No reviews yet. Great work brings great reviews!</p>
                            </div>
                        @else
                            <div class="vd-reviews-list">
                                @foreach ($reviews as $review)
                                    <div class="vd-review-item">
                                        <div class="vd-review-avatar">{{ substr($review['name'], 0, 1) }}</div>
                                        <div class="vd-review-content">
                                            <div class="vd-review-header">
                                                <span class="vd-review-name">{{ $review['name'] }}</span>
                                                <div class="vd-stars">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <span
                                                            class="vd-star {{ $i < $review['rating'] ? 'vd-star--filled' : '' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="vd-review-text">"{{ $review['comment'] }}"</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="vd-content-right">

                {{-- QUICK ACTIONS --}}
                <div class="vd-card vd-reveal" style="--reveal-delay: 0.28s">
                    <div class="vd-card-header">
                        <div class="vd-card-title-group">
                            <span class="vd-card-icon">⚡</span>
                            <h2 class="vd-card-title">Quick Actions</h2>
                        </div>
                    </div>
                    <div class="vd-card-body vd-card-body--actions">
                        <button wire:click="openBusinessModal" class="vd-action-btn vd-action-indigo">
                            <span class="vd-action-icon">🏢</span>
                            <span class="vd-action-text">
                                <span class="vd-action-title">Manage Businesses</span>
                                <span class="vd-action-desc">Add or edit your businesses</span>
                            </span>
                        </button>
                        <button wire:click="openAvailabilityModal" class="vd-action-btn vd-action-emerald">
                            <span class="vd-action-icon">📅</span>
                            <span class="vd-action-text">
                                <span class="vd-action-title">Update Availability</span>
                                <span class="vd-action-desc">Set your available dates</span>
                            </span>
                        </button>
                        <a href="{{ route('vendor.packages') }}" class="vd-action-btn vd-action-sky">
                            <span class="vd-action-icon">📦</span>
                            <span class="vd-action-text">
                                <span class="vd-action-title">Create Package</span>
                                <span class="vd-action-desc">Define your service packages</span>
                            </span>
                        </a>
                        <button wire:click="openMessageModal" class="vd-action-btn vd-action-violet">
                            <span class="vd-action-icon">💬</span>
                            <span class="vd-action-text">
                                <span class="vd-action-title">Message Clients</span>
                                <span class="vd-action-desc">Respond to inquiries</span>
                            </span>
                        </button>
                    </div>
                </div>

                {{-- CREDITS SHOWCASE --}}
                <div class="vd-credits-showcase vd-reveal" style="--reveal-delay: 0.36s">
                    <div class="vd-credits-glow"></div>
                    <div class="vd-credits-inner">
                        <p class="vd-credits-label">Available Credits</p>
                        <div class="vd-credits-amount">{{ number_format($credits, 0) }}</div>
                        <p class="vd-credits-hint">Credits available to use</p>
                        <a href="{{ route('vendor.credits') }}" class="vd-btn vd-btn--secondary">
                            Purchase More
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- RATING SUMMARY --}}
                <div class="vd-card vd-reveal" style="--reveal-delay: 0.44s">
                    <div class="vd-card-body vd-card-body--center">
                        <h3 class="vd-rating-title">Overall Rating</h3>
                        <div class="vd-rating-score">
                            <span class="vd-rating-number">{{ number_format($rating, 1) }}</span>
                            <span class="vd-rating-max">/5</span>
                        </div>
                        <div class="vd-stars vd-stars--lg">
                            @for ($i = 0; $i < 5; $i++)
                                <span class="vd-star {{ $i < floor($rating) ? 'vd-star--filled' : '' }}">★</span>
                            @endfor
                        </div>
                        <p class="vd-rating-count">{{ $ratingCount }} {{ Str::plural('review', $ratingCount) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== MODALS ========== --}}

    {{-- Availability Modal --}}
    @if ($showAvailabilityModal)
        <div class="vd-modal-backdrop" wire:click.self="closeAvailabilityModal">
            <div class="vd-modal vd-modal-animate">
                <div class="vd-modal-header vd-modal-header--green">
                    <span class="vd-modal-icon">📅</span>
                    <h2 class="vd-modal-title">Update Availability</h2>
                    <button wire:click="closeAvailabilityModal" class="vd-modal-close">✕</button>
                </div>
                <div class="vd-modal-body">
                    <div class="vd-form-group">
                        <label class="vd-form-label">Select Business</label>
                        <select wire:model="selectedBusiness" class="vd-form-input">
                            <option value="">Choose a business</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Slot Duration (minutes)</label>
                        <input type="number" wire:model="slotDuration" min="15" max="480"
                            class="vd-form-input" placeholder="60" />
                    </div>
                    <div class="vd-form-hint vd-form-hint--green">
                        ℹ️ Set your availability slot duration for bookings.
                    </div>
                </div>
                <div class="vd-modal-footer">
                    <button wire:click="closeAvailabilityModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveAvailability" class="vd-btn vd-btn--success">
                        ✓ Save Changes
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Message Modal --}}
    @if ($showMessageModal)
        <div class="vd-modal-backdrop" wire:click.self="closeMessageModal">
            <div class="vd-modal vd-modal-animate">
                <div class="vd-modal-header vd-modal-header--violet">
                    <span class="vd-modal-icon">💬</span>
                    <h2 class="vd-modal-title">Message Clients</h2>
                    <button wire:click="closeMessageModal" class="vd-modal-close">✕</button>
                </div>
                <div class="vd-modal-body">
                    <div class="vd-form-group">
                        <label class="vd-form-label">Subject</label>
                        <input type="text" wire:model="messageSubject" class="vd-form-input"
                            placeholder="Message subject..." />
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Message</label>
                        <textarea wire:model="messageBody" rows="5" class="vd-form-input vd-form-textarea"
                            placeholder="Your message here..."></textarea>
                    </div>
                    <div class="vd-form-hint vd-form-hint--violet">
                        ℹ️ Your message will be sent to interested clients.
                    </div>
                </div>
                <div class="vd-modal-footer">
                    <button wire:click="closeMessageModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="sendMessage" class="vd-btn vd-btn--violet">
                        ✈️ Send Message
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit Profile Modal --}}
    @if ($showProfileModal)
        <div class="vd-modal-backdrop" wire:click.self="closeProfileModal">
            <div class="vd-modal vd-modal--tall vd-modal-animate">
                <div class="vd-modal-header vd-modal-header--indigo">
                    <span class="vd-modal-icon">👤</span>
                    <h2 class="vd-modal-title">Edit Profile</h2>
                    <button wire:click="closeProfileModal" class="vd-modal-close">✕</button>
                </div>
                <div class="vd-modal-body vd-modal-body--scroll">
                    <div class="vd-form-group">
                        <label class="vd-form-label">Full Name</label>
                        <input type="text" wire:model="profile.full_name" class="vd-form-input" />
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Email</label>
                        <input type="email" wire:model="profile.email" class="vd-form-input" />
                    </div>
                    <div class="vd-form-row">
                        <div class="vd-form-group">
                            <label class="vd-form-label">Phone</label>
                            <input type="text" wire:model="profile.phone_no" class="vd-form-input" />
                        </div>
                        <div class="vd-form-group vd-form-group--sm">
                            <label class="vd-form-label">Country Code</label>
                            <input type="text" wire:model="profile.country_code" class="vd-form-input" />
                        </div>
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">About</label>
                        <textarea wire:model="profile.about" rows="3" class="vd-form-input vd-form-textarea"></textarea>
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Profile Image</label>
                        <input type="file" wire:model="profile_image" class="vd-form-file" />
                        @if ($profile_image_preview)
                            <img src="{{ $profile_image_preview }}" class="vd-form-image-preview" />
                        @endif
                    </div>
                </div>
                <div class="vd-modal-footer">
                    <button wire:click="closeProfileModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveProfile" class="vd-btn vd-btn--indigo">
                        ✓ Save Profile
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Manage Business Modal --}}
    @if ($showBusinessModal)
        <div class="vd-modal-backdrop" wire:click.self="closeBusinessModal">
            <div class="vd-modal vd-modal--tall vd-modal-animate">
                <div class="vd-modal-header vd-modal-header--indigo">
                    <span class="vd-modal-icon">🏢</span>
                    <h2 class="vd-modal-title">{{ isset($businessForm['id']) ? 'Edit' : 'Add' }} Business</h2>
                    <button wire:click="closeBusinessModal" class="vd-modal-close">✕</button>
                </div>
                <div class="vd-modal-body vd-modal-body--scroll">
                    <div class="vd-form-group">
                        <label class="vd-form-label">Business Name</label>
                        <input type="text" wire:model="businessForm.company_name" class="vd-form-input"
                            placeholder="e.g., Grand Marquee" />
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Category</label>
                        <select wire:model="businessForm.category_id" class="vd-form-input">
                            <option value="">Select Category</option>
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Description</label>
                        <textarea wire:model="businessForm.business_desc" rows="3" class="vd-form-input vd-form-textarea"
                            placeholder="Describe your business..."></textarea>
                    </div>
                    <div class="vd-form-row">
                        <div class="vd-form-group">
                            <label class="vd-form-label">Business Email</label>
                            <input type="email" wire:model="businessForm.business_email" class="vd-form-input"
                                placeholder="contact@example.com" />
                        </div>
                        <div class="vd-form-group">
                            <label class="vd-form-label">Business Phone</label>
                            <input type="text" wire:model="businessForm.business_phone" class="vd-form-input"
                                placeholder="+92 300 1234567" />
                        </div>
                    </div>
                    <div class="vd-form-group">
                        <label class="vd-form-label">Street Address</label>
                        <input type="text" wire:model="businessForm.street_address" class="vd-form-input"
                            placeholder="123 Main St" />
                    </div>
                    <div class="vd-form-row">
                        <div class="vd-form-group">
                            <label class="vd-form-label">City</label>
                            <input type="text" wire:model="businessForm.city" class="vd-form-input"
                                placeholder="Lahore" />
                        </div>
                        <div class="vd-form-group">
                            <label class="vd-form-label">Country</label>
                            <input type="text" wire:model="businessForm.country" class="vd-form-input"
                                placeholder="Pakistan" />
                        </div>
                    </div>
                </div>
                <div class="vd-modal-footer">
                    <button wire:click="closeBusinessModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveBusiness" class="vd-btn vd-btn--indigo">
                        ✓ {{ isset($businessForm['id']) ? 'Update' : 'Create' }} Business
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- STYLES --}}
    <style>
        /* ===== DESIGN TOKENS ===== */
        :root {
            --font-sans: 'Segoe UI', system-ui, -apple-system, sans-serif;
            --font-mono: 'Fira Code', 'JetBrains Mono', monospace;

            /* Light mode */
            --bg-primary: #ffffff;
            --bg-secondary: #f8f7fb;
            --bg-tertiary: #f0edfa;
            --text-primary: #1a1625;
            --text-secondary: #6b6377;
            --text-tertiary: #9a939c;
            --border-light: rgba(107, 99, 119, 0.08);
            --border-medium: rgba(107, 99, 119, 0.15);

            /* Colors */
            --rose: #f43f5e;
            --amber: #f59e0b;
            --emerald: #10b981;
            --violet: #7c3aed;
            --indigo: #6366f1;
            --sky: #0ea5e9;

            /* Shadows */
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 16px 40px rgba(0, 0, 0, 0.16);
        }

        .dark {
            --bg-primary: #0f0d16;
            --bg-secondary: #161321;
            --bg-tertiary: #1f1b2e;
            --text-primary: #f5f3f9;
            --text-secondary: #c9c2d4;
            --text-tertiary: #9a939c;
            --border-light: rgba(157, 150, 170, 0.1);
            --border-medium: rgba(157, 150, 170, 0.18);
        }

        * {
            box-sizing: border-box;
        }

        /* ===== ROOT ===== */
        .vd-root {
            font-family: var(--font-sans);
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* ===== AMBIENT BACKGROUND ===== */
        .vd-ambient-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .vd-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            will-change: transform;
        }

        .vd-blob--1 {
            width: 500px;
            height: 500px;
            background: var(--violet);
            top: -100px;
            right: -100px;
            animation: blob-drift 20s ease-in-out infinite;
        }

        .vd-blob--2 {
            width: 400px;
            height: 400px;
            background: var(--indigo);
            bottom: 10%;
            left: -80px;
            animation: blob-drift 25s ease-in-out infinite reverse;
        }

        .vd-blob--3 {
            width: 350px;
            height: 350px;
            background: var(--emerald);
            top: 50%;
            right: 20%;
            animation: blob-drift 22s ease-in-out infinite 3s;
        }

        .vd-mesh-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg,
                    rgba(124, 58, 237, 0.02) 0%,
                    rgba(99, 102, 241, 0.02) 50%,
                    rgba(14, 165, 233, 0.02) 100%);
        }

        @keyframes blob-drift {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 30px) scale(0.95);
            }
        }

        /* ===== CONTAINER ===== */
        .vd-container {
            position: relative;
            z-index: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        @media (max-width: 768px) {
            .vd-container {
                padding: 28px 16px;
            }
        }

        /* ===== REVEAL ANIMATION ===== */
        @keyframes reveal {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .vd-reveal {
            animation: reveal 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) var(--reveal-delay, 0s) forwards;
            opacity: 0;
        }

        /* ===== TOASTS ===== */
        .vd-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--bg-primary);
            border: 1px solid var(--border-medium);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(8px);
            z-index: 2000;
            animation: slide-in 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            max-width: 420px;
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(400px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .vd-toast__icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vd-toast--success .vd-toast__icon {
            color: var(--emerald);
        }

        .vd-toast--error .vd-toast__icon {
            color: var(--rose);
        }

        .vd-toast__content {
            flex: 1;
        }

        .vd-toast__title {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 2px;
        }

        .vd-toast__message {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
            margin: 0;
        }

        .vd-toast__close {
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-tertiary);
            opacity: 0.6;
            transition: opacity 0.2s;
            flex-shrink: 0;
        }

        .vd-toast__close:hover {
            opacity: 1;
        }

        .vd-toast__close svg {
            width: 16px;
            height: 16px;
        }

        /* ===== HERO SECTION ===== */
        .vd-hero-section {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            margin-bottom: 40px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
        }

        .vd-hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .vd-hero-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(124, 58, 237, 0.05) 0%,
                    rgba(99, 102, 241, 0.03) 50%,
                    transparent 100%);
        }

        .vd-hero-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
        }

        .vd-hero-glow--1 {
            width: 300px;
            height: 300px;
            background: rgba(124, 58, 237, 0.1);
            top: -100px;
            right: -50px;
            animation: glow-pulse 8s ease-in-out infinite;
        }

        .vd-hero-glow--2 {
            width: 250px;
            height: 250px;
            background: rgba(14, 165, 233, 0.08);
            bottom: -80px;
            left: 10%;
            animation: glow-pulse 6s ease-in-out infinite reverse;
        }

        @keyframes glow-pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }

        .vd-hero-content {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 60px;
            align-items: center;
            padding: 60px 50px;
        }

        @media (max-width: 1024px) {
            .vd-hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 50px 40px;
            }
        }

        @media (max-width: 768px) {
            .vd-hero-content {
                padding: 40px 24px;
                gap: 30px;
            }
        }

        .vd-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--indigo);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .vd-badge-pulse {
            width: 6px;
            height: 6px;
            background: var(--indigo);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(0.8);
            }
        }

        .vd-hero-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 50%, var(--rose) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
        }

        .vd-hero-subtitle {
            font-size: 1.0625rem;
            line-height: 1.6;
            color: var(--text-secondary);
            max-width: 500px;
            margin-bottom: 24px;
        }

        .vd-hero-meta {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 28px;
        }

        .vd-meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9375rem;
            color: var(--text-secondary);
        }

        .vd-meta-icon {
            font-size: 1.125rem;
        }

        .vd-hero-right {
            display: flex;
            justify-content: center;
        }

        .vd-avatar-card {
            position: relative;
            width: 180px;
            height: 180px;
        }

        .vd-avatar-ring {
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, var(--violet), var(--indigo), var(--sky), var(--emerald), var(--violet));
            animation: spin 20s linear infinite;
            opacity: 0.8;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .vd-avatar-content {
            position: absolute;
            inset: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.1), rgba(14, 165, 233, 0.1));
            border: 2px solid var(--bg-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .vd-avatar-initials {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--indigo), var(--violet));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .vd-avatar-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border: 3px solid var(--bg-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        /* Events Strip */
        .vd-events-strip {
            position: relative;
            border-top: 1px solid var(--border-light);
            padding: 20px 50px;
            background: var(--bg-tertiary);
        }

        @media (max-width: 768px) {
            .vd-events-strip {
                padding: 16px 24px;
            }
        }

        .vd-events-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: var(--text-tertiary);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .vd-events-scroll {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 4px;
        }

        .vd-events-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .vd-events-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .vd-events-scroll::-webkit-scrollbar-thumb {
            background: var(--border-medium);
            border-radius: 2px;
        }

        .vd-event-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: 10px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .vd-event-pill:hover {
            border-color: var(--indigo);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .vd-event-days {
            font-size: 1rem;
            font-weight: 700;
            color: var(--violet);
        }

        .vd-event-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .vd-event-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .vd-event-date {
            font-size: 0.75rem;
            color: var(--text-tertiary);
        }

        /* ===== STATS GRID ===== */
        .vd-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .vd-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .vd-stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .vd-stat-card {
            position: relative;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--border-light);
            background: var(--bg-primary);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        .vd-stat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .vd-stat-card:hover {
            border-color: var(--border-medium);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .vd-stat-rose .vd-stat-card::before {
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.05), transparent);
        }

        .vd-stat-amber .vd-stat-card::before {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), transparent);
        }

        .vd-stat-emerald .vd-stat-card::before {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), transparent);
        }

        .vd-stat-violet .vd-stat-card::before {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.05), transparent);
        }

        .vd-stat-card:hover::before {
            opacity: 1;
        }

        .vd-stat-icon {
            font-size: 2rem;
            min-width: 50px;
            text-align: center;
        }

        .vd-stat-details {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .vd-stat-label {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
            font-weight: 500;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .vd-stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .vd-stat-change {
            position: relative;
            z-index: 1;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            background: rgba(16, 185, 129, 0.15);
            color: var(--emerald);
            border-radius: 8px;
            white-space: nowrap;
        }

        /* ===== CONTENT GRID ===== */
        .vd-content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
        }

        @media (max-width: 1024px) {
            .vd-content-grid {
                grid-template-columns: 1fr;
            }
        }

        .vd-content-left,
        .vd-content-right {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* ===== CARD ===== */
        .vd-card {
            position: relative;
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-xs);
            transition: all 0.3s ease;
        }

        .vd-card:hover {
            border-color: var(--border-medium);
            box-shadow: var(--shadow-sm);
        }

        .vd-card-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-secondary);
        }

        .vd-card-title-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .vd-card-icon {
            font-size: 1.5rem;
            min-width: 30px;
        }

        .vd-card-title {
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .vd-card-subtitle {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
            margin: 4px 0 0;
        }

        .vd-card-body {
            padding: 24px;
        }

        .vd-card-body--actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .vd-card-body--center {
            text-align: center;
            padding: 32px 24px;
        }

        /* ===== TABLE ===== */
        .vd-table-wrapper {
            overflow-x: auto;
        }

        .vd-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .vd-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-light);
        }

        .vd-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-primary);
        }

        .vd-table tbody tr {
            transition: background 0.2s;
        }

        .vd-table tbody tr:hover {
            background: var(--bg-secondary);
        }

        .vd-table-mono {
            font-family: var(--font-mono);
            font-weight: 600;
        }

        .vd-table-muted {
            color: var(--text-tertiary);
        }

        .vd-table-amount {
            font-weight: 700;
        }

        .vd-table-action {
            text-align: right;
        }

        .vd-table-empty {
            text-align: center;
            padding: 48px 20px;
        }

        .vd-empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            color: var(--text-tertiary);
        }

        .vd-empty-icon {
            font-size: 2.5rem;
            opacity: 0.6;
        }

        .vd-empty-state p {
            font-size: 0.875rem;
            margin: 0;
        }

        /* ===== BADGE ===== */
        .vd-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .vd-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .vd-badge--success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--emerald);
        }

        .dark .vd-badge--success {
            background: rgba(16, 185, 129, 0.2);
        }

        .vd-badge--pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--amber);
        }

        .dark .vd-badge--pending {
            background: rgba(245, 158, 11, 0.2);
        }

        /* ===== ICON BUTTON ===== */
        .vd-icon-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-tertiary);
            transition: all 0.2s;
            font-size: 1.25rem;
        }

        .vd-icon-btn:hover {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        /* ===== REVIEWS ===== */
        .vd-reviews-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .vd-review-item {
            display: flex;
            gap: 14px;
            padding: 16px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            transition: all 0.2s;
        }

        .vd-review-item:hover {
            border-color: var(--border-medium);
            background: var(--bg-tertiary);
        }

        .vd-review-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--indigo), var(--violet));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            font-size: 1.125rem;
        }

        .vd-review-content {
            flex: 1;
            min-width: 0;
        }

        .vd-review-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .vd-review-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .vd-stars {
            display: flex;
            gap: 2px;
        }

        .vd-star {
            font-size: 0.875rem;
            color: #d1d5db;
        }

        .dark .vd-star {
            color: #4b5563;
        }

        .vd-star--filled {
            color: #f59e0b;
        }

        .vd-stars--lg {
            font-size: 1.5rem;
            justify-content: center;
            margin: 12px 0;
        }

        .vd-review-text {
            font-size: 0.8125rem;
            color: var(--text-secondary);
            line-height: 1.6;
            font-style: italic;
            margin: 0;
        }

        /* ===== ACTION BUTTON ===== */
        .vd-action-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border: 1px solid;
            border-radius: 12px;
            background: transparent;
            cursor: pointer;
            text-align: left;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-decoration: none;
        }

        .vd-action-btn:hover {
            transform: translateX(4px);
        }

        .vd-action-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .vd-action-text {
            flex: 1;
        }

        .vd-action-title {
            display: block;
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .vd-action-desc {
            display: block;
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-top: 2px;
        }

        .vd-action-indigo {
            border-color: rgba(99, 102, 241, 0.2);
            background: rgba(99, 102, 241, 0.08);
        }

        .vd-action-indigo:hover {
            border-color: var(--indigo);
            background: rgba(99, 102, 241, 0.12);
        }

        .vd-action-emerald {
            border-color: rgba(16, 185, 129, 0.2);
            background: rgba(16, 185, 129, 0.08);
        }

        .vd-action-emerald:hover {
            border-color: var(--emerald);
            background: rgba(16, 185, 129, 0.12);
        }

        .vd-action-sky {
            border-color: rgba(14, 165, 233, 0.2);
            background: rgba(14, 165, 233, 0.08);
        }

        .vd-action-sky:hover {
            border-color: var(--sky);
            background: rgba(14, 165, 233, 0.12);
        }

        .vd-action-violet {
            border-color: rgba(124, 58, 237, 0.2);
            background: rgba(124, 58, 237, 0.08);
        }

        .vd-action-violet:hover {
            border-color: var(--violet);
            background: rgba(124, 58, 237, 0.12);
        }

        /* ===== CREDITS SHOWCASE ===== */
        .vd-credits-showcase {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--violet) 50%, var(--rose) 100%);
            box-shadow: 0 12px 40px rgba(99, 102, 241, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .vd-credits-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), transparent 60%);
            opacity: 0;
            animation: credits-glow 4s ease-in-out infinite;
        }

        @keyframes credits-glow {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 0.8;
            }
        }

        .vd-credits-inner {
            position: relative;
            z-index: 1;
            padding: 32px;
            color: white;
        }

        .vd-credits-label {
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            opacity: 0.85;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .vd-credits-amount {
            font-size: 3.2rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }

        .vd-credits-hint {
            font-size: 0.8125rem;
            opacity: 0.75;
            margin-bottom: 20px;
        }

        /* ===== RATING ===== */
        .vd-rating-title {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .vd-rating-score {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .vd-rating-number {
            font-size: 3.2rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--amber), var(--rose));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .vd-rating-max {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-tertiary);
        }

        .vd-rating-count {
            font-size: 0.875rem;
            color: var(--text-tertiary);
            margin-top: 16px;
        }

        /* ===== LINK ARROW ===== */
        .vd-link-arrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--emerald);
            text-decoration: none;
            transition: gap 0.2s;
        }

        .vd-link-arrow:hover {
            gap: 10px;
        }

        .vd-link-arrow svg {
            width: 14px;
            height: 14px;
        }

        /* ===== BUTTONS ===== */
        .vd-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 24px;
            border: none;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-decoration: none;
            white-space: nowrap;
        }

        .vd-btn svg {
            width: 16px;
            height: 16px;
        }

        .vd-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .vd-btn:active {
            transform: translateY(0);
        }

        .vd-btn--lg {
            padding: 13px 32px;
            font-size: 0.9375rem;
        }

        .vd-btn--primary {
            background: linear-gradient(135deg, var(--indigo), var(--violet));
            color: white;
        }

        .vd-btn--secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
        }

        .vd-btn--secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .vd-btn--ghost {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-light);
        }

        .vd-btn--ghost:hover {
            background: var(--bg-tertiary);
            border-color: var(--border-medium);
        }

        .vd-btn--success {
            background: linear-gradient(135deg, var(--emerald), #059669);
            color: white;
        }

        .vd-btn--indigo {
            background: linear-gradient(135deg, var(--indigo), #4f46e5);
            color: white;
        }

        .vd-btn--violet {
            background: linear-gradient(135deg, var(--violet), #6d28d9);
            color: white;
        }

        /* ===== MODALS ===== */
        .vd-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1500;
            animation: fade-in 0.2s ease;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .vd-modal {
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 540px;
            overflow: hidden;
        }

        .vd-modal--tall {
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .vd-modal-animate {
            animation: modal-pop 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modal-pop {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .vd-modal-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 24px;
            border-bottom: 1px solid var(--border-light);
            background: var(--bg-secondary);
        }

        .vd-modal-icon {
            font-size: 1.5rem;
        }

        .vd-modal-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-primary);
            flex: 1;
            margin: 0;
        }

        .vd-modal-close {
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.25rem;
            color: var(--text-tertiary);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vd-modal-close:hover {
            background: var(--bg-tertiary);
            color: var(--text-primary);
        }

        .vd-modal-header--green {
            background: rgba(16, 185, 129, 0.08);
        }

        .vd-modal-header--violet {
            background: rgba(124, 58, 237, 0.08);
        }

        .vd-modal-header--indigo {
            background: rgba(99, 102, 241, 0.08);
        }

        .vd-modal-body {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .vd-modal-body--scroll {
            overflow-y: auto;
            flex: 1;
        }

        .vd-modal-body--scroll::-webkit-scrollbar {
            width: 6px;
        }

        .vd-modal-body--scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .vd-modal-body--scroll::-webkit-scrollbar-thumb {
            background: var(--border-medium);
            border-radius: 3px;
        }

        .vd-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 24px;
            border-top: 1px solid var(--border-light);
            background: var(--bg-secondary);
        }

        /* ===== FORM ===== */
        .vd-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .vd-form-group--sm {
            max-width: 140px;
        }

        .vd-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .vd-form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .vd-form-input,
        .vd-form-textarea {
            padding: 11px 14px;
            border: 1px solid var(--border-light);
            border-radius: 10px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s;
            font-family: var(--font-sans);
        }

        .vd-form-input:focus,
        .vd-form-textarea:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: var(--bg-primary);
        }

        .vd-form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .vd-form-file {
            font-size: 0.8125rem;
            color: var(--text-secondary);
        }

        .vd-form-image-preview {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--border-medium);
            margin-top: 10px;
        }

        .vd-form-hint {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 0.8125rem;
            border: 1px solid;
        }

        .vd-form-hint--green {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.2);
            color: var(--emerald);
        }

        .vd-form-hint--violet {
            background: rgba(124, 58, 237, 0.1);
            border-color: rgba(124, 58, 237, 0.2);
            color: var(--violet);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .vd-hero-content {
                padding: 32px 20px;
            }

            .vd-stats-grid {
                gap: 12px;
            }

            .vd-card-header {
                padding: 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .vd-card-body {
                padding: 16px;
            }

            .vd-modal {
                max-width: 100%;
            }

            .vd-form-row {
                grid-template-columns: 1fr;
            }

            .vd-content-grid {
                gap: 20px;
            }
        }
    </style>
</div>
