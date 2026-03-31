<div class="vp-root">

    @if ($business)

        {{-- ══════════════════════════════════════════════════════
         HERO
    ══════════════════════════════════════════════════════ --}}
        <section class="vp-hero">
            <!-- Ambient orbs -->
            <div class="vp-orb vp-orb--1"></div>
            <div class="vp-orb vp-orb--2"></div>
            <div class="vp-orb vp-orb--3"></div>
            <!-- Grid texture -->
            <div class="vp-grid"></div>

            <!-- Top bar -->
            <div class="vp-topbar">
                <a href="{{ route('wedding-vendors.index') }}" class="vp-back-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M19 12H5M5 12l7 7M5 12l7-7" />
                    </svg>
                    Back to Vendors
                </a>
                @if ($business->is_featured)
                    <div class="vp-featured-pill">
                        <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Featured Vendor
                    </div>
                @endif
            </div>

            <!-- Hero grid -->
            <div class="vp-hero-grid">

                <!-- Profile card -->
                <div class="vp-profile-card vp-reveal" style="--d:0s">
                    <div class="vp-profile-card__inner">
                        <!-- Avatar -->
                        <div class="vp-avatar-wrap">
                            @if ($business->profile_image)
                                <img src="{{ Storage::url($business->profile_image) }}"
                                    alt="{{ $business->company_name }}" class="vp-avatar-img">
                            @else
                                <div class="vp-avatar-initials">{{ $initials }}</div>
                            @endif
                            <span class="vp-avatar-dot"></span>
                        </div>

                        <!-- Info -->
                        <div class="vp-profile-info">
                            <h1 class="vp-name">{{ $business->company_name }}</h1>

                            <div class="vp-pills">
                                <span class="vp-pill vp-pill--amber">
                                    <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    {{ number_format($averageRating, 1) }}
                                    <span class="vp-pill__sub">({{ $reviewsCount }})</span>
                                </span>
                                <span class="vp-pill vp-pill--sky">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    {{ $business->city ?? 'N/A' }}, {{ $business->country ?? 'N/A' }}
                                </span>
                                @if ($business->category)
                                    <span class="vp-pill vp-pill--violet">{{ $business->category->type }}</span>
                                @endif
                            </div>

                            <!-- Stats row -->
                            <div class="vp-stats">
                                <div class="vp-stat">
                                    <span
                                        class="vp-stat__num">{{ $business->vendor->years_of_experience ?? 0 }}<sub>y</sub></span>
                                    <span class="vp-stat__lbl">Experience</span>
                                </div>
                                <div class="vp-stat__div"></div>
                                <div class="vp-stat">
                                    <span class="vp-stat__num">{{ count($packages) }}</span>
                                    <span class="vp-stat__lbl">Packages</span>
                                </div>
                                <div class="vp-stat__div"></div>
                                <div class="vp-stat">
                                    <span
                                        class="vp-stat__num">{{ $business->vendor->happy_clients ?? 0 }}<sub>+</sub></span>
                                    <span class="vp-stat__lbl">Happy Clients</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price / CTA card -->
                <div class="vp-cta-card vp-reveal" style="--d:.08s">
                    <p class="vp-cta-card__label">Starting from</p>
                    @if ($startingPrice)
                        <div class="vp-cta-card__price">Rs {{ number_format($startingPrice, 0) }}</div>
                    @else
                        <div class="vp-cta-card__price vp-cta-card__price--req">On Request</div>
                    @endif

                    <button onclick="document.getElementById('packages-section').scrollIntoView({behavior:'smooth'})"
                        class="vp-btn vp-btn--primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Check Availability
                    </button>

                    <div class="vp-cta-actions">
                        <button class="vp-btn vp-btn--ghost vp-btn--sm">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Save
                        </button>
                        <button class="vp-btn vp-btn--ghost vp-btn--sm">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share
                        </button>
                    </div>
                </div>

            </div>
        </section>

        {{-- ══════════════════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════════════════ --}}
        <div class="vp-body">
            <livewire:booking.booking-modal />

            <div class="vp-two-col">

                {{-- LEFT — tabs ─────────────────────────────── --}}
                <div class="vp-left" x-data="{ tab: 'about' }">

                    <!-- Tab nav -->
                    <div class="vp-tabs">
                        @foreach ([['about', 'About', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'], ['packages', 'Packages (' . count($packages) . ')', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'], ['services', 'Services (' . count($services) . ')', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'], ['faqs', 'FAQs (' . count($faqs) . ')', 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'], ['reviews', 'Reviews', 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z'], ['gallery', 'Gallery', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z']] as [$key, $label, $icon])
                            <button @click="tab='{{ $key }}'"
                                :class="tab === '{{ $key }}' ? 'vp-tab--active' : ''" class="vp-tab">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
                                </svg>
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>

                    {{-- TAB: About --}}
                    <div x-show="tab==='about'" x-transition:enter="vp-fade-in" class="vp-panel">
                        <p class="vp-body-text">{{ $business->business_desc ?? 'No description available.' }}</p>

                        @if (count($features) > 0)
                            <h3 class="vp-section-title">
                                <span class="vp-section-title__dot"></span>
                                Key Features
                            </h3>
                            <div class="vp-features-grid">
                                @foreach ($features as $f)
                                    <div class="vp-feature-chip">
                                        <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $f }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- TAB: Packages --}}
                    <div x-show="tab==='packages'" x-transition:enter="vp-fade-in" id="packages-section"
                        class="vp-panel">
                        @if (count($packages) > 0)
                            <div class="vp-cards-grid">
                                @foreach ($packages as $pkg)
                                    <div class="vp-pkg-card {{ $pkg['isPopular'] ? 'vp-pkg-card--pop' : '' }}">
                                        @if ($pkg['isPopular'])
                                            <span class="vp-pop-badge">⭐ Popular</span>
                                        @endif
                                        <h3 class="vp-pkg-card__name">{{ $pkg['name'] }}</h3>
                                        @if ($pkg['description'])
                                            <p class="vp-pkg-card__desc">{{ $pkg['description'] }}</p>
                                        @endif

                                        <div class="vp-pkg-card__pricing">
                                            <span class="vp-pkg-card__price">Rs
                                                {{ number_format($pkg['price'], 0) }}</span>
                                            @if ($pkg['discount'])
                                                <span class="vp-pkg-card__orig">Rs
                                                    {{ number_format($pkg['originalPrice'], 0) }}</span>
                                            @endif
                                            @if ($pkg['discountPercentage'])
                                                <span
                                                    class="vp-discount-badge">-{{ number_format($pkg['discountPercentage'], 0) }}%</span>
                                            @endif
                                        </div>

                                        @if (count($pkg['features']) > 0)
                                            <ul class="vp-pkg-card__features">
                                                @foreach ($pkg['features'] as $feat)
                                                    <li>
                                                        <svg width="12" height="12" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $feat }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <button wire:click="openBookingModal('package', {{ $pkg['id'] }})"
                                            class="vp-btn vp-btn--primary vp-btn--full">
                                            Book Now
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="vp-empty">No packages available at the moment.</div>
                        @endif
                    </div>

                    {{-- TAB: Services --}}
                    <div x-show="tab==='services'" x-transition:enter="vp-fade-in" class="vp-panel">
                        @if (count($services) > 0)
                            <div class="vp-cards-grid">
                                @foreach ($services as $svc)
                                    <div class="vp-svc-card">
                                        @if ($svc['img'])
                                            <div class="vp-svc-card__img">
                                                <img src="{{ Storage::url($svc['img']) }}"
                                                    alt="{{ $svc['name'] }}">
                                            </div>
                                        @endif
                                        <div class="vp-svc-card__body">
                                            <h3 class="vp-svc-card__name">{{ $svc['name'] }}</h3>
                                            @if ($svc['description'])
                                                <p class="vp-svc-card__desc">{{ $svc['description'] }}</p>
                                            @endif
                                            <div class="vp-svc-card__footer">
                                                <span class="vp-svc-card__price">Rs
                                                    {{ number_format($svc['price'], 0) }}</span>
                                                <button wire:click="openBookingModal('service', {{ $svc['id'] }})"
                                                    class="vp-btn vp-btn--sky vp-btn--sm">Book</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="vp-empty">No services listed.</div>
                        @endif
                    </div>

                    {{-- TAB: FAQs --}}
                    <div x-show="tab==='faqs'" x-transition:enter="vp-fade-in" class="vp-panel">
                        @if (count($faqs) > 0)
                            <div class="vp-faqs">
                                @foreach ($faqs as $i => $faq)
                                    <div x-data="{ open: false }" class="vp-faq" :class="open && 'vp-faq--open'">
                                        <button @click="open=!open" class="vp-faq__q">
                                            <span>{{ is_array($faq) ? $faq['question'] ?? '' : $faq }}</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5" :class="open && 'rotate-180'"
                                                class="vp-faq__icon">
                                                <path d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div x-show="open" x-collapse class="vp-faq__a">
                                            {{ is_array($faq) ? $faq['answer'] ?? 'Answer not available' : 'Answer not available' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="vp-empty">No FAQs available.</div>
                        @endif
                    </div>

                    {{-- TAB: Reviews --}}
                    <div x-show="tab==='reviews'" x-transition:enter="vp-fade-in" class="vp-panel">
                        @if ($reviewsCount > 0)
                            <!-- Rating summary -->
                            <div class="vp-rating-summary">
                                <div class="vp-rating-summary__score">{{ number_format($averageRating, 1) }}</div>
                                <div>
                                    <div class="vp-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg width="17" height="17" viewBox="0 0 20 20"
                                                class="{{ $i <= round($averageRating) ? 'vp-star--on' : 'vp-star--off' }}"
                                                fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="vp-rating-summary__sub">{{ $reviewsCount }} verified reviews</p>
                                </div>
                            </div>

                            <div class="vp-reviews">
                                @foreach ($reviews as $rev)
                                    <div class="vp-review">
                                        @if ($rev['reviewerImage'])
                                            <img src="{{ Storage::url($rev['reviewerImage']) }}"
                                                class="vp-review__avatar vp-review__avatar--img">
                                        @else
                                            <div class="vp-review__avatar">{{ substr($rev['reviewerName'], 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="vp-review__body">
                                            <div class="vp-review__top">
                                                <span class="vp-review__name">{{ $rev['reviewerName'] }}</span>
                                                <span
                                                    class="vp-review__date">{{ $rev['createdAt']->diffForHumans() }}</span>
                                            </div>
                                            <div class="vp-stars vp-stars--sm">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg width="13" height="13" viewBox="0 0 20 20"
                                                        class="{{ $i <= $rev['rating'] ? 'vp-star--on' : 'vp-star--off' }}"
                                                        fill="currentColor">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="vp-review__text">{{ $rev['comment'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="vp-empty">No reviews yet. Be the first!</div>
                        @endif
                    </div>

                    {{-- TAB: Gallery --}}
                    <div x-show="tab==='gallery'" x-transition:enter="vp-fade-in" class="vp-panel">
                        @if (count($portfolioImages) > 0)
                            <div class="vp-gallery">
                                @foreach ($portfolioImages as $img)
                                    <div class="vp-gallery__item">
                                        <img src="{{ is_string($img) ? Storage::url($img) : (isset($img['url']) ? Storage::url($img['url']) : '') }}"
                                            alt="Gallery">
                                        <div class="vp-gallery__overlay">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="vp-empty">No gallery images available.</div>
                        @endif
                    </div>

                </div>{{-- /vp-left --}}

                {{-- RIGHT — Contact ─────────────────────────── --}}
                <div class="vp-right">
                    <div class="vp-contact-card vp-reveal" style="--d:.12s">
                        <h3 class="vp-contact-card__title">Get in Touch</h3>

                        <div class="vp-contact-list">
                            @if ($business->business_phone)
                                <a href="tel:{{ $business->business_phone }}"
                                    class="vp-contact-row vp-contact-row--cyan">
                                    <div class="vp-contact-row__icon"
                                        style="background:linear-gradient(135deg,#0ea5e9,#0284c7)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2">
                                            <path
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="vp-contact-row__lbl">Call</p>
                                        <p class="vp-contact-row__val">{{ $business->business_phone }}</p>
                                    </div>
                                </a>
                            @endif

                            @if ($business->business_email)
                                <a href="mailto:{{ $business->business_email }}"
                                    class="vp-contact-row vp-contact-row--rose">
                                    <div class="vp-contact-row__icon"
                                        style="background:linear-gradient(135deg,#f43f5e,#e11d48)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2">
                                            <path
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="vp-contact-row__lbl">Email</p>
                                        <p class="vp-contact-row__val">{{ $business->business_email }}</p>
                                    </div>
                                </a>
                            @endif

                            @if ($business->website)
                                <a href="{{ $business->website }}" target="_blank"
                                    class="vp-contact-row vp-contact-row--amber">
                                    <div class="vp-contact-row__icon"
                                        style="background:linear-gradient(135deg,#f59e0b,#d97706)">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2">
                                            <path
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="vp-contact-row__lbl">Website</p>
                                        <p class="vp-contact-row__val">Visit Site</p>
                                    </div>
                                </a>
                            @endif
                        </div>

                        @if ($business->social_links && is_array($business->social_links))
                            <div class="vp-socials">
                                <p class="vp-socials__lbl">Follow Us</p>
                                <div class="vp-socials__row">
                                    @if (isset($business->social_links['instagram']))
                                        <a href="{{ $business->social_links['instagram'] }}" target="_blank"
                                            class="vp-social-btn" style="--c:#e1306c">
                                            <svg width="16" height="16" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if (isset($business->social_links['facebook']))
                                        <a href="{{ $business->social_links['facebook'] }}" target="_blank"
                                            class="vp-social-btn" style="--c:#1877f2">
                                            <svg width="16" height="16" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if (isset($business->social_links['twitter']))
                                        <a href="{{ $business->social_links['twitter'] }}" target="_blank"
                                            class="vp-social-btn" style="--c:#1da1f2">
                                            <svg width="16" height="16" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.104c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>{{-- /vp-two-col --}}

            {{-- CTA Banner --}}
            <div class="vp-cta-banner vp-reveal" style="--d:.05s">
                <div class="vp-cta-banner__orb vp-cta-banner__orb--1"></div>
                <div class="vp-cta-banner__orb vp-cta-banner__orb--2"></div>
                <div class="vp-cta-banner__content">
                    <h2 class="vp-cta-banner__title">Ready to Collaborate?</h2>
                    <p class="vp-cta-banner__sub">Get in touch with <strong>{{ $business->company_name }}</strong> and
                        let's create something amazing together.</p>
                    <div class="vp-cta-banner__btns">
                        <a href="tel:{{ $business->business_phone ?? '#' }}" class="vp-btn vp-btn--white">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Call Now
                        </a>
                        <a href="mailto:{{ $business->business_email ?? '#' }}" class="vp-btn vp-btn--outline-white">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5">
                                <path
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Email
                        </a>
                    </div>
                </div>
            </div>

        </div>{{-- /vp-body --}}
    @else
        {{-- Not Found --}}
        <div class="vp-notfound">
            <div class="vp-notfound__icon">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3>Vendor Not Found</h3>
            <p>This vendor doesn't exist or has been removed.</p>
            <a href="{{ route('wedding-vendors.index') }}" class="vp-btn vp-btn--primary">Back to Vendors</a>
        </div>
    @endif

    <style>
        /* ═══════════════════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════════════════ */
        :root {
            --vp-font: 'DM Sans', system-ui, sans-serif;

            /* Surfaces */
            --vp-bg: #f6f5ff;
            --vp-card: rgba(255, 255, 255, 0.72);
            --vp-card-alt: rgba(255, 255, 255, 0.55);

            /* Borders — ultra thin */
            --vp-border: rgba(120, 100, 220, .10);
            --vp-border-md: rgba(120, 100, 220, .18);
            --vp-border-hov: rgba(120, 100, 220, .32);

            /* Text */
            --vp-text: #0f0b20;
            --vp-muted: #6b5e8c;
            --vp-subtle: #a199c0;

            /* Accents */
            --vp-rose: #f43f5e;
            --vp-violet: #7c3aed;
            --vp-sky: #0ea5e9;
            --vp-amber: #f59e0b;
            --vp-emerald: #10b981;

            /* Radius */
            --vp-r-sm: 10px;
            --vp-r-md: 16px;
            --vp-r-lg: 22px;
            --vp-r-xl: 28px;

            /* Shadows */
            --vp-shadow-sm: 0 1px 3px rgba(50, 30, 120, .06), 0 1px 2px rgba(50, 30, 120, .04);
            --vp-shadow-md: 0 4px 20px rgba(50, 30, 120, .09), 0 1px 4px rgba(50, 30, 120, .05);
            --vp-shadow-lg: 0 12px 40px rgba(50, 30, 120, .12), 0 2px 8px rgba(50, 30, 120, .06);
        }

        .dark {
            --vp-bg: #0c0a18;
            --vp-card: rgba(20, 16, 42, .75);
            --vp-card-alt: rgba(20, 16, 42, .55);
            --vp-border: rgba(140, 120, 255, .09);
            --vp-border-md: rgba(140, 120, 255, .16);
            --vp-border-hov: rgba(140, 120, 255, .30);
            --vp-text: #ede9ff;
            --vp-muted: #9d90c8;
            --vp-subtle: #5e5680;
        }

        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800&display=swap');

        /* ── Root ── */
        .vp-root {
            font-family: var(--vp-font);
            background: var(--vp-bg);
            color: var(--vp-text);
            min-height: 100vh;
        }

        /* ── Animations ── */
        @keyframes vp-orb {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            40% {
                transform: translate(30px, -25px) scale(1.07);
            }

            70% {
                transform: translate(-18px, 18px) scale(.95);
            }
        }

        @keyframes vp-reveal {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes vp-fade {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .vp-reveal {
            animation: vp-reveal .55s cubic-bezier(.22, .68, 0, 1.2) var(--d, 0s) both;
        }

        .vp-fade-in {
            animation: vp-fade .3s ease;
        }

        /* ══════════════════════════════════════════
   HERO
══════════════════════════════════════════ */
        .vp-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg,
                    #fff9fe 0%,
                    #f0edff 45%,
                    #e8f4ff 100%);
            padding: 0 0 48px;
        }

        .dark .vp-hero {
            background: linear-gradient(145deg, #100d20 0%, #0d0a1e 55%, #080c1a 100%);
        }

        /* Grid texture */
        .vp-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--vp-border) 1px, transparent 1px),
                linear-gradient(90deg, var(--vp-border) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: radial-gradient(ellipse 90% 70% at 50% 0%, black 30%, transparent 100%);
            pointer-events: none;
        }

        /* Orbs */
        .vp-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .vp-orb--1 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, #a78bfa 0%, transparent 70%);
            top: -140px;
            right: -80px;
            opacity: .22;
            animation: vp-orb 18s ease-in-out infinite;
        }

        .vp-orb--2 {
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, #38bdf8 0%, transparent 70%);
            bottom: -60px;
            left: -80px;
            opacity: .18;
            animation: vp-orb 22s ease-in-out infinite reverse;
        }

        .vp-orb--3 {
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, #f472b6 0%, transparent 70%);
            top: 40%;
            right: 25%;
            opacity: .14;
            animation: vp-orb 14s ease-in-out infinite 3s;
        }

        /* Top bar */
        .vp-topbar {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 32px 16px;
        }

        /* Back button */
        .vp-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: var(--vp-r-md);
            background: var(--vp-card);
            border: 1px solid var(--vp-border-md);
            color: var(--vp-text);
            font-size: .825rem;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(12px);
            transition: border-color .2s, box-shadow .2s, transform .15s;
            box-shadow: var(--vp-shadow-sm);
        }

        .vp-back-btn:hover {
            border-color: var(--vp-border-hov);
            box-shadow: var(--vp-shadow-md);
            transform: translateY(-1px);
        }

        /* Featured pill */
        .vp-featured-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 999px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .03em;
            box-shadow: 0 3px 12px rgba(245, 158, 11, .35);
        }

        /* Hero grid */
        .vp-hero-grid {
            position: relative;
            z-index: 5;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            padding: 16px 32px 0;
            max-width: 1240px;
            margin: 0 auto;
        }

        @media(max-width:900px) {
            .vp-hero-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Profile card ── */
        .vp-profile-card {
            background: var(--vp-card);
            border: 1px solid var(--vp-border-md);
            border-radius: var(--vp-r-xl);
            backdrop-filter: blur(24px);
            box-shadow: var(--vp-shadow-lg);
            overflow: hidden;
            transition: border-color .2s;
        }

        .vp-profile-card:hover {
            border-color: var(--vp-border-hov);
        }

        .vp-profile-card__inner {
            display: flex;
            align-items: flex-start;
            gap: 28px;
            padding: 32px 36px;
        }

        @media(max-width:640px) {
            .vp-profile-card__inner {
                flex-direction: column;
            }
        }

        /* Avatar */
        .vp-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .vp-avatar-img,
        .vp-avatar-initials {
            width: 120px;
            height: 120px;
            border-radius: var(--vp-r-lg);
            border: 1.5px solid var(--vp-border-md);
            object-fit: cover;
            box-shadow: var(--vp-shadow-md);
            transition: transform .25s;
        }

        .vp-avatar-initials {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
        }

        .vp-avatar-wrap:hover .vp-avatar-img,
        .vp-avatar-wrap:hover .vp-avatar-initials {
            transform: scale(1.04);
        }

        .vp-avatar-dot {
            position: absolute;
            bottom: -3px;
            right: -3px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #10b981;
            border: 2.5px solid var(--vp-bg);
            box-shadow: 0 0 0 2px rgba(16, 185, 129, .3);
        }

        /* Profile info */
        .vp-profile-info {
            flex: 1;
            min-width: 0;
        }

        .vp-name {
            font-size: clamp(1.6rem, 3.5vw, 2.6rem);
            font-weight: 800;
            letter-spacing: -.03em;
            line-height: 1.1;
            margin: 0 0 14px;
            background: linear-gradient(135deg, #4f46e5 10%, #7c3aed 45%, #db2777 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dark .vp-name {
            background: linear-gradient(135deg, #a78bfa 10%, #c084fc 45%, #f9a8d4 90%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Pills */
        .vp-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 20px;
        }

        .vp-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 600;
            border: 1px solid;
            backdrop-filter: blur(8px);
            transition: transform .15s;
        }

        .vp-pill:hover {
            transform: scale(1.03);
        }

        .vp-pill__sub {
            opacity: .65;
        }

        .vp-pill--amber {
            background: rgba(245, 158, 11, .1);
            border-color: rgba(245, 158, 11, .25);
            color: #b45309;
        }

        .dark .vp-pill--amber {
            color: #fbbf24;
        }

        .vp-pill--sky {
            background: rgba(14, 165, 233, .1);
            border-color: rgba(14, 165, 233, .25);
            color: #0369a1;
        }

        .dark .vp-pill--sky {
            color: #38bdf8;
        }

        .vp-pill--violet {
            background: rgba(124, 58, 237, .1);
            border-color: rgba(124, 58, 237, .25);
            color: #6d28d9;
        }

        .dark .vp-pill--violet {
            color: #a78bfa;
        }

        /* Stats row */
        .vp-stats {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 14px 18px;
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            width: fit-content;
            backdrop-filter: blur(12px);
            gap: 20px;
        }

        .vp-stat {
            text-align: center;
        }

        .vp-stat__num {
            display: block;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -.04em;
            color: var(--vp-text);
        }

        .vp-stat__num sub {
            font-size: .55em;
            font-weight: 600;
            opacity: .65;
        }

        .vp-stat__lbl {
            font-size: .68rem;
            font-weight: 500;
            color: var(--vp-subtle);
            margin-top: 1px;
            display: block;
        }

        .vp-stat__div {
            width: 1px;
            height: 32px;
            background: var(--vp-border-md);
        }

        /* ── CTA card ── */
        .vp-cta-card {
            background: var(--vp-card);
            border: 1px solid var(--vp-border-md);
            border-radius: var(--vp-r-xl);
            padding: 28px;
            backdrop-filter: blur(24px);
            box-shadow: var(--vp-shadow-lg);
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: border-color .2s;
            height: fit-content;
        }

        .vp-cta-card:hover {
            border-color: var(--vp-border-hov);
        }

        .vp-cta-card__label {
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .09em;
            color: var(--vp-subtle);
        }

        .vp-cta-card__price {
            font-size: 2.4rem;
            font-weight: 900;
            letter-spacing: -.04em;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .vp-cta-card__price--req {
            font-size: 1.8rem;
        }

        .vp-cta-actions {
            display: flex;
            gap: 8px;
        }

        /* ══════════════════════════════════════════
   BUTTONS
══════════════════════════════════════════ */
        .vp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: var(--vp-r-sm);
            font-size: .84rem;
            font-weight: 600;
            border: 1.5px solid transparent;
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, opacity .15s;
            text-decoration: none;
            letter-spacing: -.01em;
            white-space: nowrap;
        }

        .vp-btn:hover {
            transform: translateY(-1px);
        }

        .vp-btn:active {
            transform: scale(.98);
        }

        .vp-btn--primary {
            background: linear-gradient(135deg, #6d28d9, #7c3aed);
            color: #fff;
            box-shadow: 0 2px 14px rgba(109, 40, 217, .35);
        }

        .vp-btn--primary:hover {
            box-shadow: 0 4px 22px rgba(109, 40, 217, .45);
        }

        .vp-btn--ghost {
            background: var(--vp-card-alt);
            border-color: var(--vp-border-md);
            color: var(--vp-muted);
            backdrop-filter: blur(8px);
        }

        .vp-btn--ghost:hover {
            border-color: var(--vp-border-hov);
            color: var(--vp-text);
        }

        .vp-btn--sky {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: #fff;
            box-shadow: 0 2px 10px rgba(14, 165, 233, .3);
        }

        .vp-btn--white {
            background: #fff;
            color: #0f0b20;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .12);
        }

        .vp-btn--white:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, .18);
        }

        .vp-btn--outline-white {
            background: transparent;
            border-color: rgba(255, 255, 255, .55);
            color: #fff;
        }

        .vp-btn--outline-white:hover {
            background: rgba(255, 255, 255, .15);
        }

        .vp-btn--sm {
            padding: 7px 14px;
            font-size: .78rem;
        }

        .vp-btn--full {
            width: 100%;
        }

        /* ══════════════════════════════════════════
   BODY
══════════════════════════════════════════ */
        .vp-body {
            max-width: 1240px;
            margin: 0 auto;
            padding: 32px 32px 64px;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        @media(max-width:640px) {
            .vp-body {
                padding: 20px 16px 48px;
            }
        }

        .vp-two-col {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
            align-items: start;
        }

        @media(max-width:900px) {
            .vp-two-col {
                grid-template-columns: 1fr;
            }
        }

        .vp-left {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .vp-right {
            position: sticky;
            top: 80px;
        }

        /* ══════════════════════════════════════════
   TABS
══════════════════════════════════════════ */
        .vp-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 5px;
            background: var(--vp-card);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            margin-bottom: 16px;
            backdrop-filter: blur(12px);
            box-shadow: var(--vp-shadow-sm);
        }

        .vp-tab {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: var(--vp-r-sm);
            font-size: .78rem;
            font-weight: 600;
            color: var(--vp-muted);
            border: none;
            background: transparent;
            cursor: pointer;
            transition: background .15s, color .15s;
            white-space: nowrap;
        }

        .vp-tab:hover {
            background: var(--vp-card-alt);
            color: var(--vp-text);
        }

        .vp-tab--active {
            background: linear-gradient(135deg, #6d28d9, #7c3aed) !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(109, 40, 217, .3);
        }

        /* ══════════════════════════════════════════
   PANEL (shared tab content wrapper)
══════════════════════════════════════════ */
        .vp-panel {
            background: var(--vp-card);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-lg);
            padding: 28px;
            backdrop-filter: blur(20px);
            box-shadow: var(--vp-shadow-sm);
            transition: border-color .2s;
        }

        /* ══════════════════════════════════════════
   ABOUT
══════════════════════════════════════════ */
        .vp-body-text {
            font-size: .9rem;
            line-height: 1.7;
            color: var(--vp-muted);
            margin: 0 0 24px;
        }

        .vp-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 1rem;
            font-weight: 700;
            color: var(--vp-text);
            margin: 0 0 16px;
        }

        .vp-section-title__dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            flex-shrink: 0;
        }

        .vp-features-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .vp-feature-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            background: rgba(16, 185, 129, .08);
            border: 1px solid rgba(16, 185, 129, .2);
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            color: #065f46;
            transition: border-color .15s, transform .15s;
        }

        .dark .vp-feature-chip {
            color: #6ee7b7;
        }

        .vp-feature-chip:hover {
            border-color: rgba(16, 185, 129, .4);
            transform: translateY(-1px);
        }

        .vp-feature-chip svg {
            color: #10b981;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
   CARDS GRID (packages + services)
══════════════════════════════════════════ */
        .vp-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 14px;
        }

        /* ── Package card ── */
        .vp-pkg-card {
            position: relative;
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-lg);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: border-color .2s, box-shadow .2s, transform .2s;
            backdrop-filter: blur(16px);
        }

        .vp-pkg-card:hover {
            border-color: rgba(124, 58, 237, .35);
            box-shadow: 0 8px 30px rgba(124, 58, 237, .12);
            transform: translateY(-2px);
        }

        .vp-pkg-card--pop {
            border-color: rgba(124, 58, 237, .28);
            background: linear-gradient(145deg, rgba(109, 40, 217, .06), rgba(219, 39, 119, .04));
        }

        .vp-pop-badge {
            position: absolute;
            top: -1px;
            right: 14px;
            padding: 4px 10px;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            border-radius: 0 0 8px 8px;
            letter-spacing: .04em;
            box-shadow: 0 2px 8px rgba(245, 158, 11, .3);
        }

        .vp-pkg-card__name {
            font-size: .95rem;
            font-weight: 700;
            color: var(--vp-text);
            margin: 0;
            padding-top: 6px;
        }

        .vp-pkg-card__desc {
            font-size: .78rem;
            color: var(--vp-muted);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
        }

        .vp-pkg-card__pricing {
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 6px;
        }

        .vp-pkg-card__price {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -.03em;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .vp-pkg-card__orig {
            font-size: .78rem;
            color: var(--vp-subtle);
            text-decoration: line-through;
        }

        .vp-discount-badge {
            padding: 2px 8px;
            background: rgba(16, 185, 129, .12);
            border: 1px solid rgba(16, 185, 129, .22);
            border-radius: 999px;
            font-size: .65rem;
            font-weight: 700;
            color: #065f46;
        }

        .dark .vp-discount-badge {
            color: #6ee7b7;
        }

        .vp-pkg-card__features {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 5px;
            flex: 1;
        }

        .vp-pkg-card__features li {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            font-size: .76rem;
            color: var(--vp-muted);
            line-height: 1.4;
        }

        .vp-pkg-card__features svg {
            color: var(--vp-emerald);
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Service card ── */
        .vp-svc-card {
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-lg);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: border-color .2s, box-shadow .2s, transform .2s;
            backdrop-filter: blur(16px);
        }

        .vp-svc-card:hover {
            border-color: rgba(14, 165, 233, .3);
            box-shadow: 0 8px 28px rgba(14, 165, 233, .1);
            transform: translateY(-2px);
        }

        .vp-svc-card__img {
            height: 120px;
            overflow: hidden;
        }

        .vp-svc-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
        }

        .vp-svc-card:hover .vp-svc-card__img img {
            transform: scale(1.07);
        }

        .vp-svc-card__body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        .vp-svc-card__name {
            font-size: .9rem;
            font-weight: 700;
            color: var(--vp-text);
            margin: 0;
        }

        .vp-svc-card__desc {
            font-size: .75rem;
            color: var(--vp-muted);
            line-height: 1.45;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .vp-svc-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 8px;
            border-top: 1px solid var(--vp-border);
            margin-top: auto;
        }

        .vp-svc-card__price {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--vp-sky);
        }

        /* ══════════════════════════════════════════
   FAQS
══════════════════════════════════════════ */
        .vp-faqs {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .vp-faq {
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            overflow: hidden;
            backdrop-filter: blur(12px);
            transition: border-color .2s;
        }

        .vp-faq--open,
        .vp-faq:hover {
            border-color: var(--vp-border-hov);
        }

        .vp-faq__q {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: .86rem;
            font-weight: 600;
            color: var(--vp-text);
            text-align: left;
            gap: 12px;
        }

        .vp-faq__icon {
            flex-shrink: 0;
            transition: transform .25s;
            color: var(--vp-violet);
        }

        .vp-faq__a {
            padding: 0 18px 14px;
            font-size: .82rem;
            color: var(--vp-muted);
            line-height: 1.65;
        }

        /* ══════════════════════════════════════════
   REVIEWS
══════════════════════════════════════════ */
        .vp-rating-summary {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 20px 22px;
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            margin-bottom: 20px;
            backdrop-filter: blur(12px);
        }

        .vp-rating-summary__score {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -.05em;
            color: var(--vp-text);
            line-height: 1;
        }

        .vp-rating-summary__sub {
            font-size: .75rem;
            color: var(--vp-subtle);
            margin-top: 4px;
        }

        .vp-stars {
            display: flex;
            gap: 2px;
        }

        .vp-stars--sm {
            margin: 3px 0 4px;
        }

        .vp-star--on {
            color: #f59e0b;
        }

        .vp-star--off {
            color: #d1d5db;
        }

        .dark .vp-star--off {
            color: #374151;
        }

        .vp-reviews {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .vp-review {
            display: flex;
            gap: 12px;
            padding: 16px;
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            transition: border-color .2s;
            backdrop-filter: blur(12px);
        }

        .vp-review:hover {
            border-color: var(--vp-border-hov);
        }

        .vp-review__avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6d28d9, #db2777);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            border: 1px solid var(--vp-border-md);
        }

        .vp-review__avatar--img {
            object-fit: cover;
        }

        .vp-review__body {
            flex: 1;
            min-width: 0;
        }

        .vp-review__top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }

        .vp-review__name {
            font-size: .84rem;
            font-weight: 700;
            color: var(--vp-text);
        }

        .vp-review__date {
            font-size: .72rem;
            color: var(--vp-subtle);
        }

        .vp-review__text {
            font-size: .8rem;
            color: var(--vp-muted);
            line-height: 1.55;
            margin-top: 5px;
        }

        /* ══════════════════════════════════════════
   GALLERY
══════════════════════════════════════════ */
        .vp-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 10px;
        }

        .vp-gallery__item {
            position: relative;
            aspect-ratio: 1;
            border-radius: var(--vp-r-md);
            overflow: hidden;
            border: 1px solid var(--vp-border);
            cursor: pointer;
            transition: border-color .2s;
        }

        .vp-gallery__item:hover {
            border-color: var(--vp-border-hov);
        }

        .vp-gallery__item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
        }

        .vp-gallery__item:hover img {
            transform: scale(1.1);
        }

        .vp-gallery__overlay {
            position: absolute;
            inset: 0;
            background: rgba(10, 5, 30, .5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .25s;
            color: #fff;
        }

        .vp-gallery__item:hover .vp-gallery__overlay {
            opacity: 1;
        }

        /* ══════════════════════════════════════════
   CONTACT CARD
══════════════════════════════════════════ */
        .vp-contact-card {
            background: var(--vp-card);
            border: 1px solid var(--vp-border-md);
            border-radius: var(--vp-r-xl);
            padding: 24px;
            backdrop-filter: blur(20px);
            box-shadow: var(--vp-shadow-md);
        }

        .vp-contact-card__title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--vp-text);
            margin: 0 0 16px;
        }

        .vp-contact-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .vp-contact-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            border-radius: var(--vp-r-md);
            text-decoration: none;
            transition: border-color .2s, transform .15s, box-shadow .2s;
            backdrop-filter: blur(8px);
        }

        .vp-contact-row:hover {
            border-color: var(--vp-border-hov);
            transform: translateX(3px);
            box-shadow: var(--vp-shadow-sm);
        }

        .vp-contact-row__icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .vp-contact-row__lbl {
            font-size: .66rem;
            font-weight: 600;
            color: var(--vp-subtle);
            margin-bottom: 1px;
            display: block;
        }

        .vp-contact-row__val {
            font-size: .8rem;
            font-weight: 600;
            color: var(--vp-text);
            display: block;
        }

        /* Socials */
        .vp-socials {
            padding-top: 14px;
            border-top: 1px solid var(--vp-border);
        }

        .vp-socials__lbl {
            font-size: .66rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--vp-subtle);
            margin-bottom: 10px;
        }

        .vp-socials__row {
            display: flex;
            gap: 8px;
        }

        .vp-social-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--vp-r-sm);
            background: var(--vp-card-alt);
            border: 1px solid var(--vp-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--c, var(--vp-muted));
            transition: border-color .2s, transform .15s, background .2s;
            backdrop-filter: blur(8px);
        }

        .vp-social-btn:hover {
            background: var(--c, #888);
            color: #fff;
            border-color: transparent;
            transform: translateY(-2px);
        }

        /* ══════════════════════════════════════════
   CTA BANNER
══════════════════════════════════════════ */
        .vp-cta-banner {
            position: relative;
            overflow: hidden;
            border-radius: var(--vp-r-xl);
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 35%, #db2777 70%, #f97316 100%);
            padding: 56px 48px;
            text-align: center;
            box-shadow: 0 16px 60px rgba(109, 40, 217, .3);
        }

        @media(max-width:640px) {
            .vp-cta-banner {
                padding: 36px 24px;
            }
        }

        .vp-cta-banner__orb {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            pointer-events: none;
        }

        .vp-cta-banner__orb--1 {
            width: 280px;
            height: 280px;
            top: -80px;
            right: -60px;
        }

        .vp-cta-banner__orb--2 {
            width: 200px;
            height: 200px;
            bottom: -60px;
            left: -40px;
        }

        .vp-cta-banner__content {
            position: relative;
            z-index: 1;
        }

        .vp-cta-banner__title {
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 900;
            color: #fff;
            margin: 0 0 10px;
            letter-spacing: -.03em;
        }

        .vp-cta-banner__sub {
            font-size: .95rem;
            color: rgba(255, 255, 255, .85);
            margin: 0 0 28px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .vp-cta-banner__btns {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        /* ══════════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════════ */
        .vp-empty {
            padding: 40px;
            text-align: center;
            color: var(--vp-subtle);
            font-size: .875rem;
        }

        /* ══════════════════════════════════════════
   NOT FOUND
══════════════════════════════════════════ */
        .vp-notfound {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            padding: 48px 24px;
            text-align: center;
        }

        .vp-notfound__icon {
            width: 96px;
            height: 96px;
            border-radius: var(--vp-r-lg);
            background: linear-gradient(135deg, #7c3aed, #db2777);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 8px 32px rgba(124, 58, 237, .3);
            margin-bottom: 8px;
        }

        .vp-notfound h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--vp-text);
            margin: 0;
        }

        .vp-notfound p {
            color: var(--vp-muted);
            margin: 0;
        }

        /* ══════════════════════════════════════════
   FLOAT ANIMATION (keep existing classes)
══════════════════════════════════════════ */
        @keyframes float-subtle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .animate-float {
            animation: float-subtle 8s ease-in-out infinite;
        }

        .animate-float-delay-1 {
            animation: float-subtle 10s ease-in-out infinite 1s;
        }

        .animate-float-delay-2 {
            animation: float-subtle 12s ease-in-out infinite 2s;
        }
    </style>

</div>
