<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap');

    :root {
        --primary-orange: #FF6B35;
        --primary-yellow: #1d1b17;
        --primary-rose: #F24060;
        --accent-gold: #FFA500;
        --accent-coral: #FF7A5C;
        --dark-bg: #0F172A;
        --light-bg: #FFFFFF;
    }

    * {
        font-family: 'Poppins', sans-serif;
    }

    .businesses-container {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.03) 0%, rgba(242, 64, 96, 0.03) 100%);
        min-height: 100vh;
        padding: 2rem;
    }

    .header-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        gap: 1.5rem;
    }

    .header-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #FF6B35 0%, #F24060 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .btn-add-business {
        background: linear-gradient(135deg, #FF6B35 0%, #FF7A5C 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-add-business:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }

    .btn-add-business::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #F24060 0%, #FF6B35 100%);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .btn-add-business:hover::before {
        left: 0;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 253, 240, 0.95) 100%);
        border-radius: 20px;
        border: 2px solid rgba(255, 107, 53, 0.1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(10px);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #FFE5CC 0%, #FFD4E5 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .empty-text {
        color: #0F172A;
        margin-bottom: 1.5rem;
    }

    .empty-text h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #0F172A;
    }

    .empty-text p {
        color: #666;
        font-size: 0.95rem;
    }

    .business-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 252, 245, 0.98) 100%);
        border-radius: 20px;
        border: 1px solid rgba(255, 107, 53, 0.1);
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        margin-bottom: 1.5rem;
    }

    .business-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(255, 107, 53, 0.15);
        border-color: rgba(255, 107, 53, 0.2);
    }

    .cover-image {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #FF6B35 0%, #F24060 100%);
    }

    .cover-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.4) 0%, rgba(242, 64, 96, 0.4) 100%);
        mix-blend-mode: overlay;
    }

    .profile-image {
        position: absolute;
        bottom: -50px;
        left: 24px;
        width: 120px;
        height: 120px;
        border-radius: 16px;
        border: 5px solid white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: white;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #FFE5CC 0%, #FFD4E5 100%);
        color: #FF6B35;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .rating-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.75rem 1.25rem;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        font-weight: 600;
    }

    .rating-badge svg {
        width: 18px;
        height: 18px;
        color: #FFD166;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .rating-number {
        color: #0F172A;
        font-size: 1rem;
    }

    .rating-count {
        color: #888;
        font-size: 0.85rem;
    }

    .business-info {
        padding-top: 70px;
        padding-left: 24px;
        padding-right: 24px;
        padding-bottom: 24px;
    }

    .business-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 20px;
    }

    .business-title {
        flex: 1;
    }

    .company-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 0.75rem;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 166, 0, 0.1) 100%);
        border: 1.5px solid rgba(255, 107, 53, 0.2);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #FF6B35;
        transition: all 0.3s ease;
    }

    .category-badge:hover {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.15) 0%, rgba(255, 166, 0, 0.15) 100%);
        border-color: rgba(255, 107, 53, 0.3);
    }

    .stats-container {
        display: flex;
        gap: 1.5rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(242, 64, 96, 0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(255, 107, 53, 0.1);
        flex: 1;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #FF6B35;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #666;
        font-weight: 500;
    }

    .business-description {
        margin: 16px 0;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .contact-info {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin: 16px 0;
        padding: 12px 0;
        border-top: 1px solid rgba(255, 107, 53, 0.1);
        border-bottom: 1px solid rgba(255, 107, 53, 0.1);
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    .contact-item svg {
        width: 16px;
        height: 16px;
        color: #FF6B35;
    }

    .card-actions {
        display: flex;
        gap: 0.75rem;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid rgba(255, 107, 53, 0.1);
    }

    .btn-edit,
    .btn-delete {
        flex: 1;
        padding: 0.75rem 1rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.15) 0%, rgba(255, 166, 0, 0.15) 100%);
        color: #FF6B35;
        border: 1.5px solid rgba(255, 107, 53, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.25) 0%, rgba(255, 166, 0, 0.25) 100%);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: linear-gradient(135deg, rgba(242, 64, 96, 0.1) 0%, rgba(255, 127, 92, 0.1) 100%);
        color: #F24060;
        border: 1.5px solid rgba(242, 64, 96, 0.2);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, rgba(242, 64, 96, 0.15) 0%, rgba(255, 127, 92, 0.15) 100%);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .header-title {
            font-size: 1.75rem;
        }

        .business-header {
            flex-direction: column;
        }

        .stats-container {
            flex-direction: column;
        }

        .card-actions {
            flex-direction: column;
        }
    }
