<?php

namespace App\Enums;

enum JobStatus: string
{
    case Requested = 'requested';
    case UnderReview = 'under_review';
    case VisitChargeRequired = 'visit_charge_required';
    case VisitChargePaid = 'visit_charge_paid';
    case InspectionScheduled = 'inspection_scheduled';
    case DiagnosisInProgress = 'diagnosis_in_progress';
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
            self::UnderReview => 'Under Review',
            self::VisitChargeRequired => 'Visit Charge Required',
            self::VisitChargePaid => 'Visit Charge Paid',
            self::InspectionScheduled => 'Inspection Scheduled',
            self::DiagnosisInProgress => 'Diagnosis In Progress',
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
            self::UnderReview => 'warning',
            self::VisitChargeRequired => 'danger',
            self::VisitChargePaid => 'success',
            self::InspectionScheduled => 'primary',
            self::DiagnosisInProgress => 'warning',
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
            self::UnderReview => 'heroicon-o-phone',
            self::VisitChargeRequired => 'heroicon-o-banknotes',
            self::VisitChargePaid => 'heroicon-o-check-circle',
            self::InspectionScheduled => 'heroicon-o-calendar-days',
            self::DiagnosisInProgress => 'heroicon-o-magnifying-glass',
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
            self::UnderReview,
            self::VisitChargeRequired,
            self::VisitChargePaid,
            self::InspectionScheduled,
            self::DiagnosisInProgress,
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
        return $this !== $newStatus;
    }
}
