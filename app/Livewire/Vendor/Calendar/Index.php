<?php

namespace App\Livewire\Vendor\Calendar;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Vendor\Vendor;
use App\Models\Business\Business;
use App\Models\Timing\Timing;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('components.layouts.vendor.vendor')]
class Index extends Component
{
    public $vendor;
    public $businesses = [];
    public $selectedBusiness = null;
    public $currentMonth;
    public $calendarDays = [];
    public $showTimingModal = false;
    public $selectedDate = null;
    public $timings = [
        'morning'   => ['enabled' => false, 'start' => '09:00', 'end' => '12:00'],
        'afternoon' => ['enabled' => false, 'start' => '13:00', 'end' => '16:00'],
        'evening'   => ['enabled' => false, 'start' => '17:00', 'end' => '21:00'],
    ];
    public $slotDuration = 60;

    // Weekly timings
    public $weeklyTimings = [];
    public $showWeeklyModal = false;
    public $weeklyForm = [];

    public function mount()
    {
        $this->vendor = Auth::guard('vendor')->user();
        $this->loadBusinesses();
        $this->currentMonth = Carbon::now()->startOfMonth();
        if (!empty($this->businesses)) {
            $this->selectedBusiness = $this->businesses[0]['id'];
        }
        $this->generateCalendar();
        $this->loadWeeklyTimings();
    }

    public function openWeeklyModal()
    {
        $this->loadWeeklyTimings();
        $this->weeklyForm = $this->weeklyTimings;
        $this->showWeeklyModal = true;
    }

    public function closeWeeklyModal()
    {
        $this->showWeeklyModal = false;
        $this->reset('weeklyForm');
    }

    public function saveWeeklyTimings()
    {
        $this->validate([
            'selectedBusiness' => 'required|exists:businesses,id',
            'weeklyForm' => 'array',
        ]);

        $business = Business::where('id', $this->selectedBusiness)
            ->where('vendor_id', $this->vendor->id)
            ->firstOrFail();

        $timing = Timing::firstOrNew(['business_id' => $business->id]);
        $timing->working_hours = $this->weeklyForm;
        $timing->save();

        $this->closeWeeklyModal();
        $this->loadWeeklyTimings();
        $this->generateCalendar(); // because calendar indicators may depend on weekly vs per‑date
        session()->flash('success', 'Weekly schedule updated successfully!');
    }

    public function setTodayTimings()
    {
        $today = Carbon::today()->format('Y-m-d');
        $this->openTimingModal($today);
    }

    public function loadBusinesses()
    {
        $this->businesses = $this->vendor->businesses()
            ->select('id', 'company_name')
            ->get()
            ->map(fn($b) => ['id' => $b->id, 'name' => $b->company_name])
            ->toArray();
    }

    public function generateCalendar()
    {
        if (!$this->selectedBusiness) {
            $this->calendarDays = [];
            return;
        }

        $startOfMonth = $this->currentMonth->copy()->startOfMonth();
        $endOfMonth = $this->currentMonth->copy()->endOfMonth();
        $startOfCalendar = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

        $days = [];
        $current = $startOfCalendar->copy();
        while ($current <= $endOfCalendar) {
            $days[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'isCurrentMonth' => $current->month == $this->currentMonth->month,
                'isToday' => $current->isToday(),
                'timings' => $this->getTimingsForDate($current->format('Y-m-d')),
            ];
            $current->addDay();
        }
        $this->calendarDays = $days;
    }

    protected function getTimingsForDate($date)
    {
        if (!$this->selectedBusiness) return null;
        $timing = Timing::where('business_id', $this->selectedBusiness)->first();
        if (!$timing) return null;
        // First check for per‑date override
        if (isset($timing->timings_venue[$date])) {
            return $timing->timings_venue[$date];
        }
        // Otherwise return null (we'll fall back to weekly in the modal)
        return null;
    }

    public function updatedSelectedBusiness()
    {
        $this->generateCalendar();
        $this->loadWeeklyTimings();
    }

