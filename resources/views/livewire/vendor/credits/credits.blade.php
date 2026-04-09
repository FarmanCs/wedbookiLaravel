<div class="cr-root" x-data x-on:stripe-redirect.window="window.location.href = $event.detail.url">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        .cr-root {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            padding: 2rem 1rem 4rem;
            position: relative;
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 50%, #fef3ff 100%);
        }

        .dark .cr-root {
            background: linear-gradient(135deg, #0a0e1a 0%, #0f1419 50%, #13111a 100%);
        }

        /* ── Background Effects ── */
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
            filter: blur(100px);
            opacity: .2;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-30px, 30px) scale(0.9);
            }
        }

        .cr-bg__orb--1 {
            width: 700px;
            height: 700px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            top: -300px;
            right: -200px;
            animation-delay: 0s;
        }

        .cr-bg__orb--2 {
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            bottom: -200px;
            left: -150px;
            animation-delay: -7s;
        }

        .cr-bg__orb--3 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -14s;
        }

        .dark .cr-bg__orb {
            opacity: .12;
        }

        /* ── Grid Pattern Overlay ── */
        .cr-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .dark .cr-bg::after {
            background-image:
                linear-gradient(rgba(139, 92, 246, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(139, 92, 246, 0.05) 1px, transparent 1px);
        }

        /* ── Wrap ── */
        .cr-wrap {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* ── Header ── */
        .cr-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .cr-header__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .75rem;
        }

        .dark .cr-header__eyebrow {
            background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-header__title {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            margin: 0 0 .75rem;
            letter-spacing: -0.02em;
        }

        .dark .cr-header__title {
            background: linear-gradient(135deg, #a78bfa 0%, #c084fc 50%, #e879f9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-header__sub {
            font-size: 1.05rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .dark .cr-header__sub {
            color: #94a3b8;
        }

        /* ── Balance Card ── */
        .cr-balance {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 20px 60px rgba(102, 126, 234, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.5) inset;
        }

        .dark .cr-balance {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(71, 85, 105, 0.2) inset;
        }

        .cr-balance::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(167, 139, 250, 0.05));
            border-radius: inherit;
        }

        .dark .cr-balance::before {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(192, 132, 252, 0.08));
        }

        .cr-balance__left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
        }

        .cr-balance__icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow:
                0 10px 40px rgba(102, 126, 234, 0.4),
                0 0 0 4px rgba(102, 126, 234, 0.1);
            position: relative;
        }

        .dark .cr-balance__icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            box-shadow:
                0 10px 40px rgba(139, 92, 246, 0.4),
                0 0 0 4px rgba(139, 92, 246, 0.1);
        }

        .cr-balance__icon::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: inherit;
            z-index: -1;
            opacity: 0.5;
            filter: blur(8px);
        }

        .dark .cr-balance__icon::after {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
        }

        .cr-balance__icon svg {
            width: 36px;
            height: 36px;
            color: #fff;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .cr-balance__label {
            font-size: .8rem;
            font-weight: 700;
            color: #64748b;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: .4rem;
        }

        .dark .cr-balance__label {
            color: #94a3b8;
        }

        .cr-balance__amount {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .dark .cr-balance__amount {
            background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-balance__sub {
            font-size: .9rem;
            color: #64748b;
            margin-top: .5rem;
        }

        .dark .cr-balance__sub {
            color: #94a3b8;
        }

        .cr-balance__stats {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .cr-stat {
            text-align: center;
            padding: 1rem 1.5rem;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-stat {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .cr-stat__value {
            font-size: 1.75rem;
            font-weight: 900;
            margin-bottom: .25rem;
        }

        .cr-stat__value--primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dark .cr-stat__value--primary {
            background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-stat__value--secondary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dark .cr-stat__value--secondary {
            background: linear-gradient(135deg, #60a5fa 0%, #38bdf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-stat__label {
            font-size: .7rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .dark .cr-stat__label {
            color: #94a3b8;
        }

        /* ── Tabs ── */
        .cr-tabs {
            display: flex;
            gap: .5rem;
            margin-bottom: 2.5rem;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            padding: .5rem;
            width: fit-content;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-tabs {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .cr-tab {
            padding: .75rem 1.5rem;
            border-radius: 12px;
            font-size: .9rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            background: transparent;
            color: #64748b;
            transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: .6rem;
            position: relative;
        }

        .dark .cr-tab {
            color: #94a3b8;
        }

        .cr-tab:hover:not(.active) {
            background: rgba(102, 126, 234, 0.08);
            color: #667eea;
        }

        .dark .cr-tab:hover:not(.active) {
            background: rgba(139, 92, 246, 0.1);
            color: #a78bfa;
        }

        .cr-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            box-shadow:
                0 8px 24px rgba(102, 126, 234, 0.4),
                0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .dark .cr-tab.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            box-shadow:
                0 8px 24px rgba(139, 92, 246, 0.4),
                0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .cr-tab__count {
            font-size: .75rem;
            font-weight: 800;
            padding: .2rem .5rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.25);
            color: inherit;
        }

        .cr-tab:not(.active) .cr-tab__count {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .dark .cr-tab:not(.active) .cr-tab__count {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
        }

        /* ── Table Styles ── */
        .cr-table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-table-wrapper {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .cr-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
        }

        .cr-table th {
            text-align: left;
            padding: 1.25rem 1.5rem;
            background: rgba(102, 126, 234, 0.05);
            backdrop-filter: blur(10px);
            font-weight: 700;
            color: #1e293b;
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .dark .cr-table th {
            color: #f1f5f9;
            background: rgba(139, 92, 246, 0.08);
            border-bottom: 1px solid rgba(139, 92, 246, 0.15);
        }

        .cr-table td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            vertical-align: middle;
            color: #334155;
        }

        .dark .cr-table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #cbd5e1;
        }

        .cr-table tr:last-child td {
            border-bottom: none;
        }

        .cr-table tr:hover td {
            background: rgba(102, 126, 234, 0.02);
        }

        .dark .cr-table tr:hover td {
            background: rgba(139, 92, 246, 0.05);
        }

        .cr-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .cr-badge-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .dark .cr-badge-completed {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .cr-badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .dark .cr-badge-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .cr-badge-failed {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .dark .cr-badge-failed {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .cr-filter-select {
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            font-family: inherit;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-filter-select {
            background: rgba(30, 41, 59, 0.8);
            color: #f1f5f9;
            border-color: rgba(71, 85, 105, 0.3);
        }

        .cr-filter-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .dark .cr-filter-select:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.15);
        }

        /* ── Plans Grid ── */
        .cr-plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .cr-plan-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 24px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all .4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-plan-card {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(71, 85, 105, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .cr-plan-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.15);
            border-color: rgba(102, 126, 234, 0.4);
        }

        .dark .cr-plan-card:hover {
            box-shadow: 0 20px 60px rgba(139, 92, 246, 0.3);
            border-color: rgba(139, 92, 246, 0.5);
        }

        .cr-plan-card--featured {
            border-color: rgba(102, 126, 234, 0.5);
            box-shadow:
                0 0 0 3px rgba(102, 126, 234, 0.1),
                0 20px 60px rgba(102, 126, 234, 0.15);
            transform: scale(1.02);
        }

        .dark .cr-plan-card--featured {
            border-color: rgba(139, 92, 246, 0.6);
            box-shadow:
                0 0 0 3px rgba(139, 92, 246, 0.15),
                0 20px 60px rgba(139, 92, 246, 0.3);
        }

        .cr-plan-card--featured:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .cr-plan-card__shimmer {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #667eea);
            background-size: 200% 100%;
            border-radius: 24px 24px 0 0;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 200% 0%;
            }
        }

        .cr-plan-card__badge {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-size: .65rem;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: .35rem .8rem;
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
        }

        .dark .cr-plan-card__badge {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            box-shadow: 0 4px 16px rgba(139, 92, 246, 0.5);
        }

        .cr-plan-card__icon-wrap {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .cr-plan-card__icon-wrap::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: inherit;
            background: inherit;
            z-index: -1;
            opacity: 0.3;
            filter: blur(12px);
        }

        .cr-plan-card__name {
            font-size: 1.35rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: .5rem;
            letter-spacing: -0.01em;
        }

        .dark .cr-plan-card__name {
            color: #f1f5f9;
        }

        .cr-plan-card__desc {
            font-size: .875rem;
            color: #64748b;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .dark .cr-plan-card__desc {
            color: #94a3b8;
        }

        .cr-plan-card__credits {
            display: flex;
            align-items: baseline;
            gap: .5rem;
            margin-bottom: 1rem;
        }

        .cr-plan-card__credits-num {
            font-size: 2.75rem;
            font-weight: 900;
            letter-spacing: -0.02em;
        }

        .cr-plan-card__credits-label {
            font-size: .875rem;
            font-weight: 600;
            color: #64748b;
        }

        .dark .cr-plan-card__credits-label {
            color: #94a3b8;
        }

        .cr-plan-card__pricing {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }

        .cr-plan-card__price {
            font-size: 1.75rem;
            font-weight: 900;
            color: #1e293b;
            letter-spacing: -0.01em;
        }

        .dark .cr-plan-card__price {
            color: #f1f5f9;
        }

        .cr-plan-card__original {
            font-size: .95rem;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .cr-plan-card__discount {
            font-size: .75rem;
            font-weight: 800;
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: .25rem .65rem;
            border-radius: 20px;
        }

        .dark .cr-plan-card__discount {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .cr-btn-buy {
            width: 100%;
            padding: 1rem 1.5rem;
            border-radius: 14px;
            border: none;
            font-family: inherit;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .cr-btn-buy::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .cr-btn-buy:hover::before {
            opacity: 1;
        }

        .cr-btn-buy:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
        }

        /* ── Empty States ── */
        .cr-empty {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px dashed rgba(102, 126, 234, 0.2);
        }

        .dark .cr-empty {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(139, 92, 246, 0.2);
        }

        .cr-empty__icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1.5rem;
            opacity: .3;
            color: #667eea;
        }

        .dark .cr-empty__icon {
            color: #a78bfa;
        }

        .cr-empty__title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: .5rem;
            color: #475569;
        }

        .dark .cr-empty__title {
            color: #cbd5e1;
        }

        .cr-empty__sub {
            font-size: .95rem;
            line-height: 1.6;
            color: #64748b;
        }

        .dark .cr-empty__sub {
            color: #94a3b8;
        }

        /* ── Modal ── */
        .cr-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, .6);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            animation: fadeIn .3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .cr-modal {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp .4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .dark .cr-modal {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(71, 85, 105, 0.3);
        }

        @keyframes slideUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .cr-modal__header {
            padding: 1.75rem 2rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.03), rgba(118, 75, 162, 0.02));
        }

        .dark .cr-modal__header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(168, 85, 247, 0.03));
        }

        .cr-modal__header-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
        }

        .dark .cr-modal__header-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.5);
        }

        .cr-modal__header-icon svg {
            width: 22px;
            height: 22px;
            color: #fff;
        }

        .cr-modal__title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #1e293b;
            flex: 1;
            letter-spacing: -0.01em;
        }

        .dark .cr-modal__title {
            color: #f1f5f9;
        }

        .cr-modal__close {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            background: rgba(0, 0, 0, 0.04);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all .2s;
        }

        .dark .cr-modal__close {
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
        }

        .cr-modal__close:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .dark .cr-modal__close:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        .cr-modal__body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .cr-modal__footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.01));
        }

        .dark .cr-modal__footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: linear-gradient(180deg, transparent, rgba(255, 255, 255, 0.02));
        }

        .cr-modal-summary {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .dark .cr-modal-summary {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(168, 85, 247, 0.08));
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .cr-modal-summary__credits {
            font-size: 2.25rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }

        .dark .cr-modal-summary__credits {
            background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cr-modal-summary__name {
            font-size: 1rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: .25rem;
        }

        .dark .cr-modal-summary__name {
            color: #f1f5f9;
        }

        .cr-modal-summary__price {
            font-size: .875rem;
            color: #64748b;
        }

        .dark .cr-modal-summary__price {
            color: #94a3b8;
        }

        .cr-field {
            display: flex;
            flex-direction: column;
            gap: .6rem;
        }

        .cr-label {
            font-size: .75rem;
            font-weight: 800;
            color: #475569;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .dark .cr-label {
            color: #cbd5e1;
        }

        .cr-select {
            width: 100%;
            padding: .95rem 1.25rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #1e293b;
            font-size: .95rem;
            font-family: inherit;
            font-weight: 600;
            outline: none;
            transition: all .2s;
            appearance: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .dark .cr-select {
            background: rgba(30, 41, 59, 0.9);
            color: #f1f5f9;
            border-color: rgba(71, 85, 105, 0.3);
        }

        .cr-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .dark .cr-select:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 4px rgba(167, 139, 250, 0.15);
        }

        .cr-btn-cancel {
            padding: .85rem 1.5rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            font-family: inherit;
            font-size: .9rem;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all .2s;
        }

        .dark .cr-btn-cancel {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(71, 85, 105, 0.3);
            color: #cbd5e1;
        }

        .cr-btn-cancel:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.2);
        }

        .dark .cr-btn-cancel:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(71, 85, 105, 0.5);
        }

        .cr-btn-confirm {
            padding: .85rem 1.75rem;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-family: inherit;
            font-size: .9rem;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
            transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: .6rem;
            position: relative;
            overflow: hidden;
        }

        .dark .cr-btn-confirm {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.5);
        }

        .cr-btn-confirm::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .cr-btn-confirm:hover::before {
            opacity: 1;
        }

        .cr-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.5);
        }

        .dark .cr-btn-confirm:hover {
            box-shadow: 0 12px 32px rgba(139, 92, 246, 0.6);
        }

        .cr-btn-confirm:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .cr-spinner {
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Flash Messages ── */
        .cr-flash {
            margin-bottom: 1.5rem;
            padding: 1rem 1.5rem;
            border-radius: 16px;
            font-size: .9rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid;
            animation: slideDown .4s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .cr-flash--success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .dark .cr-flash--success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.4);
        }

        .cr-flash--error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .dark .cr-flash--error {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .cr-header__title {
                font-size: 2rem;
            }

            .cr-balance {
                padding: 1.75rem;
            }

            .cr-balance__amount {
                font-size: 2.5rem;
            }

            .cr-balance__icon {
                width: 64px;
                height: 64px;
            }

            .cr-balance__icon svg {
                width: 28px;
                height: 28px;
            }

            .cr-plans-grid {
                grid-template-columns: 1fr;
            }

            .cr-table-wrapper {
                font-size: .8rem;
            }

            .cr-table th,
            .cr-table td {
                padding: 1rem;
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
            <div class="cr-flash cr-flash--success">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="cr-flash cr-flash--error">
                ✕ {{ session('error') }}
            </div>
        @endif

        {{-- Page header --}}
        <div class="cr-header">
            <div class="cr-header__eyebrow">
                <svg viewBox="0 0 20 20" fill="currentColor" style="width:12px;height:12px;">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Premium Credits
            </div>
            <h1 class="cr-header__title">Manage Your Credits</h1>
            <p class="cr-header__sub">Purchase ad credits to boost your business visibility and reach more couples
                across Wedbooki</p>
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
            <div class="cr-balance__stats">
                <div class="cr-stat">
                    <div class="cr-stat__value cr-stat__value--primary">
                        {{ $transactions->where('status', 'completed')->count() }}</div>
                    <div class="cr-stat__label">Purchased</div>
                </div>
                <div class="cr-stat">
                    <div class="cr-stat__value cr-stat__value--secondary">{{ $availablePlans->count() }}</div>
                    <div class="cr-stat__label">Available</div>
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

        {{-- TAB: MY PURCHASES --}}
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
                    <div class="cr-empty__sub">Switch to <strong>Buy Credits</strong> tab to get started and boost your
                        business.</div>
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
                                    <td style="font-weight:700;">{{ $tx->creditPlan?->name ?? 'N/A' }}</td>
                                    <td>{{ $tx->business?->company_name ?? '—' }}</td>
                                    <td
                                        style="font-weight:800;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                                        +{{ number_format($tx->no_of_credits) }}
                                    </td>
                                    <td style="font-weight:700;">${{ number_format($tx->amount, 2) }}</td>
                                    <td>{{ $tx->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <span class="cr-badge cr-badge-{{ $tx->status }}">
                                            {{ ucfirst($tx->status) }}
                                        </span>
                                    </td>
                                    <td style="font-family:monospace;font-size:.8rem;color:#94a3b8;">
                                        {{ substr($tx->payment_intent_id ?? ($tx->stripe_session_id ?? ''), 0, 12) }}…
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif

        {{-- TAB: BUY CREDITS --}}
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
                    <div class="cr-empty__title">All plans purchased</div>
                    <div class="cr-empty__sub">You have already purchased all available credit plans for this business.
                        Check back later for new offers!</div>
                </div>
            @else
                <div class="cr-plans-grid">
                    @php
                        $planColors = [
                            ['from' => '#667eea', 'to' => '#764ba2'],
                            ['from' => '#f093fb', 'to' => '#f5576c'],
                            ['from' => '#4facfe', 'to' => '#00f2fe'],
                            ['from' => '#fa709a', 'to' => '#fee140'],
                            ['from' => '#30cfd0', 'to' => '#330867'],
                            ['from' => '#a8edea', 'to' => '#fed6e3'],
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
                                {{ $plan->description ?? 'Boost your listings and reach more couples planning their special day.' }}
                            </div>
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

    </div>

    {{-- Purchase Confirmation Modal --}}
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
                                        style="color:#059669;font-weight:700;margin-left:.2rem;">({{ $selectedPlan->discounted_percentage }}%
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
                            <span style="font-size:.8rem;color:#dc2626;font-weight:700;">{{ $message }}</span>
                        @enderror
                    </div>

                    <p
                        style="font-size:.85rem;color:#64748b;line-height:1.6;padding:.9rem 1.1rem;background:rgba(102,126,234,.05);border-radius:12px;border:1px solid rgba(102,126,234,.15);">
                        🔒 You'll be securely redirected to Stripe's checkout page. Credits are added to your business
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
