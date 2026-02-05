<?php

namespace App\Filament\Resources\JobQuoteResource\Pages;

use App\Filament\Resources\JobQuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobQuotes extends ListRecords
{
    protected static string $resource = JobQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
