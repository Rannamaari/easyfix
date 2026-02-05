<?php

namespace App\Enums;

enum JobStatus: string
{
    case Requested = 'requested';
    case Quoted = 'quoted';
    case Approved = 'approved';
    case Assigned = 'assigned';
    case EnRoute = 'en_route';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Requested => 'Requested',
            self::Quoted => 'Quote Sent',
            self::Approved => 'Quote Approved',
            self::Assigned => 'Provider Assigned',
            self::EnRoute => 'En Route',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Requested => 'gray',
            self::Quoted => 'info',
            self::Approved => 'success',
            self::Assigned => 'warning',
            self::EnRoute => 'primary',
            self::InProgress => 'primary',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Requested => 'heroicon-o-clock',
            self::Quoted => 'heroicon-o-document-text',
            self::Approved => 'heroicon-o-check-circle',
            self::Assigned => 'heroicon-o-user-plus',
            self::EnRoute => 'heroicon-o-truck',
            self::InProgress => 'heroicon-o-wrench-screwdriver',
            self::Completed => 'heroicon-o-check-badge',
            self::Cancelled => 'heroicon-o-x-circle',
        };
    }

    public static function forCustomer(): array
    {
        return [
            self::Requested,
            self::Quoted,
            self::Approved,
            self::Cancelled,
        ];
    }

    public static function forProvider(): array
    {
        return [
            self::EnRoute,
            self::InProgress,
            self::Completed,
        ];
    }

    public static function forAdmin(): array
    {
        return self::cases();
    }

    public function canTransitionTo(JobStatus $newStatus): bool
    {
        $transitions = [
            self::Requested->value => [self::Quoted, self::Cancelled],
            self::Quoted->value => [self::Approved, self::Cancelled],
            self::Approved->value => [self::Assigned, self::Cancelled],
            self::Assigned->value => [self::EnRoute, self::Cancelled],
            self::EnRoute->value => [self::InProgress, self::Cancelled],
            self::InProgress->value => [self::Completed, self::Cancelled],
            self::Completed->value => [],
            self::Cancelled->value => [],
        ];

        return in_array($newStatus, $transitions[$this->value] ?? []);
    }
}
