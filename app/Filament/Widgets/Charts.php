<?php

namespace App\Filament\Widgets;

use App\Models\Vendor\Vendor;
use App\Models\Host\Host;
use App\Models\Booking\Booking; // ✅ Fixed namespace
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class Charts extends ChartWidget
{
    protected  ?string $heading = 'Platform Growth Analytics';

    protected static ?int $sort = 2;

    protected string $color = 'info';
    protected bool $isCollapsible = true;

    protected ?string $maxHeight = '500px';
    protected int|string|array $columnSpan = 'full';

    public ?string $filter = 'monthly';

    protected function getData(): array
    {
        return match ($this->filter) {
            'half_year' => $this->halfYearData(),
            'yearly' => $this->yearlyData(),
            default => $this->monthlyData(),
        };
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): array
    {
        return [
            'monthly' => 'Last 30 Days',
            'half_year' => 'Last 6 Months',
            'yearly' => 'Last 12 Months',
        ];
    }

    protected function monthlyData(): array
    {
        $labels = $vendors = $hosts = $bookings = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $labels[] = $date->format('d M');

            $vendors[] = Vendor::whereDate('created_at', $date)->count();
            $hosts[] = Host::whereDate('created_at', $date)->count();
            $bookings[] = Booking::whereDate('created_at', $date)->count();
        }

        return $this->chartResponse($labels, $vendors, $hosts, $bookings);
    }

    protected function halfYearData(): array
    {
        $labels = $vendors = $hosts = $bookings = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);

            $labels[] = $month->format('M Y');

            $vendors[] = Vendor::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $hosts[] = Host::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $bookings[] = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return $this->chartResponse($labels, $vendors, $hosts, $bookings);
    }

    protected function yearlyData(): array
    {
        $labels = $vendors = $hosts = $bookings = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);

            $labels[] = $month->format('M Y');

            $vendors[] = Vendor::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $hosts[] = Host::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $bookings[] = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return $this->chartResponse($labels, $vendors, $hosts, $bookings);
    }

    protected function chartResponse(array $labels, array $vendors, array $hosts, array $bookings): array
    {
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Vendors',
                    'data' => $vendors,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59,130,246,0.15)',
                ],
                [
                    'label' => 'Hosts',
                    'data' => $hosts,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16,185,129,0.15)',
                ],
                [
                    'label' => 'Bookings',
                    'data' => $bookings,
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245,158,11,0.15)',
                ],
            ],
        ];
    }
}