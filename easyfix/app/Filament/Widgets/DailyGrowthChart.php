<?php

namespace App\Filament\Widgets;

use App\Models\JobRequest;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class DailyGrowthChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Daily members and service requests';

    protected static ?string $description = 'New registered customers and job requests over the last 30 days.';

    protected static ?string $maxHeight = '320px';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        $memberTrend = $this->dailyTrend(User::query()->customers());
        $jobTrend = $this->dailyTrend(JobRequest::query());

        return [
            'datasets' => [
                [
                    'label' => 'New members',
                    'data' => $memberTrend['data'],
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Jobs requested',
                    'data' => $jobTrend['data'],
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $memberTrend['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    /**
     * Build a database-agnostic daily series, so it works with both MySQL and Postgres.
     *
     * @return array{labels: array<int, string>, data: array<int, int>}
     */
    private function dailyTrend(Builder $query, int $days = 30): array
    {
        $start = now()->subDays($days - 1)->startOfDay();
        $end = now()->endOfDay();

        $counts = $query
            ->whereBetween('created_at', [$start, $end])
            ->pluck('created_at')
            ->map(fn ($createdAt) => Carbon::parse($createdAt)->toDateString())
            ->countBy();

        $dates = collect(range($days - 1, 0))
            ->map(fn (int $offset) => now()->subDays($offset));

        return [
            'labels' => $dates->map(fn (Carbon $date) => $date->format('M j'))->all(),
            'data' => $dates->map(fn (Carbon $date) => (int) ($counts[$date->toDateString()] ?? 0))->all(),
        ];
    }
}
