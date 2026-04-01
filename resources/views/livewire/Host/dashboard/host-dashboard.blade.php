<div class="wb-dashboard">

    {{-- Hero / Welcome with Countdown --}}
    <div class="wb-hero">
        <div class="wb-hero-bg"></div>
        <div class="wb-container">
            <div class="wb-hero-content">
                <div>
                    <h1 class="wb-hero-title">
                        Welcome back, {{ Auth::guard('host')->user()->full_name ?? 'Host' }}!
                    </h1>
                    <p class="wb-hero-subtitle">
                        <span>🎊</span>
                        @if ($weddingDate)
                            <span>Your big day is {{ \Carbon\Carbon::parse($weddingDate)->format('F d, Y') }}</span>
                        @else
                            <span>Set your wedding date to start planning</span>
                        @endif
                    </p>
                </div>
                <button wire:click="openDateModal" class="wb-btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $weddingDate ? 'Change Date' : 'Set Date' }}
                </button>
            </div>

            {{-- Live Countdown Section --}}
            @if ($weddingDate)
                <div class="wb-countdown" x-data="countdownTimer('{{ $weddingDate }}')">
                    <p class="wb-countdown-label">⏰ TIME UNTIL YOUR BIG DAY</p>
                    <div class="wb-countdown-grid">
                        <div class="wb-countdown-item">
                            <div class="wb-countdown-value" x-text="String(days).padStart(2, '0')">00</div>
                            <div class="wb-countdown-unit">Days</div>
                        </div>
                        <div class="wb-countdown-item">
                            <div class="wb-countdown-value" x-text="String(hours).padStart(2, '0')">00</div>
                            <div class="wb-countdown-unit">Hours</div>
                        </div>
                        <div class="wb-countdown-item">
                            <div class="wb-countdown-value" x-text="String(minutes).padStart(2, '0')">00</div>
                            <div class="wb-countdown-unit">Minutes</div>
                        </div>
                        <div class="wb-countdown-item">
                            <div class="wb-countdown-value" x-text="String(seconds).padStart(2, '0')">00</div>
                            <div class="wb-countdown-unit">Seconds</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="wb-container">
        <div class="wb-stats-grid">
            <!-- Vendors Card -->
            <div class="wb-card">
                <div class="wb-card-header">
                    <h3 class="wb-card-title">VENDORS</h3>
                    <div class="wb-card-icon wb-icon-emerald">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="wb-card-value">
                    {{ $vendorCategories['hiredCount'] }}<span
                        class="wb-card-value-total">/{{ $vendorCategories['totalCount'] }}</span>
                </div>
                <div class="wb-progress">
                    <div class="wb-progress-bar wb-progress-emerald"
                        style="width: {{ ($vendorCategories['hiredCount'] / max($vendorCategories['totalCount'], 1)) * 100 }}%">
                    </div>
                </div>
                <p class="wb-card-footer">{{ $vendorCategories['hiredCount'] }} of {{ $vendorCategories['totalCount'] }}
                    categories hired</p>
            </div>

            <!-- Tasks Card -->
            <div class="wb-card">
                <div class="wb-card-header">
                    <h3 class="wb-card-title">TASKS</h3>
                    <div class="wb-card-icon wb-icon-amber">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="wb-card-value">
                    {{ $doneTasks }}<span class="wb-card-value-total">/{{ $totalTasks }}</span>
                </div>
                <div class="wb-progress">
                    <div class="wb-progress-bar wb-progress-amber"
                        style="width: {{ ($doneTasks / max($totalTasks, 1)) * 100 }}%"></div>
                </div>
                <p class="wb-card-footer">{{ $doneTasks }} of {{ $totalTasks }} tasks completed</p>
            </div>

            <!-- Guests Card -->
            <div class="wb-card">
                <div class="wb-card-header">
                    <h3 class="wb-card-title">GUESTS</h3>
                    <div class="wb-card-icon wb-icon-purple">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="wb-card-value">
                    {{ $respondedGuests }}<span class="wb-card-value-total">/{{ $totalGuests }}</span>
                </div>
                <div class="wb-progress">
                    <div class="wb-progress-bar wb-progress-purple"
                        style="width: {{ ($respondedGuests / max($totalGuests, 1)) * 100 }}%"></div>
                </div>
                <p class="wb-card-footer">{{ $respondedGuests }} of {{ $totalGuests }} guests responded</p>
            </div>
        </div>
    </div>

    {{-- Main Grid: Vendors + Bookings | Checklist + Budget --}}
    <div class="wb-container">
        <div class="wb-main-grid">
            <!-- Left Column -->
            <div class="wb-main-left">
                <!-- My Vendors Card -->
                <div class="wb-card wb-card-full">
                    <div class="wb-card-header wb-card-header-gold">
                        <h2 class="wb-card-title-lg">MY VENDORS</h2>
                        <span class="wb-card-badge">{{ $vendorCategories['hiredCount'] }} of
                            {{ $vendorCategories['totalCount'] }} categories hired</span>
                    </div>
                    <div class="wb-card-body">
                        <div class="wb-vendors-grid">
                            @foreach (array_slice($vendorCategories['all'], 0, 12) as $category)
                                <div class="wb-vendor-item">
                                    <span class="wb-vendor-name">{{ $category }}</span>
                                    @if (in_array($category, $vendorCategories['hired']))
                                        <span class="wb-badge wb-badge-hired">Hired</span>
                                    @else
                                        <a href="{{ route('wedding-vendors.index', ['category' => $category]) }}"
                                            class="wb-badge wb-badge-book">Book Vendors</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- My Bookings Card -->
                <div class="wb-card wb-card-full">
                    <div class="wb-card-header wb-card-header-teal">
                        <h2 class="wb-card-title-lg">MY BOOKINGS</h2>
                        <a href="{{ route('host.bookings.index') }}" class="wb-link">View All →</a>
                    </div>
                    <div class="wb-table-wrapper">
                        <table class="wb-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>BOOKING ID</th>
                                    <th>VENDOR</th>
                                    <th>EVENT DATE</th>
                                    <th>CREATED</th>
                                    <th>STATUS</th>
                                    <th>AMOUNT</th>
                                    <th>ACTIVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentBookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="wb-mono">{{ $booking['booking_id'] }}</td>
                                        <td class="wb-font-medium">{{ $booking['vendor'] }}</td>
                                        <td>{{ $booking['event_date'] }}</td>
                                        <td>{{ $booking['created'] }}</td>
                                        <td>
                                            <span
                                                class="wb-status-badge {{ $statusColors[$booking['status']]['badge'] ?? '' }}">
                                                {{ ucfirst($booking['status']) }}
                                            </span>
                                        </td>
                                        <td class="wb-font-semibold">{{ number_format($booking['amount'], 0) }}</td>
                                        <td><a href="#" class="wb-link-sm">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="wb-main-right">
                <!-- Check List Card -->
                <div class="wb-card">
                    <div class="wb-card-header wb-card-header-amber">
                        <h2 class="wb-card-title-lg">CHECK LIST</h2>
                    </div>
                    <div class="wb-card-body">
                        <div class="wb-checklist-stats">
                            <div class="wb-stat">
                                <div class="wb-stat-value wb-stat-emerald">{{ $doneTasks }}</div>
                                <div class="wb-stat-label">Done</div>
                            </div>
                            <div class="wb-stat">
                                <div class="wb-stat-value wb-stat-amber">{{ $totalTasks - $doneTasks }}</div>
                                <div class="wb-stat-label">To Do</div>
                            </div>
                            <div class="wb-stat">
                                <div class="wb-stat-value wb-stat-red">{{ $overdueTasks }}</div>
                                <div class="wb-stat-label">Overdue</div>
                            </div>
                        </div>
                        <div class="wb-tasks-list">
                            @foreach ($checklistTasks as $task)
                                <div class="wb-task-item">
                                    <input type="checkbox" class="wb-checkbox">
                                    <div class="wb-task-content">
                                        <p class="wb-task-title">{{ $task['title'] }}</p>
                                        <p class="wb-task-desc">{{ $task['description'] }}</p>
                                        <p class="wb-task-meta">Due: {{ $task['due'] }} • {{ $task['type'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="wb-add-task">
                                <a href="{{ route('host.checklists.index') }}" class="wb-link">+ Add new Task</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Budget Card -->
                <div class="wb-card">
                    <div class="wb-card-header wb-card-header-purple">
                        <h2 class="wb-card-title-lg">BUDGET</h2>
                    </div>
                    <div class="wb-card-body">
                        <div class="wb-budget-summary">
                            <p class="wb-budget-label">Total Amount</p>
                            <p class="wb-budget-total">{{ $budgetTotal }}</p>
                            <div class="wb-budget-details">
                                <span>Paid: {{ $budgetSpent }}</span>
                                <span
                                    class="wb-budget-percent">{{ floor((floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))) / floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal)))) * 100) }}%</span>
                            </div>
                            <div class="wb-progress wb-progress-sm">
                                <div class="wb-progress-bar wb-progress-emerald"
                                    style="width: {{ (floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))) / floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal)))) * 100 }}%">
                                </div>
                            </div>
                            <p class="wb-budget-remaining">Remaining to be paid: PKR
                                {{ number_format(floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal))) - floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))), 0) }}
                            </p>
                        </div>
                        <div>
                            <h4 class="wb-expense-title">Expense Breakdown</h4>
                            <div class="wb-expense-list">
                                @forelse($expenseBreakdown as $category => $amount)
                                    <div class="wb-expense-item">
                                        <span>{{ $category }}</span>
                                        <span class="wb-expense-amount">PKR {{ number_format($amount, 0) }}</span>
                                    </div>
                                @empty
                                    <p class="wb-empty">No expenses yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Picker Modal (unchanged) -->
    @if ($showDateModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            x-data="datePickerModal('{{ $weddingDate ?? '' }}')" x-show="$wire.showDateModal" x-cloak>
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Set Your Wedding Date</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Choose the day you'll celebrate your special
                    occasion. (Must be today or in the future)</p>
                <input type="date" x-model="date" :min="todayDate"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" />
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">Minimum date: <span
                        x-text="formatDate(todayDate)"></span></p>
                <div class="flex justify-end gap-3 mt-6">
                    <button @click="$wire.closeDateModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">Cancel</button>
                    <button @click="validateAndSet()"
                        class="px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Save
                        Date</button>
                </div>
            </div>
        </div>
    @endif

    <style>
        /* ── Dashboard specific styles, leveraging layout variables ── */
        .wb-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        /* Hero Section */
        .wb-hero {
            position: relative;
            border-bottom: 1px solid var(--wb-border);
            background: var(--wb-glass);
            backdrop-filter: blur(8px);
            margin-bottom: 2rem;
        }

        .wb-hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .wb-hero-bg::before,
        .wb-hero-bg::after {
            content: '';
            position: absolute;
            width: 20rem;
            height: 20rem;
            border-radius: 9999px;
            filter: blur(5rem);
            opacity: 0.2;
        }

        .wb-hero-bg::before {
            background: var(--wb-rose);
            top: -5rem;
            right: -5rem;
        }

        .wb-hero-bg::after {
            background: var(--wb-gold);
            bottom: -5rem;
            left: -5rem;
        }

        .wb-hero-content {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 2rem 0 1.5rem;
        }

        .wb-hero-title {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(130deg, var(--wb-rose), var(--wb-gold));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .wb-hero-subtitle {
            color: var(--wb-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .wb-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--wb-rose), var(--wb-gold));
            border-radius: 9999px;
            color: white;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .wb-btn-primary:hover {
            opacity: 0.85;
            transform: translateY(-1px);
        }

        /* Countdown */
        .wb-countdown {
            background: var(--wb-cream);
            border-radius: 1rem;
            border: 1px solid var(--wb-border);
            padding: 1.5rem;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .wb-countdown-label {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            color: var(--wb-muted);
            margin-bottom: 1rem;
        }

        .wb-countdown-grid {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .wb-countdown-item {
            text-align: center;
            background: var(--wb-ivory);
            border-radius: 0.75rem;
            padding: 0.75rem;
            min-width: 80px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .wb-countdown-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--wb-rose);
        }

        .wb-countdown-unit {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--wb-muted);
        }

        /* Statistics Cards Grid */
        .wb-stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 640px) {
            .wb-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .wb-stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Base Card */
        .wb-card {
            background: var(--wb-glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--wb-border);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .wb-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .wb-card-full {
            grid-column: span 1;
        }

        .wb-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--wb-border);
        }

        .wb-card-header-gold {
            background: linear-gradient(135deg, rgba(201, 169, 110, 0.08), transparent);
        }

        .wb-card-header-teal {
            background: linear-gradient(135deg, rgba(52, 211, 153, 0.08), transparent);
        }

        .wb-card-header-amber {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.08), transparent);
        }

        .wb-card-header-purple {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), transparent);
        }

        .wb-card-title {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: var(--wb-muted);
            text-transform: uppercase;
            margin: 0;
        }

        .wb-card-title-lg {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--wb-text);
        }

        .wb-card-icon {
            padding: 0.5rem;
            border-radius: 0.5rem;
        }

        .wb-icon-emerald {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .wb-icon-amber {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .wb-icon-purple {
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
        }

        .wb-card-value {
            font-size: 2rem;
            font-weight: 700;
            padding: 0 1.25rem;
            margin-top: 0.5rem;
        }

        .wb-card-value-total {
            font-size: 1rem;
            font-weight: normal;
            color: var(--wb-muted);
        }

        .wb-progress {
            margin: 0.75rem 1.25rem;
            height: 0.375rem;
            background: var(--wb-cream);
            border-radius: 9999px;
            overflow: hidden;
        }

        .wb-progress-bar {
            height: 100%;
            border-radius: 9999px;
        }

        .wb-progress-emerald {
            background: #10b981;
        }

        .wb-progress-amber {
            background: #f59e0b;
        }

        .wb-progress-purple {
            background: #8b5cf6;
        }

        .wb-card-footer {
            font-size: 0.75rem;
            color: var(--wb-muted);
            padding: 0 1.25rem 1rem;
        }

        /* Vendors Grid */
        .wb-vendors-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 0.5rem;
        }

        @media (min-width: 640px) {
            .wb-vendors-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .wb-vendors-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .wb-vendor-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.75rem;
            background: var(--wb-cream);
            border-radius: 0.5rem;
        }

        .wb-vendor-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--wb-text);
        }

        .wb-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .wb-badge-hired {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
        }

        .wb-badge-book {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .wb-badge-book:hover {
            background: rgba(59, 130, 246, 0.2);
        }

        /* Table */
        .wb-table-wrapper {
            overflow-x: auto;
        }

        .wb-table {
            width: 100%;
            font-size: 0.875rem;
            border-collapse: collapse;
        }

        .wb-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            background: var(--wb-cream);
            font-weight: 600;
            color: var(--wb-muted);
            border-bottom: 1px solid var(--wb-border);
        }

        .wb-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--wb-border);
            color: var(--wb-text);
        }

        .wb-table tr:hover {
            background: var(--wb-cream);
        }

        .wb-mono {
            font-family: monospace;
            color: var(--wb-muted);
        }

        .wb-font-medium {
            font-weight: 500;
        }

        .wb-font-semibold {
            font-weight: 600;
        }

        .wb-status-badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .wb-link {
            color: var(--wb-gold);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .wb-link:hover {
            opacity: 0.8;
        }

        .wb-link-sm {
            color: var(--wb-gold);
            font-size: 0.75rem;
            text-decoration: none;
        }

        /* Checklist */
        .wb-checklist-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .wb-stat {
            text-align: center;
            padding: 0.5rem;
            background: var(--wb-cream);
            border-radius: 0.75rem;
        }

        .wb-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .wb-stat-emerald {
            color: #10b981;
        }

        .wb-stat-amber {
            color: #f59e0b;
        }

        .wb-stat-red {
            color: #ef4444;
        }

        .wb-stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--wb-muted);
        }

        .wb-tasks-list {
            max-height: 240px;
            overflow-y: auto;
        }

        .wb-task-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--wb-border);
        }

        .wb-checkbox {
            margin-top: 0.2rem;
            width: 1rem;
            height: 1rem;
            accent-color: var(--wb-gold);
        }

        .wb-task-content {
            flex: 1;
        }

        .wb-task-title {
            font-weight: 500;
            color: var(--wb-text);
        }

        .wb-task-desc {
            font-size: 0.75rem;
            color: var(--wb-muted);
        }

        .wb-task-meta {
            font-size: 0.7rem;
            color: #ef4444;
            margin-top: 0.25rem;
        }

        .wb-add-task {
            margin-top: 0.75rem;
            text-align: right;
        }

        /* Budget */
        .wb-budget-summary {
            margin-bottom: 1.5rem;
        }

        .wb-budget-label {
            font-size: 0.75rem;
            color: var(--wb-muted);
        }

        .wb-budget-total {
            font-size: 2rem;
            font-weight: 700;
            color: var(--wb-text);
        }

        .wb-budget-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .wb-budget-percent {
            font-weight: 600;
            color: #10b981;
        }

        .wb-progress-sm {
            margin: 0.5rem 0;
            height: 0.25rem;
        }

        .wb-budget-remaining {
            font-size: 0.75rem;
            color: var(--wb-muted);
            margin-top: 0.5rem;
        }

        .wb-expense-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--wb-text);
        }

        .wb-expense-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .wb-expense-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            padding: 0.4rem 0;
            border-bottom: 1px dashed var(--wb-border);
        }

        .wb-expense-amount {
            font-weight: 500;
            color: var(--wb-text);
        }

        .wb-empty {
            font-size: 0.875rem;
            color: var(--wb-muted);
            text-align: center;
            padding: 1rem;
        }

        /* Main Grid */
        .wb-main-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-top: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 1024px) {
            .wb-main-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        .wb-main-left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .wb-main-right {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Additional utilities */
        .wb-card-body {
            padding: 1.25rem;
        }

        .wb-card-badge {
            font-size: 0.7rem;
            background: rgba(201, 169, 110, 0.15);
            color: var(--wb-gold);
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
        }
    </style>

    <!-- Alpine.js Scripts for Countdown and Date Picker -->
    <script>
        document.addEventListener('alpine:init', () => {
            // Countdown Timer
            window.countdownTimer = (weddingDate) => ({
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                init() {
                    this.updateCountdown();
                    setInterval(() => this.updateCountdown(), 1000);
                },
                updateCountdown() {
                    const now = new Date();
                    const eventDate = new Date(weddingDate);

                    if (eventDate <= now) {
                        this.days = 0;
                        this.hours = 0;
                        this.minutes = 0;
                        this.seconds = 0;
                        return;
                    }

                    const diff = eventDate - now;
                    this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    this.hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                    this.minutes = Math.floor((diff / (1000 * 60)) % 60);
                    this.seconds = Math.floor((diff / 1000) % 60);
                }
            });

            // Date Picker Modal
            window.datePickerModal = (currentDate) => ({
                date: currentDate,
                todayDate: new Date().toISOString().split('T')[0],
                init() {
                    if (!this.date) {
                        this.date = this.todayDate;
                    }
                },
                formatDate(dateStr) {
                    const date = new Date(dateStr + 'T00:00:00');
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                },
                validateAndSet() {
                    const selectedDate = new Date(this.date + 'T00:00:00');
                    const today = new Date(this.todayDate + 'T00:00:00');

                    if (selectedDate < today) {
                        alert('Please select a date that is today or in the future.');
                        return;
                    }

                    window.Livewire.dispatch('call', {
                        method: 'setWeddingDate',
                        params: [this.date]
                    });
                }
            });
        });
    </script>
</div>
