<?php

namespace App\Filament\Resources\JobRequestResource\Pages;

use App\Filament\Resources\JobRequestResource;
use App\Models\JobRequest;
use App\Models\RequestPhoto;
use App\Jobs\ProcessRequestPhotoJob;
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

    protected function afterSave(): void
    {
        $state = $this->form->getState();
        $files = $state['new_attachments'] ?? [];

        if (!$files) {
            return;
        }

        $job = $this->getRecord();
        $userId = auth()->id();

        foreach ($files as $path) {
            $photo = RequestPhoto::create([
                'job_request_id' => $job->id,
                'original_name' => basename($path),
                'disk' => config('filesystems.disks.spaces.key') ? 'spaces' : 'public',
                'status' => 'processing',
            ]);

            ProcessRequestPhotoJob::dispatch($photo->id, $path, basename($path));
        }

        $this->form->fill(array_merge($state, ['new_attachments' => []]));
    }
}
