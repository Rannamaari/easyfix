<?php

namespace App\Filament\Resources\JobUpdateRequestResource\Pages;

use App\Filament\Resources\JobUpdateRequestResource;
use Filament\Resources\Pages\EditRecord;

class EditJobUpdateRequest extends EditRecord
{
    protected static string $resource = JobUpdateRequestResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['response']) && empty($data['responded_at'])) {
            $data['responded_at'] = now();
        }

        if (!empty($data['response']) && empty($data['responded_by_user_id'])) {
            $data['responded_by_user_id'] = auth()->id();
        }

        if (!empty($data['response']) && ($data['status'] ?? null) === 'open') {
            $data['status'] = 'responded';
        }

        return $data;
    }
}
