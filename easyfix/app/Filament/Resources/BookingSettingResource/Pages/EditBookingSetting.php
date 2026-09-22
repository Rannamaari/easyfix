<?php

namespace App\Filament\Resources\BookingSettingResource\Pages;

use App\Filament\Resources\BookingSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBookingSetting extends EditRecord
{
    protected static string $resource = BookingSettingResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Service Prices & Booking Settings';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(false),
        ];
    }
}
