<div class="wb-container py-8">
    {{-- Header --}}
    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-rose-600 to-gold-600 bg-clip-text text-transparent">
                Personalized Checklist
            </h1>
            <p class="text-wb-muted mt-1">Manage your event tasks and to-dos</p>
        </div>
        <button wire:click="openModal"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-rose-600 to-gold-600 text-white font-medium hover:opacity-90 transition shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Task
        </button>
    </div>

    {{-- Card with filters and tasks --}}
    <div class="wb-card">
        {{-- Filters --}}
        <div class="p-6 border-b border-wb-border">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="wb-search">
                    <svg class="wb-search-ico" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tasks..."
                        class="wb-input">
                </div>

                <select wire:model.live="statusFilter" class="wb-select">
                    <option value="all">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="checked">Completed</option>
                </select>

                <select wire:model.live="categoryFilter" class="wb-select">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Tasks List --}}
        <div class="divide-y divide-wb-border">
            @forelse($checklists as $item)
                <div class="p-6 hover:bg-wb-cream/50 transition-colors group">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox" wire:click="toggleStatus({{ $item->id }})"
                                {{ $item->checklist_status === 'checked' ? 'checked' : '' }}
                                class="wb-checkbox w-5 h-5 rounded border-wb-border text-rose-500 focus:ring-rose-500/20">
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 flex-wrap">
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-medium text-wb-text {{ $item->checklist_status === 'checked' ? 'line-through text-wb-muted' : '' }}">
                                        {{ $item->check_list_title }}
                                    </h3>

                                    @if ($item->check_list_description)
                                        <p class="mt-1 text-sm text-wb-muted">
                                            {{ $item->check_list_description }}
                                        </p>
                                    @endif

                                    <div class="mt-2 flex flex-wrap items-center gap-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-wb-cream text-wb-muted">
                                            {{ ucfirst($item->check_list_category) }}
                                        </span>

                                        <div class="flex items-center gap-1 text-sm text-wb-muted">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $item->check_list_due_date ? $item->check_list_due_date->format('M d, Y') : 'No due date' }}
                                        </div>

                                        @if ($item->check_list_due_date && $item->check_list_due_date->isPast() && $item->checklist_status !== 'checked')
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                Overdue
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button wire:click="openModal({{ $item->id }})"
                                        class="text-wb-muted hover:text-rose-500 transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteChecklist({{ $item->id }})"
                                        wire:confirm="Are you sure you want to delete this task?"
                                        class="text-wb-muted hover:text-red-500 transition" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-wb-muted">
                    <svg class="w-16 h-16 mx-auto text-wb-border mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-lg font-medium">No tasks found</p>
                    <p class="text-sm mt-1">Create your first task to get started.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($checklists->hasPages())
            <div class="p-6 border-t border-wb-border">
                {{ $checklists->links() }}
            </div>
        @endif
    </div>

    {{-- Task Modal --}}
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
                        {{ $checklistId ? 'Edit Task' : 'Add New Task' }}
                    </h3>
                </div>

                <form wire:submit="saveChecklist" class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Task Title *</label>
                        <input type="text" wire:model="check_list_title" class="wb-input w-full"
                            placeholder="Enter task title">
                        @error('check_list_title')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Category *</label>
                        <input type="text" wire:model="check_list_category" class="wb-input w-full"
                            placeholder="e.g., Venue, Catering, Decorations">
                        @error('check_list_category')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-wb-muted mb-1">Description</label>
                        <textarea wire:model="check_list_description" rows="3" class="wb-input w-full"
                            placeholder="Add any additional details..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">Due Date *</label>
                            <input type="date" wire:model="check_list_due_date" class="wb-input w-full">
                            @error('check_list_due_date')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-wb-muted mb-1">Status</label>
                            <select wire:model="checklist_status" class="wb-select w-full">
                                <option value="pending">Pending</option>
                                <option value="checked">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-wb-border">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-wb-muted hover:bg-wb-cream rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium bg-gradient-to-r from-rose-600 to-gold-600 text-white rounded-lg hover:opacity-90 transition shadow-md">
                            {{ $checklistId ? 'Update' : 'Create' }} Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <style>
        /* Additional styles to ensure proper rendering */
        .wb-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

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

        .wb-input,
        .wb-select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background: var(--wb-cream);
            border: 1px solid var(--wb-border);
            border-radius: 0.5rem;
            color: var(--wb-text);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .wb-input:focus,
        .wb-select:focus {
            border-color: var(--wb-gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.1);
        }

        .wb-checkbox {
            accent-color: var(--wb-rose);
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .text-wb-text {
            color: var(--wb-text);
        }

        .text-wb-muted {
            color: var(--wb-muted);
        }

        .border-wb-border {
            border-color: var(--wb-border);
        }

        .bg-wb-cream {
            background: var(--wb-cream);
        }

        .hover\:bg-wb-cream\/50:hover {
            background: rgba(243, 237, 227, 0.5);
        }

        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }

        .transition-opacity {
            transition-property: opacity;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</div>