    public function previousMonth()
    {
        $this->currentMonth->subMonth();
        $this->generateCalendar();
    }

    public function nextMonth()
    {
        $this->currentMonth->addMonth();
        $this->generateCalendar();
    }

    public function loadWeeklyTimings()
    {
        $default = $this->defaultWeeklyTimings();

        if (!$this->selectedBusiness) {
            $this->weeklyTimings = $default;
            return;
        }

        $timing = Timing::where('business_id', $this->selectedBusiness)->first();
        $saved = $timing && $timing->working_hours ? $timing->working_hours : [];

        // Merge saved data with default to ensure all days and slots exist
        $normalized = [];
        foreach (array_keys($default) as $day) {
            $normalized[$day] = [];
            foreach (['morning', 'afternoon', 'evening'] as $slot) {
                $normalized[$day][$slot] = $saved[$day][$slot] ?? $default[$day][$slot];
            }
        }

        $this->weeklyTimings = $normalized;
    }

    protected function defaultWeeklyTimings()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $default = [];
        foreach ($days as $day) {
            $default[$day] = [
                'morning'   => ['enabled' => false, 'start' => '09:00', 'end' => '12:00'],
                'afternoon' => ['enabled' => false, 'start' => '13:00', 'end' => '16:00'],
                'evening'   => ['enabled' => false, 'start' => '17:00', 'end' => '21:00'],
            ];
        }
        return $default;
    }

    public function openTimingModal($date)
    {
        $this->selectedDate = $date;
        $saved = $this->getTimingsForDate($date);
        if ($saved) {
            $this->timings = $saved;
        } else {
            // No per‑date override – use the weekly schedule for this day of week
            $dayOfWeek = Carbon::parse($date)->format('l'); // e.g., "Monday"
            $weekly = $this->weeklyTimings[$dayOfWeek] ?? null;
            if ($weekly) {
                $this->timings = $weekly;
            } else {
                // Fallback to defaults (all disabled)
                $this->timings = [
                    'morning'   => ['enabled' => false, 'start' => '09:00', 'end' => '12:00'],
                    'afternoon' => ['enabled' => false, 'start' => '13:00', 'end' => '16:00'],
                    'evening'   => ['enabled' => false, 'start' => '17:00', 'end' => '21:00'],
                ];
            }
        }
        $this->showTimingModal = true;
    }

    public function closeTimingModal()
    {
        $this->showTimingModal = false;
        $this->selectedDate = null;
        $this->reset('timings');
    }

    public function saveTimings()
    {
        $this->validate([
            'selectedBusiness' => 'required|exists:businesses,id',
            'selectedDate' => 'required|date',
            'timings' => 'array',
        ]);

        $business = Business::where('id', $this->selectedBusiness)
            ->where('vendor_id', $this->vendor->id)
            ->firstOrFail();

        $timing = Timing::firstOrNew(['business_id' => $business->id]);

        // Get existing timings_venue or initialize empty array
        $timingsVenue = $timing->timings_venue ?? [];

        // Prepare the data for this date – only include slots with both times filled
        $filtered = [];
        foreach ($this->timings as $slot => $data) {
            if (!empty($data['start']) && !empty($data['end'])) {
                $filtered[$slot] = [
                    'enabled' => true,
                    'start' => $data['start'],
                    'end' => $data['end'],
                ];
            }
        }

        $timingsVenue[$this->selectedDate] = $filtered;

        $timing->timings_venue = $timingsVenue;
        // If you still want to store slot_duration, keep it; otherwise you can remove it.
        // $timing->slot_duration = $this->slotDuration;  // optional
        $timing->save();

        $this->closeTimingModal();
        $this->generateCalendar();
        session()->flash('success', "Timings saved for " . Carbon::parse($this->selectedDate)->format('M d, Y'));
    }

    public function render()
    {
        return view('livewire.vendor.calendar.index', [
            'monthName' => $this->currentMonth->format('F Y'),
            'weekDays' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        ]);
    }
}
