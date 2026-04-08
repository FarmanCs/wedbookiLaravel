<div
    class="vd-root min-h-screen bg-gray-50 text-gray-800
            dark:bg-gray-950 dark:text-gray-200
            transition-colors duration-300">

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
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="vd-flash__close">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="vd-flash vd-flash--error" x-data x-init="setTimeout(() => $el.remove(), 4500)">
                <div class="vd-flash__icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="vd-flash__close">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- ========== HERO / WELCOME CARD ========== --}}
        <div class="vd-hero vd-animate" style="--delay:0s">
            <div class="vd-hero__inner">
                <div class="vd-hero__content">
                    <p class="vd-hero__eyebrow">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="vd-hero__eyebrow-icon">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Welcome back to WedbookI
                    </p>
                    <h1 class="vd-hero__title">{{ $vendor->full_name ?? 'Vendor' }}</h1>
                    <p class="vd-hero__bio">
                        {{ $vendor->about ?: 'No description provided yet. Add your bio to let clients know who you are.' }}
                    </p>
                    <div class="vd-hero__actions">
                        <button wire:click="openProfileModal" class="vd-btn vd-btn--primary">
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>
                <div class="vd-hero__avatar-wrap">
                    <div class="vd-hero__avatar-ring"></div>
                    <div class="vd-hero__avatar">{{ $vendor->initials() }}</div>
                    <div class="vd-hero__avatar-badge">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Upcoming Events Strip --}}
            @if (!empty($upcomingEvents))
                <div class="vd-hero__events">
                    <div class="vd-hero__events-label">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
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
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Page Visitors</span>
                    <span class="vd-stat__value">{{ number_format($pageVisitors) }}</span>
                </div>
                <span class="vd-stat__badge">+12%</span>
            </div>
            <div class="vd-stat vd-stat--amber vd-animate" style="--delay:.14s">
                <div class="vd-stat__icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Total Bookings</span>
                    <span class="vd-stat__value">{{ number_format($totalBookings) }}</span>
                </div>
                <span class="vd-stat__badge">+8%</span>
            </div>
            <div class="vd-stat vd-stat--emerald vd-animate" style="--delay:.20s">
                <div class="vd-stat__icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="vd-stat__body">
                    <span class="vd-stat__label">Total Revenue</span>
                    <span class="vd-stat__value">Rs {{ number_format($totalRevenue, 0) }}</span>
                </div>
                <span class="vd-stat__badge">+5%</span>
            </div>
            <div class="vd-stat vd-stat--violet vd-animate" style="--delay:.26s">
                <div class="vd-stat__icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                    </svg>
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
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="vd-card__title">Recent Bookings</h2>
                                <p class="vd-card__subtitle">Your latest booking requests</p>
                            </div>
                        </div>
                        <a href="{{ route('vendor.bookings') }}" class="vd-link">
                            View all
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
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
                                                <svg viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="vd-table__empty">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                            </svg>
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
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <h2 class="vd-card__title">Latest Reviews</h2>
                        </div>
                    </div>
                    <div class="vd-card__body">
                        @if (empty($reviews))
                            <div class="vd-empty-state">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
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
                                                        <svg viewBox="0 0 20 20"
                                                            fill="{{ $i < $review['rating'] ? 'currentColor' : 'none' }}"
                                                            stroke="currentColor"
                                                            class="{{ $i < $review['rating'] ? 'vd-star--filled' : 'vd-star--empty' }}">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
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
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="vd-card__title">Quick Actions</h2>
                        </div>
                    </div>
                    <div class="vd-card__body">
                        <div class="vd-actions">
                            <button wire:click="openBusinessModal" class="vd-action vd-action--indigo">
                                <div class="vd-action__icon">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Manage Businesses</span>
                                    <span class="vd-action__desc">Add or edit your businesses</span>
                                </div>
                                <svg class="vd-action__arrow" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button wire:click="openAvailabilityModal" class="vd-action vd-action--emerald">
                                <div class="vd-action__icon">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Update Availability</span>
                                    <span class="vd-action__desc">Set your available dates</span>
                                </div>
                                <svg class="vd-action__arrow" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <a href="{{ route('vendor.packages') }}" class="vd-action vd-action--sky">
                                <div class="vd-action__icon">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                                    </svg>
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Create Package</span>
                                    <span class="vd-action__desc">Define your service packages</span>
                                </div>
                                <svg class="vd-action__arrow" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <button wire:click="openMessageModal" class="vd-action vd-action--violet">
                                <div class="vd-action__icon">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="vd-action__text">
                                    <span class="vd-action__title">Message Clients</span>
                                    <span class="vd-action__desc">Respond to inquiries</span>
                                </div>
                                <svg class="vd-action__arrow" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Credits Card (FIXED: removed livewire:vendor.credits.index which caused the stray data) --}}
                <div class="vd-credits-card vd-animate" style="--delay:.30s">
                    <div class="vd-credits-card__shine"></div>
                    <div class="vd-credits-card__orb vd-credits-card__orb--1"></div>
                    <div class="vd-credits-card__orb vd-credits-card__orb--2"></div>
                    <div class="vd-credits-card__inner">
                        <div class="vd-credits-card__header">
                            <span class="vd-credits-card__label">Available Credits</span>
                            <div class="vd-credits-card__badge">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z"
                                        clip-rule="evenodd" />
                                    <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="vd-credits-card__amount">{{ number_format($credits, 0) }}</div>
                        <p class="vd-credits-card__hint">Credits available to use</p>

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
                            <svg viewBox="0 0 20 20" fill="{{ $i < floor($rating) ? 'currentColor' : 'none' }}"
                                stroke="currentColor"
                                class="{{ $i < floor($rating) ? 'vd-star--filled' : 'vd-star--empty' }}">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="vd-modal__title">Update Availability</h2>
                    <button wire:click="closeAvailabilityModal" class="vd-modal__close">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        Set your availability slot duration for bookings.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeAvailabilityModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="saveAvailability" class="vd-btn vd-btn--green">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="vd-modal__title">Message Clients</h2>
                    <button wire:click="closeMessageModal" class="vd-modal__close">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        Your message will be sent to interested clients.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeMessageModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="sendMessage" class="vd-btn vd-btn--violet">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="vd-modal__title">Edit Profile</h2>
                    <button wire:click="closeProfileModal" class="vd-modal__close">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="vd-modal__title">{{ isset($businessForm['id']) ? 'Edit' : 'Add' }} Business</h2>
                    <button wire:click="closeBusinessModal" class="vd-modal__close">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="vd-modal__title">Boost Your Business</h2>
                    <button wire:click="closeBoostModal" class="vd-modal__close">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
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
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        Boosting makes your business appear more prominently in search results.
                    </div>
                </div>
                <div class="vd-modal__footer">
                    <button wire:click="closeBoostModal" class="vd-btn vd-btn--ghost">Cancel</button>
                    <button wire:click="confirmBoost" class="vd-btn vd-btn--amber">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Confirm Boost
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        /* ===== DESIGN TOKENS ===== */
        :root {
            --vd-font: 'Outfit', system-ui, sans-serif;
            --vd-bg: #f8f7ff;
            --vd-surface: #ffffff;
            --vd-surface-alt: #f4f3fc;
            --vd-border: rgba(100, 80, 200, 0.10);
            --vd-border-hover: rgba(100, 80, 200, 0.22);
            --vd-text-primary: #1a1535;
            --vd-text-secondary: #6b6794;
            --vd-text-muted: #9e9bbf;
            --vd-radius-sm: 10px;
            --vd-radius-md: 14px;
            --vd-radius-lg: 20px;
            --vd-radius-xl: 26px;
            --vd-shadow-sm: 0 1px 4px rgba(80, 60, 160, .06), 0 1px 2px rgba(80, 60, 160, .04);
            --vd-shadow-md: 0 4px 16px rgba(80, 60, 160, .08), 0 1px 4px rgba(80, 60, 160, .05);
            --vd-shadow-lg: 0 12px 40px rgba(80, 60, 160, .12), 0 2px 8px rgba(80, 60, 160, .06);
            /* accent palette */
            --c-rose: #f43f5e;
            --c-rose-bg: #fff1f4;
            --c-rose-border: rgba(244, 63, 94, .14);
            --c-amber: #f59e0b;
            --c-amber-bg: #fffbeb;
            --c-amber-border: rgba(245, 158, 11, .14);
            --c-emerald: #10b981;
            --c-emerald-bg: #f0fdf9;
            --c-emerald-border: rgba(16, 185, 129, .14);
            --c-violet: #8b5cf6;
            --c-violet-bg: #f5f3ff;
            --c-violet-border: rgba(139, 92, 246, .14);
            --c-indigo: #6366f1;
            --c-indigo-bg: #eef2ff;
            --c-indigo-border: rgba(99, 102, 241, .14);
            --c-sky: #0ea5e9;
            --c-sky-bg: #f0f9ff;
            --c-sky-border: rgba(14, 165, 233, .14);
            --c-green: #22c55e;
            --c-green-bg: #f0fdf4;
            --c-green-border: rgba(34, 197, 94, .14);
        }

        .dark {
            --vd-bg: #0f0d1a;
            --vd-surface: #17142a;
            --vd-surface-alt: #1e1a30;
            --vd-border: rgba(130, 110, 220, .12);
            --vd-border-hover: rgba(130, 110, 220, .26);
            --vd-text-primary: #ede9ff;
            --vd-text-secondary: #9d97c4;
            --vd-text-muted: #6b668f;
            --c-rose-bg: rgba(244, 63, 94, .08);
            --c-amber-bg: rgba(245, 158, 11, .08);
            --c-emerald-bg: rgba(16, 185, 129, .08);
            --c-violet-bg: rgba(139, 92, 246, .08);
            --c-indigo-bg: rgba(99, 102, 241, .08);
            --c-sky-bg: rgba(14, 165, 233, .08);
            --c-green-bg: rgba(34, 197, 94, .08);
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

        /* ===== BACKGROUND ===== */
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
            filter: blur(80px);
            opacity: .35;
            will-change: transform;
        }



        .vd-bg-orb--2 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, #34d399 0%, transparent 70%);
            bottom: 10%;
            left: -100px;
            animation: orb-drift 22s ease-in-out infinite reverse;
        }

        .vd-bg-orb--3 {
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
            top: 45%;
            right: 20%;
            animation: orb-drift 15s ease-in-out infinite 4s;
        }

        .vd-bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--vd-border) 1px, transparent 1px),
                linear-gradient(90deg, var(--vd-border) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
        }

        @keyframes orb-drift {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -40px) scale(1.08);
            }

            66% {
                transform: translate(-20px, 25px) scale(.94);
            }
        }

        /* ===== CONTAINER ===== */
        .vd-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 24px;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(18px);
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
                transform: scale(.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin-slow {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse-soft {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
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
            animation: fade-up .55s cubic-bezier(.22, .68, 0, 1.2) var(--delay, 0s) forwards;
        }

        /* ===== FLASH ===== */
        .vd-flash {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            animation: slide-down .3s ease forwards;
            font-size: .875rem;
            font-weight: 500;
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
            width: 18px;
            height: 18px;
            opacity: .6;
            cursor: pointer;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity .15s;
        }

        .vd-flash__close:hover {
            opacity: 1;
        }

        .vd-flash__close svg {
            width: 14px;
            height: 14px;
        }

        /* ===== HERO ===== */
        .vd-hero {
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: var(--vd-shadow-lg);
            overflow: hidden;
            position: relative;
        }

        .vd-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #8b5cf6, #6366f1, #0ea5e9, #10b981, #f59e0b);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }

        .vd-hero__inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: center;
            padding: 40px 44px;
        }

        @media (max-width: 768px) {
            .vd-hero__inner {
                grid-template-columns: 1fr;
                padding: 28px 24px;
            }
        }

        .vd-hero__eyebrow {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--c-violet);
            margin-bottom: 10px;
        }

        .vd-hero__eyebrow-icon {
            width: 14px;
            height: 14px;
        }

        .vd-hero__title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -.02em;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 40%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 14px;
        }

        .vd-hero__bio {
            font-size: .9375rem;
            line-height: 1.65;
            color: var(--vd-text-secondary);
            max-width: 480px;
            margin-bottom: 28px;
            padding: 14px 16px;
            background: var(--vd-surface-alt);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-md);
        }

        /* Avatar */
        .vd-hero__avatar-wrap {
            position: relative;
            width: 148px;
            height: 148px;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .vd-hero__avatar-wrap {
                display: none;
            }
        }

        .vd-hero__avatar-ring {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #8b5cf6, #6366f1, #0ea5e9, #10b981, #8b5cf6);
            animation: spin-slow 8s linear infinite;
            opacity: .7;
        }

        .vd-hero__avatar {
            position: absolute;
            inset: 4px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--c-violet-bg), var(--c-indigo-bg));
            border: 3px solid var(--vd-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--c-violet);
            letter-spacing: -.02em;
        }

        .vd-hero__avatar-badge {
            position: absolute;
            bottom: 6px;
            right: 6px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--c-amber), #ea580c);
            border: 2px solid var(--vd-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, .4);
        }

        .vd-hero__avatar-badge svg {
            width: 14px;
            height: 14px;
        }

        /* Hero events strip */
        .vd-hero__events {
            border-top: 1px solid var(--vd-border);
            padding: 24px 44px;
            background: var(--vd-surface-alt);
        }

        @media (max-width: 768px) {
            .vd-hero__events {
                padding: 20px 24px;
            }
        }

        .vd-hero__events-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: var(--vd-text-muted);
            margin-bottom: 14px;
        }

        .vd-hero__events-label svg {
            width: 13px;
            height: 13px;
        }

        .vd-events-grid {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .vd-event-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-md);
            min-width: 200px;
            transition: border-color .2s, box-shadow .2s;
        }

        .vd-event-card:hover {
            border-color: var(--vd-border-hover);
            box-shadow: var(--vd-shadow-sm);
        }

        .vd-event-card__days {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--c-violet);
            line-height: 1;
            min-width: 36px;
            letter-spacing: -.04em;
        }

        .vd-event-card__days span {
            font-size: .875rem;
            font-weight: 600;
            opacity: .7;
        }

        .vd-event-card__name {
            font-size: .875rem;
            font-weight: 600;
            color: var(--vd-text-primary);
        }

        .vd-event-card__date {
            font-size: .75rem;
            color: var(--vd-text-muted);
            margin-top: 2px;
        }

        /* ===== BUTTON SYSTEM ===== */
        .vd-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 20px;
            border-radius: var(--vd-radius-sm);
            font-size: .875rem;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, opacity .15s;
            white-space: nowrap;
            text-decoration: none;
        }

        .vd-btn svg {
            width: 15px;
            height: 15px;
        }

        .vd-btn:hover {
            transform: translateY(-1px);
        }

        .vd-btn:active {
            transform: translateY(0);
        }

        .vd-btn--primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 2px 12px rgba(99, 102, 241, .35);
        }

        .vd-btn--primary:hover {
            box-shadow: 0 4px 20px rgba(99, 102, 241, .45);
        }

        .vd-btn--ghost {
            background: var(--vd-surface-alt);
            border-color: var(--vd-border);
            color: var(--vd-text-secondary);
        }

        .vd-btn--ghost:hover {
            border-color: var(--vd-border-hover);
        }

        .vd-btn--green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            box-shadow: 0 2px 10px rgba(34, 197, 94, .3);
        }

        .vd-btn--indigo {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            box-shadow: 0 2px 10px rgba(99, 102, 241, .3);
        }

        .vd-btn--violet {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            box-shadow: 0 2px 10px rgba(139, 92, 246, .3);
        }

        .vd-btn--amber {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 2px 10px rgba(245, 158, 11, .3);
        }

        .vd-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .8125rem;
            font-weight: 600;
            color: var(--c-emerald);
            text-decoration: none;
            transition: gap .2s;
        }

        .vd-link:hover {
            gap: 8px;
        }

        .vd-link svg {
            width: 14px;
            height: 14px;
        }

        /* ===== STATS ROW ===== */
        .vd-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
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
            gap: 14px;
            padding: 18px 20px;
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-lg);
            box-shadow: var(--vd-shadow-sm);
            position: relative;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }

        .vd-stat::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            opacity: 0;
            transition: opacity .2s;
        }

        .vd-stat:hover {
            border-color: var(--vd-border-hover);
            box-shadow: var(--vd-shadow-md);
            transform: translateY(-2px);
        }

        .vd-stat:hover::after {
            opacity: 1;
        }

        .vd-stat--rose::after {
            background: linear-gradient(90deg, var(--c-rose), #fb7185);
        }

        .vd-stat--amber::after {
            background: linear-gradient(90deg, var(--c-amber), #fbbf24);
        }

        .vd-stat--emerald::after {
            background: linear-gradient(90deg, var(--c-emerald), #34d399);
        }

        .vd-stat--violet::after {
            background: linear-gradient(90deg, var(--c-violet), #a78bfa);
        }

        .vd-stat__icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform .2s;
        }

        .vd-stat:hover .vd-stat__icon {
            transform: scale(1.1);
        }

        .vd-stat__icon svg {
            width: 18px;
            height: 18px;
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
            min-width: 0;
        }

        .vd-stat__label {
            display: block;
            font-size: .72rem;
            color: var(--vd-text-muted);
            font-weight: 500;
            margin-bottom: 2px;
        }

        .vd-stat__value {
            display: block;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--vd-text-primary);
            letter-spacing: -.02em;
        }

        .vd-stat__badge {
            font-size: .68rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 999px;
            white-space: nowrap;
            background: var(--c-emerald-bg);
            color: var(--c-emerald);
            border: 1px solid var(--c-emerald-border);
        }

        /* ===== MAIN GRID ===== */
        .vd-main-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 20px;
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
            gap: 20px;
        }

        /* ===== CARD ===== */
        .vd-card {
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: var(--vd-shadow-sm);
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
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

        .vd-card__header--green {
            background: var(--c-green-bg);
        }

        .vd-card__header--amber {
            background: var(--c-amber-bg);
        }

        .vd-card__header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .vd-card__icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vd-card__icon svg {
            width: 16px;
            height: 16px;
            color: white;
        }

        .vd-card__icon--green {
            background: linear-gradient(135deg, var(--c-green), #16a34a);
        }

        .vd-card__icon--amber {
            background: linear-gradient(135deg, var(--c-amber), #d97706);
        }

        .vd-card__icon--indigo {
            background: linear-gradient(135deg, var(--c-indigo), #4f46e5);
        }

        .vd-card__title {
            font-size: .9375rem;
            font-weight: 700;
            color: var(--vd-text-primary);
        }

        .vd-card__subtitle {
            font-size: .75rem;
            color: var(--vd-text-muted);
            margin-top: 1px;
        }

        .vd-card__body {
            padding: 20px 24px;
        }

        /* ===== TABLE ===== */
        .vd-table-wrap {
            overflow-x: auto;
        }

        .vd-table {
            width: 100%;
            font-size: .8125rem;
            border-collapse: collapse;
        }

        .vd-table thead tr {
            background: var(--vd-surface-alt);
        }

        .vd-table th {
            padding: 11px 20px;
            text-align: left;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--vd-text-muted);
            white-space: nowrap;
        }

        .vd-table td {
            padding: 14px 20px;
            border-top: 1px solid var(--vd-border);
            color: var(--vd-text-primary);
            vertical-align: middle;
        }

        .vd-table tbody tr {
            transition: background .15s;
        }

        .vd-table tbody tr:hover {
            background: var(--vd-surface-alt);
        }

        .vd-table__mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: .8rem;
            font-weight: 600;
        }

        .vd-table__muted {
            color: var(--vd-text-muted);
            font-size: .8rem;
        }

        .vd-table__amount {
            font-weight: 700;
        }

        .vd-table__empty {
            text-align: center;
            padding: 48px 20px;
            color: var(--vd-text-muted);
        }

        .vd-table__empty svg {
            width: 40px;
            height: 40px;
            margin: 0 auto 10px;
            opacity: .4;
        }

        .vd-table__empty p {
            font-size: .875rem;
        }

        /* ===== BADGE ===== */
        .vd-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 600;
            border: 1px solid;
            white-space: nowrap;
        }

        .vd-badge__dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: block;
            flex-shrink: 0;
        }

        .vd-badge--green {
            background: var(--c-green-bg);
            color: #166534;
            border-color: var(--c-green-border);
        }

        .dark .vd-badge--green {
            color: #86efac;
        }

        .vd-badge--green .vd-badge__dot {
            background: var(--c-green);
        }

        .vd-badge__dot--pulse {
            animation: pulse-soft 2s infinite;
        }

        .vd-badge--red {
            background: var(--c-rose-bg);
            color: #9f1239;
            border-color: var(--c-rose-border);
        }

        .dark .vd-badge--red {
            color: #fda4af;
        }

        .vd-badge--red .vd-badge__dot {
            background: var(--c-rose);
        }

        /* ===== ICON BTN ===== */
        .vd-icon-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--vd-text-muted);
            transition: background .15s, color .15s;
        }

        .vd-icon-btn:hover {
            background: var(--vd-surface-alt);
            color: var(--vd-text-primary);
        }

        .vd-icon-btn svg {
            width: 16px;
            height: 16px;
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
            transition: border-color .2s;
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
            font-size: .875rem;
            font-weight: 600;
        }

        .vd-review__comment {
            font-size: .8125rem;
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
            stroke-width: 0;
        }

        .vd-star--empty {
            color: #d1d5db;
            stroke-width: 1;
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

        .vd-empty-state svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            opacity: .35;
        }

        .vd-empty-state p {
            font-size: .875rem;
            max-width: 240px;
        }

        /* ===== QUICK ACTIONS ===== */
        .vd-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .vd-action {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            cursor: pointer;
            background: none;
            width: 100%;
            text-align: left;
            text-decoration: none;
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }

        .vd-action:hover {
            box-shadow: var(--vd-shadow-sm);
            transform: translateX(2px);
        }

        .vd-action--indigo {
            background: var(--c-indigo-bg);
            border-color: var(--c-indigo-border);
        }

        .vd-action--indigo:hover {
            border-color: rgba(99, 102, 241, .3);
        }

        .vd-action--emerald {
            background: var(--c-emerald-bg);
            border-color: var(--c-emerald-border);
        }

        .vd-action--emerald:hover {
            border-color: rgba(16, 185, 129, .3);
        }

        .vd-action--sky {
            background: var(--c-sky-bg);
            border-color: var(--c-sky-border);
        }

        .vd-action--sky:hover {
            border-color: rgba(14, 165, 233, .3);
        }

        .vd-action--violet {
            background: var(--c-violet-bg);
            border-color: var(--c-violet-border);
        }

        .vd-action--violet:hover {
            border-color: rgba(139, 92, 246, .3);
        }

        .vd-action__icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform .2s;
        }

        .vd-action:hover .vd-action__icon {
            transform: scale(1.08);
        }

        .vd-action__icon svg {
            width: 18px;
            height: 18px;
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
            font-size: .875rem;
            font-weight: 600;
            color: var(--vd-text-primary);
        }

        .vd-action__desc {
            display: block;
            font-size: .75rem;
            color: var(--vd-text-muted);
            margin-top: 2px;
        }

        .vd-action__arrow {
            width: 16px;
            height: 16px;
            color: var(--vd-text-muted);
            flex-shrink: 0;
            transition: transform .2s;
        }

        .vd-action:hover .vd-action__arrow {
            transform: translateX(3px);
        }

        /* ===== CREDITS CARD ===== */
        .vd-credits-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--vd-radius-xl);
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
            box-shadow: 0 8px 32px rgba(99, 102, 241, .35);
            border: 1px solid rgba(255, 255, 255, .15);
        }

        .vd-credits-card__shine {
            position: absolute;
            top: -30%;
            left: -20%;
            width: 60%;
            height: 160%;
            background: linear-gradient(110deg, transparent 30%, rgba(255, 255, 255, .12) 50%, transparent 70%);
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
            background: rgba(255, 255, 255, .06);
            top: -60px;
            right: -40px;
        }

        .vd-credits-card__orb--2 {
            width: 120px;
            height: 120px;
            background: rgba(0, 0, 0, .12);
            bottom: -30px;
            left: -20px;
        }

        .vd-credits-card__inner {
            position: relative;
            z-index: 1;
            padding: 28px;
        }

        .vd-credits-card__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .vd-credits-card__label {
            font-size: .875rem;
            font-weight: 600;
            color: rgba(255, 255, 255, .8);
        }

        .vd-credits-card__badge {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .vd-credits-card__badge svg {
            width: 18px;
            height: 18px;
            color: white;
        }

        .vd-credits-card__amount {
            font-size: 3.2rem;
            font-weight: 900;
            color: white;
            letter-spacing: -.04em;
            line-height: 1;
            margin-bottom: 6px;
        }

        .vd-credits-card__hint {
            font-size: .8rem;
            color: rgba(255, 255, 255, .6);
            margin-bottom: 22px;
        }

        .vd-credits-card__btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: var(--vd-radius-md);
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            color: white;
            font-size: .875rem;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: background .2s, border-color .2s, transform .15s;
        }

        .vd-credits-card__btn svg {
            width: 15px;
            height: 15px;
            transition: transform .2s;
        }

        .vd-credits-card__btn:hover {
            background: rgba(255, 255, 255, .22);
            transform: translateY(-1px);
        }

        .vd-credits-card__btn:hover svg {
            transform: translateX(3px);
        }

        /* ===== RATING CARD ===== */
        .vd-rating-card {
            text-align: center;
        }

        .vd-rating-card .vd-card__body {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 28px 24px;
        }

        .vd-rating-card__title {
            font-size: .875rem;
            font-weight: 700;
            color: var(--vd-text-secondary);
            margin-bottom: 14px;
        }

        .vd-rating-card__score {
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-bottom: 10px;
        }

        .vd-rating-card__number {
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: -.04em;
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .vd-rating-card__max {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--vd-text-muted);
        }

        .vd-rating-card .vd-stars {
            margin-bottom: 8px;
            gap: 3px;
        }

        .vd-rating-card__count {
            font-size: .8rem;
            color: var(--vd-text-muted);
        }

        /* ===== MODALS ===== */
        .vd-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 13, 26, .65);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1000;
            animation: fade-in .2s ease;
        }

        .vd-modal {
            background: var(--vd-surface);
            border: 1px solid var(--vd-border);
            border-radius: var(--vd-radius-xl);
            box-shadow: 0 24px 80px rgba(0, 0, 0, .25);
            width: 100%;
            max-width: 480px;
            animation: scale-in .25s cubic-bezier(.22, .68, 0, 1.2);
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
            gap: 14px;
            padding: 22px 26px;
            border-bottom: 1px solid var(--vd-border);
            position: sticky;
            top: 0;
            z-index: 2;
            background: var(--vd-surface);
        }

        .vd-modal__header-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .vd-modal__header-icon svg {
            width: 18px;
            height: 18px;
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
            font-size: 1rem;
            font-weight: 700;
            color: var(--vd-text-primary);
            flex: 1;
        }

        .vd-modal__close {
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
            transition: background .15s;
            flex-shrink: 0;
            margin-left: auto;
        }

        .vd-modal__close:hover {
            background: var(--vd-surface-alt);
            color: var(--vd-text-primary);
        }

        .vd-modal__close svg {
            width: 16px;
            height: 16px;
        }

        .vd-modal__body {
            padding: 24px 26px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .vd-modal__body--scroll {
            overflow-y: auto;
            flex: 1;
        }

        .vd-modal__footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 18px 26px;
            border-top: 1px solid var(--vd-border);
            background: var(--vd-surface-alt);
            position: sticky;
            bottom: 0;
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
            gap: 14px;
        }

        .vd-label {
            font-size: .75rem;
            font-weight: 600;
            color: var(--vd-text-secondary);
            letter-spacing: .02em;
        }

        .vd-input,
        .vd-select,
        .vd-textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: var(--vd-radius-sm);
            border: 1px solid var(--vd-border);
            background: var(--vd-bg);
            color: var(--vd-text-primary);
            font-size: .875rem;
            font-family: inherit;
            transition: border-color .15s, box-shadow .15s;
            outline: none;
            box-sizing: border-box;
        }

        .vd-input:focus,
        .vd-select:focus,
        .vd-textarea:focus {
            border-color: var(--c-indigo);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
        }

        .vd-textarea {
            resize: vertical;
        }

        .vd-file-input {
            font-size: .8125rem;
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
            padding: 12px 14px;
            border-radius: var(--vd-radius-md);
            border: 1px solid;
            font-size: .8125rem;
            line-height: 1.5;
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

        /* ===== FONT IMPORT ===== */
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap');
    </style>


</div>
