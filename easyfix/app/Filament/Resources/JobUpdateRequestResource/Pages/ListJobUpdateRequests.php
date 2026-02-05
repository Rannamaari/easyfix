<?php

namespace App\Filament\Resources\JobUpdateRequestResource\Pages;

use App\Filament\Resources\JobUpdateRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobUpdateRequests extends ListRecords
{
    protected static string $resource = JobUpdateRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
