<div class="cr-root" x-data x-on:stripe-redirect.window="window.location.href = $event.detail.url">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap');

        .cr-root {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            padding: 2rem 1rem 4rem;
            position: relative;
        }

        /* ── Background ── */
        .cr-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .cr-bg__orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .15;
        }

        .cr-bg__orb--1 {
            width: 600px;
            height: 600px;
            background: #6366f1;
            top: -200px;
            right: -150px;
        }

        .cr-bg__orb--2 {
            width: 500px;
            height: 500px;
            background: #a855f7;
            bottom: -150px;
            left: -100px;
        }

        .cr-bg__orb--3 {
            width: 300px;
            height: 300px;
            background: #38bdf8;
            top: 40%;
            left: 40%;
        }

        .dark .cr-bg__orb {
            opacity: .08;
        }

        /* ── Wrap ── */
        .cr-wrap {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* ── Header ── */
        .cr-header {
            margin-bottom: 2rem;
        }

        .cr-header__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #818cf8;
            margin-bottom: .5rem;
        }

        .cr-header__title {
            font-size: 1.9rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #38bdf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            margin: 0 0 .35rem;
        }

        .cr-header__sub {
            font-size: .875rem;
            color: #94a3b8;
        }

        /* ── Balance card ── */
        .cr-balance {
            background: linear-gradient(135deg, rgba(99, 102, 241, .12), rgba(168, 85, 247, .09), rgba(56, 189, 248, .08));
            border: 1px solid rgba(99, 102, 241, .22);
            border-radius: 20px;
            padding: 1.75rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
        }

        .cr-balance::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .05), transparent);
            border-radius: inherit;
        }

        .cr-balance__left {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .cr-balance__icon {
            width: 56px;
            height: 56px;
            border-radius: 15px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(99, 102, 241, .4);
        }

        .cr-balance__icon svg {
            width: 26px;
            height: 26px;
            color: #fff;
        }

        .cr-balance__label {
            font-size: .75rem;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: .15rem;
        }

        .cr-balance__amount {
            font-size: 2.6rem;
            font-weight: 900;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .cr-balance__sub {
            font-size: .78rem;
            color: #64748b;
            margin-top: .2rem;
        }

        /* ── Tabs ── */
        .cr-tabs {
            display: flex;
            gap: .4rem;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(148, 163, 184, .14);
            border-radius: 14px;
            padding: .3rem;
            width: fit-content;
            backdrop-filter: blur(10px);
        }

        .cr-tab {
            padding: .5rem 1.3rem;
            border-radius: 10px;
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: transparent;
            color: #64748b;
            transition: all .2s;
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .cr-tab.active {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, .35);
        }

        .dark .cr-tab {
            color: #94a3b8;
        }

        .cr-tab__count {
            font-size: .68rem;
            font-weight: 800;
            padding: .1rem .45rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, .2);
            color: inherit;
        }

        .cr-tab:not(.active) .cr-tab__count {
            background: rgba(148, 163, 184, .15);
            color: #64748b;
        }

        /* ══════════════════════════════════════
           TABLE STYLES (NEW)
        ══════════════════════════════════════ */
        .cr-table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        .cr-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .cr-table th {
            text-align: left;
            padding: 1rem 1rem;
            background: rgba(99, 102, 241, 0.05);
            font-weight: 700;
            color: #1e293b;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        }

        .dark .cr-table th {
            color: #f1f5f9;
            background: rgba(99, 102, 241, 0.1);
        }

        .cr-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            vertical-align: middle;
        }

        .cr-table tr:last-child td {
            border-bottom: none;
        }

        .cr-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .cr-badge-success {
            background: rgba(34, 197, 94, 0.12);
            color: #16a34a;
        }

        .cr-badge-pending {
            background: rgba(251, 191, 36, 0.12);
            color: #d97706;
        }

        .cr-badge-failed {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
        }

        .cr-filter-select {
            padding: 0.5rem 1rem;
            border-radius: 12px;
            border: 1px solid rgba(148, 163, 184, 0.3);
            background: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ── Available plans grid (unchanged) ── */
        .cr-plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.4rem;
        }

        .cr-plan-card {
            background: rgba(255, 255, 255, .72);
            border: 1px solid rgba(148, 163, 184, .18);
            border-radius: 20px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s, border-color .25s;
            backdrop-filter: blur(16px);
        }

        .dark .cr-plan-card {
            background: rgba(15, 23, 42, .6);
            border-color: rgba(148, 163, 184, .12);
        }

        .cr-plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(99, 102, 241, .16);
            border-color: rgba(99, 102, 241, .38);
        }

        .cr-plan-card--featured {
            border-color: rgba(99, 102, 241, .45);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, .18), 0 14px 36px rgba(99, 102, 241, .14);
        }

        .cr-plan-card__shimmer {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #a855f7, #38bdf8);
            border-radius: 20px 20px 0 0;
        }

        .cr-plan-card__badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: #fff;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .22rem .6rem;
            border-radius: 20px;
        }

        .cr-plan-card__icon-wrap {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.1rem;
            font-size: 1.5rem;
        }

        .cr-plan-card__name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: .25rem;
        }

        .dark .cr-plan-card__name {
            color: #f1f5f9;
        }

        .cr-plan-card__desc {
            font-size: .8rem;
            color: #64748b;
            margin-bottom: 1.1rem;
            line-height: 1.5;
        }

        .cr-plan-card__credits {
            display: flex;
            align-items: baseline;
            gap: .35rem;
            margin-bottom: .9rem;
        }

        .cr-plan-card__credits-num {
            font-size: 2.1rem;
            font-weight: 900;
        }

        .cr-plan-card__credits-label {
            font-size: .78rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .cr-plan-card__pricing {
            display: flex;
            align-items: center;
            gap: .55rem;
            margin-bottom: 1.4rem;
        }

        .cr-plan-card__price {
            font-size: 1.35rem;
            font-weight: 800;
            color: #1e293b;
        }

        .dark .cr-plan-card__price {
            color: #f1f5f9;
        }

        .cr-plan-card__original {
            font-size: .82rem;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .cr-plan-card__discount {
            font-size: .7rem;
            font-weight: 700;
            background: rgba(34, 197, 94, .14);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, .22);
            padding: .14rem .48rem;
            border-radius: 20px;
        }

        .dark .cr-plan-card__discount {
            background: rgba(34, 197, 94, .09);
            color: #4ade80;
        }

        .cr-btn-buy {
            width: 100%;
            padding: .72rem 1rem;
            border-radius: 12px;
            border: none;
            font-family: inherit;
            font-size: .875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            color: #fff;
            box-shadow: 0 4px 14px rgba(99, 102, 241, .28);
        }

        .cr-btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, .42);
        }

        /* ── Empty states ── */
        .cr-empty {
            text-align: center;
            padding: 3.5rem 2rem;
            color: #94a3b8;
        }

        .cr-empty__icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 1rem;
            opacity: .35;
        }

        .cr-empty__title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: .35rem;
            color: #64748b;
        }

        .dark .cr-empty__title {
            color: #94a3b8;
        }

        .cr-empty__sub {
            font-size: .825rem;
            line-height: 1.5;
        }

        /* ── Modal ── */
        .cr-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .cr-modal {
            background: #fff;
            border-radius: 24px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, .22);
            overflow: hidden;
            animation: cr-slide-up .3s cubic-bezier(.16, 1, .3, 1);
        }

        .dark .cr-modal {
            background: #0f172a;
            border: 1px solid rgba(148, 163, 184, .15);
        }

        @keyframes cr-slide-up {
            from {
                transform: translateY(24px);
                opacity: 0
            }

            to {
                transform: translateY(0);
                opacity: 1
            }
        }

        .cr-modal__header {
            padding: 1.4rem 1.6rem 1.1rem;
            border-bottom: 1px solid rgba(148, 163, 184, .12);
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .cr-modal__header-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cr-modal__header-icon svg {
            width: 18px;
            height: 18px;
            color: #fff;
        }

        .cr-modal__title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            flex: 1;
        }

        .dark .cr-modal__title {
            color: #f1f5f9;
        }

        .cr-modal__close {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            transition: background .15s;
        }

        .cr-modal__close:hover {
            background: rgba(148, 163, 184, .15);
        }

        .cr-modal__body {
            padding: 1.4rem 1.6rem;
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .cr-modal__footer {
            padding: 1.1rem 1.6rem;
            border-top: 1px solid rgba(148, 163, 184, .12);
            display: flex;
            justify-content: flex-end;
            gap: .7rem;
        }

        .cr-modal-summary {
            background: linear-gradient(135deg, rgba(99, 102, 241, .08), rgba(168, 85, 247, .05));
            border: 1px solid rgba(99, 102, 241, .18);
            border-radius: 13px;
            padding: 1.1rem;
            display: flex;
            align-items: center;
            gap: .9rem;
        }

        .cr-modal-summary__credits {
            font-size: 1.9rem;
            font-weight: 900;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cr-modal-summary__name {
            font-size: .88rem;
            font-weight: 700;
            color: #1e293b;
        }

        .dark .cr-modal-summary__name {
            color: #f1f5f9;
        }

        .cr-modal-summary__price {
            font-size: .78rem;
            color: #64748b;
            margin-top: .12rem;
        }

        .cr-field {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }

        .cr-label {
            font-size: .72rem;
            font-weight: 700;
            color: #64748b;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .cr-select {
            width: 100%;
            padding: .7rem .95rem;
            border-radius: 10px;
            border: 1px solid rgba(148, 163, 184, .28);
            background: rgba(255, 255, 255, .85);
            color: #1e293b;
            font-size: .875rem;
            font-family: inherit;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            appearance: none;
        }

        .dark .cr-select {
            background: rgba(30, 41, 59, .8);
            color: #f1f5f9;
            border-color: rgba(148, 163, 184, .2);
        }

        .cr-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .14);
        }

        .cr-btn-cancel {
            padding: .6rem 1.2rem;
            border-radius: 10px;
            border: 1px solid rgba(148, 163, 184, .22);
            background: transparent;
            font-family: inherit;
            font-size: .85rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all .15s;
        }

        .cr-btn-cancel:hover {
            background: rgba(148, 163, 184, .1);
        }

        .cr-btn-confirm {
            padding: .6rem 1.4rem;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: #fff;
            font-family: inherit;
            font-size: .85rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(99, 102, 241, .28);
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .cr-btn-confirm:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, .38);
        }

        .cr-btn-confirm:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .cr-spinner {
            width: 15px;
            height: 15px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    {{-- Background orbs --}}
    <div class="cr-bg" aria-hidden="true">
        <div class="cr-bg__orb cr-bg__orb--1"></div>
        <div class="cr-bg__orb cr-bg__orb--2"></div>
        <div class="cr-bg__orb cr-bg__orb--3"></div>
    </div>

    <div class="cr-wrap">

        {{-- Flash messages --}}
        @if (session('success'))
            <div
                class="mb-4 p-3 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div
                class="mb-4 p-3 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- Page header --}}
        <div class="cr-header">
            <div class="cr-header__eyebrow">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width:11px;height:11px;">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Ad Credits
            </div>
            <h1 class="cr-header__title">Manage Your Credits</h1>
            <p class="cr-header__sub">Purchase ad credits to boost your business visibility across Wedbooki</p>
        </div>

        {{-- Balance card --}}
        <div class="cr-balance">
            <div class="cr-balance__left">
                <div class="cr-balance__icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div class="cr-balance__label">Available Credits</div>
                    <div class="cr-balance__amount">{{ number_format($totalCredits) }}</div>
                    <div class="cr-balance__sub">{{ $transactions->where('status', 'completed')->count() }} purchase(s)
                        completed</div>
                </div>
            </div>
            <div style="display:flex;gap:.75rem;flex-wrap:wrap;align-items:center;">
                <div
                    style="text-align:center;padding:.6rem 1rem;border-radius:12px;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.2);">
                    <div style="font-size:1.2rem;font-weight:900;color:#818cf8;">
                        {{ $transactions->where('status', 'completed')->count() }}</div>
                    <div
                        style="font-size:.68rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;">
                        Purchased</div>
                </div>
                <div
                    style="text-align:center;padding:.6rem 1rem;border-radius:12px;background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.18);">
                    <div style="font-size:1.2rem;font-weight:900;color:#38bdf8;">{{ $availablePlans->count() }}</div>
                    <div
                        style="font-size:.68rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;">
                        Available</div>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="cr-tabs">
            <button class="cr-tab {{ $activeTab === 'purchased' ? 'active' : '' }}"
                wire:click="$set('activeTab','purchased')">
                My Purchases
                <span class="cr-tab__count">{{ $transactions->count() }}</span>
            </button>
            <button class="cr-tab {{ $activeTab === 'buy' ? 'active' : '' }}" wire:click="$set('activeTab','buy')">
                Buy Credits
                <span class="cr-tab__count">{{ $availablePlans->count() }}</span>
            </button>
        </div>

        {{-- ══════════════════════════════════════
             TAB: MY PURCHASES (TABLE VIEW)
        ══════════════════════════════════════ --}}
        @if ($activeTab === 'purchased')
            <div class="mb-4 flex justify-end">
                <select wire:model.live="purchasedTabBusinessFilter" class="cr-filter-select">
                    <option value="">All Businesses</option>
                    @foreach ($businesses as $business)
                        <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($transactions->isEmpty())
                <div class="cr-empty">
                    <svg class="cr-empty__icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 10l1.293-1.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="cr-empty__title">No purchases yet</div>
                    <div class="cr-empty__sub">Switch to <strong>Buy Credits</strong> tab to get started.</div>
                </div>
            @else
                <div class="cr-table-wrapper">
                    <table class="cr-table">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Business</th>
                                <th>Credits</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $tx)
                                <tr>
                                    <td class="font-semibold">{{ $tx->creditPlan?->name ?? 'N/A' }}</td>
                                    <td>{{ $tx->business?->company_name ?? '—' }}</td>
                                    <td class="font-bold text-indigo-600 dark:text-indigo-400">
                                        +{{ number_format($tx->no_of_credits) }}</td>
                                    <td>${{ number_format($tx->amount, 2) }}</td>
                                    <td>{{ $tx->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <span class="cr-badge cr-badge-{{ $tx->status }}">
                                            {{ ucfirst($tx->status) }}
                                        </span>
                                    </td>
                                    <td class="font-mono text-xs text-slate-500">
                                        {{ substr($tx->payment_intent_id ?? ($tx->stripe_session_id ?? ''), 0, 12) }}…
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif

        {{-- ══════════════════════════════════════
             TAB: BUY CREDITS (GRID WITH BUSINESS FILTER)
        ══════════════════════════════════════ --}}
        @if ($activeTab === 'buy')
            <div class="mb-6 flex items-center gap-4 flex-wrap">
                <label class="cr-label">Buy credits for business:</label>
                <select wire:model.live="selectedPurchaseBusinessId" class="cr-filter-select flex-1 max-w-xs">
                    @foreach ($businesses as $business)
                        <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($availablePlans->isEmpty())
                <div class="cr-empty">
                    <svg class="cr-empty__icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="cr-empty__title">No new plans available</div>
                    <div class="cr-empty__sub">You have already purchased all credit plans for this business.</div>
                </div>
            @else
                <div class="cr-plans-grid">
                    @php
                        $planColors = [
                            ['from' => '#6366f1', 'to' => '#818cf8'],
                            ['from' => '#f59e0b', 'to' => '#fbbf24'],
                            ['from' => '#10b981', 'to' => '#34d399'],
                            ['from' => '#8b5cf6', 'to' => '#c084fc'],
                            ['from' => '#ef4444', 'to' => '#f87171'],
                            ['from' => '#0ea5e9', 'to' => '#38bdf8'],
                        ];
                        $planIcons = ['💎', '⚡', '🚀', '👑', '🎯', '🌟'];
                    @endphp

                    @foreach ($availablePlans as $idx => $plan)
                        @php
                            $pc = $planColors[$idx % count($planColors)];
                            $icon = $planIcons[$idx % count($planIcons)];
                            $discountedPrice =
                                $plan->discounted_percentage > 0
                                    ? round(($plan->price * (100 - $plan->discounted_percentage)) / 100, 2)
                                    : null;
                            $displayPrice = $discountedPrice ?? $plan->price;
                            $isFeatured = $idx === 1 || $plan->discounted_percentage >= 20;
                        @endphp
                        <div class="cr-plan-card {{ $isFeatured ? 'cr-plan-card--featured' : '' }}">
                            @if ($isFeatured)
                                <div class="cr-plan-card__shimmer"></div>
                                <div class="cr-plan-card__badge">Most Popular</div>
                            @endif
                            <div class="cr-plan-card__icon-wrap"
                                style="background:linear-gradient(135deg,{{ $pc['from'] }}22,{{ $pc['to'] }}33);">
                                {{ $icon }}
                            </div>
                            <div class="cr-plan-card__name">{{ $plan->name }}</div>
                            <div class="cr-plan-card__desc">
                                {{ $plan->description ?? 'Boost your listings and reach more couples.' }}</div>
                            <div class="cr-plan-card__credits">
                                <span class="cr-plan-card__credits-num"
                                    style="background:linear-gradient(135deg,{{ $pc['from'] }},{{ $pc['to'] }});-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                                    {{ number_format($plan->no_of_credits) }}
                                </span>
                                <span class="cr-plan-card__credits-label">credits</span>
                            </div>
                            <div class="cr-plan-card__pricing">
                                <span class="cr-plan-card__price">${{ number_format($displayPrice, 2) }}</span>
                                @if ($discountedPrice)
                                    <span class="cr-plan-card__original">${{ number_format($plan->price, 2) }}</span>
                                    <span class="cr-plan-card__discount">{{ $plan->discounted_percentage }}% OFF</span>
                                @endif
                            </div>
                            <button class="cr-btn-buy" wire:click="selectPlan({{ $plan->id }})"
                                style="background:linear-gradient(135deg,{{ $pc['from'] }},{{ $pc['to'] }});">
                                Get {{ number_format($plan->no_of_credits) }} Credits →
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

    </div>{{-- /cr-wrap --}}

    {{-- ══ Purchase Confirmation Modal ══ --}}
    @if ($showModal && $selectedPlan)
        @php
            $finalPrice =
                $selectedPlan->discounted_percentage > 0
                    ? round(($selectedPlan->price * (100 - $selectedPlan->discounted_percentage)) / 100, 2)
                    : $selectedPlan->price;
        @endphp
        <div class="cr-modal-overlay" wire:click.self="closeModal">
            <div class="cr-modal">
                <div class="cr-modal__header">
                    <div class="cr-modal__header-icon">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </div>
                    <span class="cr-modal__title">Confirm Purchase</span>
                    <button class="cr-modal__close" wire:click="closeModal">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="cr-modal__body">
                    <div class="cr-modal-summary">
                        <div class="cr-modal-summary__credits">{{ number_format($selectedPlan->no_of_credits) }}</div>
                        <div>
                            <div class="cr-modal-summary__name">{{ $selectedPlan->name }}</div>
                            <div class="cr-modal-summary__price">
                                ${{ number_format($finalPrice, 2) }} USD
                                @if ($selectedPlan->discounted_percentage > 0)
                                    <span
                                        style="text-decoration:line-through;color:#94a3b8;margin-left:.3rem;">${{ number_format($selectedPlan->price, 2) }}</span>
                                    <span
                                        style="color:#16a34a;font-weight:700;margin-left:.2rem;">({{ $selectedPlan->discounted_percentage }}%
                                        off)</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="cr-field">
                        <label class="cr-label">Apply credits to business</label>
                        <select class="cr-select" wire:model="selectedPurchaseBusinessId">
                            @foreach ($businesses as $biz)
                                <option value="{{ $biz->id }}">{{ $biz->company_name }}</option>
                            @endforeach
                        </select>
                        @error('selectedPurchaseBusinessId')
                            <span style="font-size:.74rem;color:#dc2626;font-weight:600;">{{ $message }}</span>
                        @enderror
                    </div>

                    <p
                        style="font-size:.78rem;color:#64748b;line-height:1.55;padding:.7rem .9rem;background:rgba(148,163,184,.07);border-radius:10px;border:1px solid rgba(148,163,184,.14);">
                        🔒 You'll be redirected to Stripe's secure checkout. Credits are added to your business
                        instantly after payment confirmation.
                    </p>
                </div>

                <div class="cr-modal__footer">
                    <button class="cr-btn-cancel" wire:click="closeModal">Cancel</button>
                    <button class="cr-btn-confirm" wire:click="purchase" @disabled($processing)>
                        @if ($processing)
                            <svg class="cr-spinner" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                                    style="opacity:.25;" />
                                <path d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                                    stroke-linecap="round" />
                            </svg>
                            Redirecting…
                        @else
                            Pay ${{ number_format($finalPrice, 2) }} →
                        @endif
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
