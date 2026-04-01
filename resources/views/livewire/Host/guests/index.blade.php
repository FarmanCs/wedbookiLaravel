<div class="wb-container py-8">
    {{-- Header --}}
    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-rose-600 to-gold-600 bg-clip-text text-transparent">
                Guests
            </h1>
            <p class="text-wb-muted mt-1">Manage your event guests</p>
        </div>
        <div class="flex gap-3">
            <button wire:click="openModal"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-rose-600 to-gold-600 text-white font-medium hover:opacity-90 transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Guest
            </button>
        </div>
    </div>

    {{-- Card with filters and table --}}
    <div class="wb-card">
        {{-- Filters --}}
        <div class="p-6 border-b border-wb-border">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="wb-search">
                    <svg class="wb-search-ico" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search guests..."
                        class="wb-input">
                </div>

                <select wire:model.live="groupFilter" class="wb-select">
                    <option value="">All Groups</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="wb-table">
                <thead>
                    46
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Groups</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $guest)
                        <tr>
                            <td>
                                <p class="font-medium text-wb-text">{{ $guest->full_name }}</p>
                                @if ($guest->city || $guest->state)
                                    <p class="text-sm text-wb-muted">{{ $guest->city }}, {{ $guest->state }}</p>
                                @endif
                            </td>
                            <td>
                                @if ($guest->email)
                                    <p class="text-sm text-wb-text">{{ $guest->email }}</p>
                                @endif
                                @if ($guest->phone_no)
                                    <p class="text-sm text-wb-muted">{{ $guest->phone_no }}</p>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($guest->guestGroups as $group)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-wb-cream text-wb-muted">{{ $group->group_name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                {{ $guest->is_joining ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300' }}">
                                    {{ $guest->is_joining ? 'Attending' : 'Not Attending' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <button wire:click="openModal({{ $guest->id }})"
                                        class="text-wb-muted hover:text-rose-500 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteGuest({{ $guest->id }})"
                                        wire:confirm="Are you sure you want to delete this guest?"
                                        class="text-wb-muted hover:text-red-500 transition" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-wb-muted">
                                No guests found. Add your first guest to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-6 border-t border-wb-border">
            {{ $guests->links() }}
        </div>
    </div>

    {{-- Guest Modal (modern glass style) --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            wire:key="modal" x-data="{ open: true }" x-show="open" x-cloak
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div class="bg-[var(--wb-ivory)] dark:bg-[var(--wb-glass)] rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                @click.stop>
                <div
                    class="sticky top-0 bg-[var(--wb-ivory)] dark:bg-[var(--wb-glass)] border-b border-wb-border px-6 py-4">
                    <h3 class="text-xl font-bold text-wb-text">
                        {{ $guestId ? 'Edit Guest' : 'Add New Guest' }}
                    </h3>
                </div>

                <form wire:submit="saveGuest" class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Full Name *</label>
                        <input type="text" wire:model="full_name" class="wb-input w-full">
                        @error('full_name')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">Email</label>
                            <input type="email" wire:model="email" class="wb-input w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">Phone</label>
                            <input type="text" wire:model="phone_no" class="wb-input w-full">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Mobile</label>
                        <input type="text" wire:model="mobile_no" class="wb-input w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Address</label>
                        <textarea wire:model="address" rows="2" class="wb-input w-full"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">City</label>
                            <input type="text" wire:model="city" class="wb-input w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">State</label>
                            <input type="text" wire:model="state" class="wb-input w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">Zip Code</label>
                            <input type="text" wire:model="zipcode" class="wb-input w-full">
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_joining" id="is_joining" class="wb-checkbox">
                        <label for="is_joining" class="text-sm text-wb-text">Guest is attending</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-2">Guest Groups</label>
                        <div
                            class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto border border-wb-border rounded-lg p-3 bg-wb-cream">
                            @foreach ($groups as $group)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" wire:model="selectedGroups" value="{{ $group->id }}"
                                        class="wb-checkbox">
                                    <span class="text-sm text-wb-text">{{ $group->group_name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-wb-border">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-wb-muted hover:bg-wb-cream rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium bg-gradient-to-r from-rose-600 to-gold-600 text-white rounded-lg hover:opacity-90 transition shadow-md">
                            {{ $guestId ? 'Update' : 'Create' }} Guest
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <style>
        /* Container */
        .wb-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        /* Card */
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

        /* Table */
        .wb-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
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

        /* Search input */
        .wb-search {
            position: relative;
        }

        .wb-search-ico {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1rem;
            height: 1rem;
            color: var(--wb-muted);
            pointer-events: none;
        }

        .wb-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background: var(--wb-cream);
            border: 1px solid var(--wb-border);
            border-radius: 0.5rem;
            color: var(--wb-text);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .wb-input:focus {
            border-color: var(--wb-gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.1);
        }

        .wb-select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background: var(--wb-cream);
            border: 1px solid var(--wb-border);
            border-radius: 0.5rem;
            color: var(--wb-text);
            outline: none;
            cursor: pointer;
        }

        .wb-select:focus {
            border-color: var(--wb-gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.1);
        }

        /* Checkbox */
        .wb-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid var(--wb-border);
            accent-color: var(--wb-gold);
            cursor: pointer;
        }

        /* Pagination (tailwind pagination wrapper) */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: block;
            padding: 0.375rem 0.75rem;
            background: var(--wb-cream);
            color: var(--wb-text);
            border-radius: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .page-link:hover {
            background: var(--wb-border);
        }

        .active .page-link {
            background: linear-gradient(135deg, var(--wb-rose), var(--wb-gold));
            color: white;
        }

        .disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: var(--wb-border);
            border-radius: 3px;
        }

        /* Utility text colors */
        .text-wb-text {
            color: var(--wb-text);
        }

        .text-wb-muted {
            color: var(--wb-muted);
        }

        .bg-wb-cream {
            background: var(--wb-cream);
        }

        .border-wb-border {
            border-color: var(--wb-border);
        }

        .hover\:bg-wb-border:hover {
            background: var(--wb-border);
        }
    </style>
</div>