</style>

<div class="businesses-container">
    <!-- Header -->
    <div class="header-section">
        <h1 class="header-title">My Businesses</h1>
        <a href="{{ route('vendor.business.create') }}" class="btn-add-business">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Business
        </a>
    </div>

    <!-- Businesses Grid -->
    @if($businesses->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm6 0c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zM6 14s-1 2-3 2-3-2-3-2 1-6 3-6 3 6 3 6zm12 0s-1 2-3 2-3-2-3-2 1-6 3-6 3 6 3 6z" />
                </svg>
            </div>
            <div class="empty-text">
                <h3>No businesses yet</h3>
                <p>Create your first business to get started and manage your services</p>
            </div>
            <a href="{{ route('vendor.business.create') }}" class="btn-add-business">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Business
            </a>
        </div>
    @else
        <div class="businesses-grid">
            @foreach($businesses as $business)
                <div class="business-card">
                    
                    <!-- Cover Image & Profile -->
                    <div class="cover-image">
                        @if($business->cover_image)
                            <img src="{{ Storage::url($business->cover_image) }}" alt="Cover" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                        <div class="cover-overlay"></div>
                        
                        <!-- Profile Image -->
                        <div class="profile-image">
                            @if($business->profile_image)
                                <img src="{{ Storage::url($business->profile_image) }}" alt="{{ $business->company_name }}">
                            @else
                                {{ substr($business->company_name, 0, 1) }}
                            @endif
                        </div>
                        
                        <!-- Rating Badge -->
                        <div class="rating-badge">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="rating-number">{{ number_format($business->reviews_avg_points, 1) }}</span>
                            <span class="rating-count">({{ $business->reviews_count }})</span>
                        </div>
                    </div>

                    <!-- Business Info -->
                    <div class="business-info">
                        <div class="business-header">
                            <div class="business-title">
                                <h2 class="company-name">{{ $business->company_name }}</h2>
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; flex-wrap: wrap;">
                                    <span class="category-badge">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.707 3.293a1 1 0 00-1.414 0l-6 6a1 1 0 101.414 1.414L9 6.414V18a1 1 0 002 0V6.414l4.293 4.293a1 1 0 001.414-1.414l-6-6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $business->category?->type ?? 'Uncategorized' }}
                                    </span>
                                    @if($business->subCategory)
                                        <span style="color: #FF6B35; font-weight: 600;">•</span>
                                        <span style="font-size: 0.85rem; color: #666; font-weight: 500;">{{ $business->subCategory->type }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Quick Stats -->
                            <div class="stats-container">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $business->packages_count }}</div>
                                    <div class="stat-label">Packages</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">{{ $business->bookings_count }}</div>
                                    <div class="stat-label">Bookings</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">{{ $business->reviews_count }}</div>
                                    <div class="stat-label">Reviews</div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($business->business_desc)
                            <p class="business-description">{{ Str::limit($business->business_desc, 150) }}</p>
                        @endif

                        <!-- Contact Info -->
                        <div class="contact-info">
                            @if($business->business_email)
                                <div class="contact-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $business->business_email }}
                                </div>
                            @endif
                            @if($business->business_phone)
                                <div class="contact-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    {{ $business->business_phone }}
                                </div>
                            @endif
                            @if($business->city || $business->country)
                                <div class="contact-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $business->city }}, {{ $business->country }}
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="card-actions">
                            <a href="{{ route('vendor.business.edit', $business->id) }}" class="btn-edit">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit
                            </a>
                            <button class="btn-delete" onclick="alert('Delete functionality coming soon')">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 112 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>