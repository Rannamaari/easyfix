<?php

namespace App\Filament\Resources\JobRequestResource\Pages;

use App\Filament\Resources\JobRequestResource;
use App\Models\JobRequest;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobRequest extends EditRecord
{
    protected static string $resource = JobRequestResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        $job = $this->getRecord();
        $user = auth()->user();

        if ($job instanceof JobRequest && $user) {
            $job->messageReads()->updateOrCreate(
                ['user_id' => $user->id],
                ['last_read_at' => now()]
            );
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
