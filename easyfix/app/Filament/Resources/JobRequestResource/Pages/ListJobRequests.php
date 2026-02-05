<?php

namespace App\Filament\Resources\JobRequestResource\Pages;

use App\Filament\Resources\JobRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobRequests extends ListRecords
{
    protected static string $resource = JobRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
