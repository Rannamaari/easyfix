<?php

namespace App\Filament\Widgets;

use App\Enums\JobStatus;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\JobRequestResource;
use App\Models\JobRequest;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EasyFixStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'EasyFix at a glance';

    protected ?string $description = 'Customer growth and service-request activity, updated from your live data.';

    protected function getStats(): array
    {
        $customerQuery = User::query()->customers();
        $jobQuery = JobRequest::query();

        $newMembersToday = (clone $customerQuery)->whereDate('created_at', today())->count();
        $newMembersThisWeek = (clone $customerQuery)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $jobsToday = (clone $jobQuery)->whereDate('created_at', today())->count();
        $activeJobs = (clone $jobQuery)->whereNotIn('status', [JobStatus::Completed->value, JobStatus::Cancelled->value])->count();

        return [
            Stat::make('Registered members', (clone $customerQuery)->count())
                ->description($newMembersThisWeek.' joined this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->icon('heroicon-o-users')
                ->url(CustomerResource::getUrl('index')),
            Stat::make('New members today', $newMembersToday)
                ->description('Customer registrations since midnight')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success')
                ->icon('heroicon-o-user-plus')
                ->url(CustomerResource::getUrl('index')),
            Stat::make('Jobs requested today', $jobsToday)
                ->description('New requests since midnight')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->icon('heroicon-o-clipboard-document-list')
                ->url(JobRequestResource::getUrl('index')),
            Stat::make('Active jobs', $activeJobs)
                ->description('Not completed or cancelled')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info')
                ->icon('heroicon-o-wrench-screwdriver')
                ->url(JobRequestResource::getUrl('index')),
        ];
    }
}
