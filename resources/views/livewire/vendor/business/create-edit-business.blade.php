<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap');

    :root {
        --primary-orange: #FF6B35;
        --primary-yellow: #FFD166;
        --primary-rose: #F24060;
        --accent-gold: #FFA500;
        --accent-coral: #FF7A5C;
        --dark-bg: #0F172A;
        --light-bg: #FFFFFF;
        --success-green: #10B981;
    }

    * {
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.02) 0%, rgba(242, 64, 96, 0.02) 100%);
        min-height: 100vh;
        padding: 2rem;
    }

    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    .form-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #FF6B35 0%, #F24060 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .breadcrumb-section {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
    }

    .breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
    }

    .breadcrumb-item.active {
        color: #FF6B35;
        font-weight: 600;
    }

    .breadcrumb-divider {
        color: #DDD;
    }

    .form-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    .form-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 252, 245, 0.98) 100%);
        border-radius: 20px;
        border: 1px solid rgba(255, 107, 53, 0.1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        padding: 3rem 2.5rem;
        margin-bottom: 2rem;
    }

    .step-indicator {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .step-indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #FFE5CC 0%, #FFD4E5 100%);
        transform: translateY(-50%);
        z-index: 1;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #FFE5CC 0%, #FFD4E5 100%);
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
        transition: all 0.3s ease;
    }

    .step-item.active .step-circle {
        background: linear-gradient(135deg, #FF6B35 0%, #F24060 100%);
        transform: scale(1.1);
        color: white;
    }

    .step-item.completed .step-circle {
        background: linear-gradient(135deg, #10B981 0%, #34D399 100%);
        color: white;
    }

    .step-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #666;
        text-align: center;
    }

    .step-item.active .step-label,
    .step-item.completed .step-label {
        color: #FF6B35;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
        animation: slideIn 0.4s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .form-label svg {
        width: 18px;
        height: 18px;
        color: #FF6B35;
    }

    .required {
        color: #F24060;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid rgba(255, 107, 53, 0.15);
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #FF6B35;
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    }

    .form-control::placeholder {
        color: #999;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .error-message {
        color: #F24060;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .error-message svg {
        width: 14px;
        height: 14px;
    }

    .file-upload-area {
        border: 2px dashed rgba(255, 107, 53, 0.3);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.03) 0%, rgba(255, 166, 0, 0.03) 100%);
    }

    .file-upload-area:hover {
        border-color: #FF6B35;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.08) 0%, rgba(255, 166, 0, 0.08) 100%);
    }

    .file-upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        color: #FF6B35;
    }

    .file-upload-text {
        color: #0F172A;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .file-upload-hint {
        color: #999;
        font-size: 0.85rem;
    }

    .image-preview {
        position: relative;
        margin-top: 1rem;
        border-radius: 12px;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: auto;
        display: block;
        max-height: 300px;
        object-fit: cover;
    }

    .image-remove-btn {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: rgba(242, 64, 96, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 700;
    }

    .image-remove-btn:hover {
        background: rgba(242, 64, 96, 1);
        transform: scale(1.1);
    }

    .two-column {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .feature-input-group {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .feature-input-group input {
        flex: 1;
    }

    .btn-add-feature,
    .btn-add-service {
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #FFD166 0%, #FFA500 100%);
        color: #0F172A;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .btn-add-feature:hover,
    .btn-add-service:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 166, 0, 0.3);
    }

    .features-list,
    .services-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .feature-tag,
    .service-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 166, 0, 0.1) 100%);
        border: 1.5px solid rgba(255, 107, 53, 0.2);
        border-radius: 10px;
        font-size: 0.85rem;
        color: #FF6B35;
        font-weight: 500;
    }

    .feature-tag button,
    .service-tag button {
        background: none;
        border: none;
        color: #F24060;
        cursor: pointer;
        font-weight: 700;
        padding: 0;
        margin-left: 0.5rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .feature-tag button:hover,
    .service-tag button:hover {
        transform: scale(1.3);
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 107, 53, 0.1);
    }

    .btn-previous,
    .btn-next,
    .btn-submit {
        padding: 0.875rem 2rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-previous {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(255, 166, 0, 0.1) 100%);
        color: #FF6B35;
        border: 1.5px solid rgba(255, 107, 53, 0.2);
    }

    .btn-previous:hover {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.15) 0%, rgba(255, 166, 0, 0.15) 100%);
        border-color: rgba(255, 107, 53, 0.3);
    }

    .btn-next,
    .btn-submit {
        background: linear-gradient(135deg, #FF6B35 0%, #FF7A5C 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        margin-left: auto;
    }

    .btn-next:hover,
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }

    .btn-next:disabled,
    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .success-message {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(52, 211, 153, 0.1) 100%);
        border: 1.5px solid rgba(16, 185, 129, 0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-icon {
        width: 24px;
        height: 24px;
        color: #10B981;
        flex-shrink: 0;
    }

    .success-text {
        color: #10B981;
        font-weight: 600;
    }

    .alert-error {
        background: linear-gradient(135deg, rgba(242, 64, 96, 0.1) 0%, rgba(255, 127, 92, 0.1) 100%);
        border: 1.5px solid rgba(242, 64, 96, 0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .alert-error-title {
        color: #F24060;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .alert-error-message {
        color: #D84B5F;
        font-size: 0.9rem;
    }

    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .help-text {
        font-size: 0.8rem;
        color: #999;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .form-title {
            font-size: 1.5rem;
        }

        .two-column {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-previous,
        .btn-next,
        .btn-submit {
            width: 100%;
            justify-content: center;
            margin-left: 0;
        }

        .step-indicator {
            margin-bottom: 2rem;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            font-size: 0.8rem;
        }

        .step-label {
            font-size: 0.75rem;
        }
    }
</style>

<div class="form-container">
    <div class="form-wrapper">
        
        @if ($showSuccess)
            <div class="success-message" wire:poll.remove="showSuccess">
                <svg class="success-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>
                    <div class="success-text">
                        {{ $isEditing ? 'Business updated successfully!' : 'Business created successfully!' }}
                    </div>
                    <div style="color: #059669; font-size: 0.85rem; margin-top: 0.25rem;">
                        Redirecting you to your businesses...
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->has('general'))
            <div class="alert-error">
                <div class="alert-error-title">
                    <svg style="width: 16px; height: 16px; display: inline; margin-right: 0.5rem;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    Error
                </div>
                <div class="alert-error-message">{{ $errors->first('general') }}</div>
            </div>
        @endif

        <div class="form-header">
            <h1 class="form-title">
                {{ $isEditing ? '✏️ Edit Business' : '🏢 Create New Business' }}
            </h1>
            <div class="breadcrumb-section">
                <span class="breadcrumb-item active">Step {{ $currentStep === 'basic' ? '1' : '2' }} of 2</span>
            </div>
        </div>

        <!-- Step Indicator -->
        <div class="form-card">
            <div class="step-indicator">
                <div class="step-item {{ $currentStep === 'basic' ? 'active' : 'completed' }}">
                    <div class="step-circle">
                        {{ $currentStep !== 'basic' ? '✓' : '1' }}
                    </div>
                    <div class="step-label">Basic Info</div>
                </div>
                <div class="step-item {{ $currentStep === 'contact' ? 'active' : '' }}">
                    <div class="step-circle">2</div>
                    <div class="step-label">Details & Contact</div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <form wire:submit="save">
            <div class="form-card">
                
                <!-- Step 1: Basic Information -->
                <div class="form-section {{ $currentStep === 'basic' ? 'active' : '' }}">
                    <h2 style="font-size: 1.3rem; margin-bottom: 1.5rem; color: #0F172A;">
                        <span style="color: #FF6B35;">1.</span> Let's Start With Basics
                    </h2>

                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6-4a2 2 0 00-2 2v4a2 2 0 002 2h2a2 2 0 002-2V8a2 2 0 00-2-2h-2z" />
                            </svg>
                            Business Name
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            wire:model="company_name"
                            placeholder="Enter your business name"
                        >
                        @error('company_name')
                            <div class="error-message">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414L8.586 18l-6.687 6.687a1 1 0 101.414 1.414L10 19.414l6.687 6.687a1 1 0 001.414-1.414L11.414 18l6.687-6.687z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" clip-rule="evenodd" />
                            </svg>
                            Business Description
                            <span class="required">*</span>
                        </label>
                        <textarea 
                            class="form-control" 
                            wire:model="business_desc"
                            placeholder="Describe your business, services, and what makes you special..."
                        ></textarea>
                        @error('business_desc')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <div class="help-text">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            Minimum 20 characters, maximum 1000 characters
                        </div>
                    </div>

                    <div class="two-column">
                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                </svg>
                                Category
                                <span class="required">*</span>
                            </label>
                            <select class="form-select" wire:model="category_id">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['type'] }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                </svg>
                                Subcategory
                            </label>
                            <select class="form-select" wire:model="subcategory_id">
                                <option value="">Select a subcategory</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory['id'] }}">{{ $subcategory['type'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Profile Image Upload -->
                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                            </svg>
                            Profile Image
                        </label>
                        <label class="file-upload-area" wire:click="$dispatch('selectProfile')">
                            <svg class="file-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <div class="file-upload-text">Click to upload profile image</div>
                            <div class="file-upload-hint">PNG, JPG up to 5MB</div>
                            <input 
                                type="file" 
                                wire:model="profile_image"
                                accept="image/*"
                                style="display: none;"
                                @change="$dispatch('profileImageSelected')"
                            >
                        </label>

                        @if ($profile_image)
                            <div class="image-preview">
                                <img src="{{ $profile_image->temporaryUrl() }}" alt="Profile preview">
                                <button type="button" class="image-remove-btn" wire:click="$set('profile_image', null)">✕</button>
                            </div>
                        @elseif ($existing_profile_image)
                            <div class="image-preview">
                                <img src="{{ Storage::url($existing_profile_image) }}" alt="Current profile">
                                <button type="button" class="image-remove-btn" wire:click="$set('existing_profile_image', null)">✕</button>
                            </div>
                        @endif
                    </div>

                    <!-- Cover Image Upload -->
                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                            </svg>
                            Cover Image
                        </label>
                        <label class="file-upload-area">
                            <svg class="file-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <div class="file-upload-text">Click to upload cover image</div>
                            <div class="file-upload-hint">PNG, JPG up to 5MB (Recommended: 1200x600px)</div>
                            <input 
                                type="file" 
                                wire:model="cover_image"
                                accept="image/*"
                                style="display: none;"
                            >
                        </label>

                        @if ($cover_image)
                            <div class="image-preview">
                                <img src="{{ $cover_image->temporaryUrl() }}" alt="Cover preview">
                                <button type="button" class="image-remove-btn" wire:click="$set('cover_image', null)">✕</button>
                            </div>
                        @elseif ($existing_cover_image)
                            <div class="image-preview">
                                <img src="{{ Storage::url($existing_cover_image) }}" alt="Current cover">
                                <button type="button" class="image-remove-btn" wire:click="$set('existing_cover_image', null)">✕</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Step 2: Contact & Details -->
                <div class="form-section {{ $currentStep === 'contact' ? 'active' : '' }}">
                    <h2 style="font-size: 1.3rem; margin-bottom: 1.5rem; color: #0F172A;">
                        <span style="color: #FF6B35;">2.</span> Contact Information & Details
                    </h2>

                    <div class="two-column">
                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Business Email
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                class="form-control" 
                                wire:model="business_email"
                                placeholder="business@example.com"
                            >
                            @error('business_email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.83l.722 4.332h1.653a1 1 0 010 2h-.651l.5 2.993h1.151a1 1 0 010 2H4.96l.722 4.332A1 1 0 014.153 19H2a1 1 0 01-1-1v-2.153a1 1 0 01.83-.986l4.332-.722V9.152H5a1 1 0 010-2h.651L5.15 4.157A1 1 0 015.847 3H2z" />
                                </svg>
                                Business Phone
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="tel" 
                                class="form-control" 
                                wire:model="business_phone"
                                placeholder="+1 (555) 000-0000"
                            >
                            @error('business_phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Website (Optional)
                        </label>
                        <input 
                            type="url" 
                            class="form-control" 
                            wire:model="website"
                            placeholder="https://www.example.com"
                        >
                        @error('website')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H9a2 2 0 012 2v4a1 1 0 11-2 0V9H5.414l1.05 1.05a1 1 0 11-1.414 1.414L2.343 9.343a1.5 1.5 0 010-2.121L4.05 4.05z" clip-rule="evenodd" />
                            </svg>
                            Street Address
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            wire:model="street_address"
                            placeholder="123 Business Street"
                        >
                        @error('street_address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="two-column">
                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H9a2 2 0 012 2v4a1 1 0 11-2 0V9H5.414l1.05 1.05a1 1 0 11-1.414 1.414L2.343 9.343a1.5 1.5 0 010-2.121L4.05 4.05z" clip-rule="evenodd" />
                                </svg>
                                City
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="city"
                                placeholder="New York"
                            >
                            @error('city')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H9a2 2 0 012 2v4a1 1 0 11-2 0V9H5.414l1.05 1.05a1 1 0 11-1.414 1.414L2.343 9.343a1.5 1.5 0 010-2.121L4.05 4.05z" clip-rule="evenodd" />
                                </svg>
                                Country
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="country"
                                placeholder="United States"
                            >
                            @error('country')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="two-column">
                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 3a2 2 0 00-2 2v6h16V5a2 2 0 00-2-2H5z" />
                                    <path fill-rule="evenodd" d="M3 11v6a2 2 0 002 2h10v-6H3zm10 8h4a2 2 0 002-2v-6h-6v6z" clip-rule="evenodd" />
                                </svg>
                                Postal Code (Optional)
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="postal_code"
                                placeholder="10001"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 12a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                                Guest Capacity (Optional)
                            </label>
                            <input 
                                type="number" 
                                class="form-control" 
                                wire:model="capacity"
                                placeholder="50"
                                min="1"
                            >
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Key Features (Optional)
                        </label>
                        <div class="feature-input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="newFeature"
                                placeholder="e.g., Free Parking, WiFi, etc."
                                @keyup.enter="addFeature"
                            >
                            <button type="button" class="btn-add-feature" wire:click="addFeature">
                                <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add
                            </button>
                        </div>
                        @if (count($features) > 0)
                            <div class="features-list">
                                @foreach ($features as $index => $feature)
                                    <span class="feature-tag">
                                        {{ $feature }}
                                        <button type="button" wire:click="removeFeature({{ $index }})">✕</button>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Services -->
                    <div class="form-group">
                        <label class="form-label">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                            </svg>
                            Services Offered (Optional)
                        </label>
                        <div class="feature-input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                wire:model="newService"
                                placeholder="e.g., Photography, Videography, etc."
                                @keyup.enter="addService"
                            >
                            <button type="button" class="btn-add-service" wire:click="addService">
                                <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add
                            </button>
                        </div>
                        @if (count($services) > 0)
                            <div class="services-list">
                                @foreach ($services as $index => $service)
                                    <span class="service-tag">
                                        {{ $service }}
                                        <button type="button" wire:click="removeService({{ $index }})">✕</button>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    @if ($currentStep === 'contact')
                        <button type="button" class="btn-previous" wire:click="previousStep">
                            <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Previous
                        </button>
                    @endif

                    @if ($currentStep === 'basic')
                        <button type="button" class="btn-next" wire:click="nextStep">
                            Next Step
                            <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <button type="submit" class="btn-submit" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <svg style="width: 18px; height: 18px;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span wire:loading>
                                <span class="loading-spinner"></span>
                            </span>
                            {{ $isEditing ? 'Update Business' : 'Create Business' }}
                        </button>
                    @endif
                </div>
            </div>
        </form>

    </div>
</div>