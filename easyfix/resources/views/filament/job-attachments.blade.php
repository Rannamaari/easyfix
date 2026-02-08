@php
    $record = $getRecord();
    $attachments = $record?->photos ?? collect();
@endphp

<div class="space-y-3">
    <p class="text-sm text-gray-600">
        {{ $attachments->isEmpty() ? 'No photos uploaded yet.' : 'Uploaded photos' }}
    </p>

    @if($attachments->isNotEmpty())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach($attachments as $attachment)
                @if($attachment->status === 'ready')
                    @php
                        $disk = $attachment->disk ?? 'public';
                        if ($disk === 'public') {
                            $thumbUrl = \Storage::disk('public')->url($attachment->thumb_path);
                            $photoUrl = \Storage::disk('public')->url($attachment->photo_path);
                        } else {
                            $thumbUrl = \Storage::disk($disk)->temporaryUrl($attachment->thumb_path, now()->addMinutes(15));
                            $photoUrl = \Storage::disk($disk)->temporaryUrl($attachment->photo_path, now()->addMinutes(15));
                        }
                    @endphp
                    <a href="{{ $photoUrl }}" target="_blank" class="block group">
                        <img src="{{ $thumbUrl }}" alt="{{ $attachment->original_name }}" class="w-full h-36 object-cover rounded-lg border border-gray-200 group-hover:opacity-90 transition">
                        @if($attachment->caption)
                            <p class="mt-1 text-xs text-gray-600 truncate">{{ $attachment->caption }}</p>
                        @endif
                    </a>
                @elseif($attachment->status === 'processing')
                    <div class="w-full h-36 rounded-lg border border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-600">
                        Processing…
                    </div>
                @else
                    <div class="w-full h-36 rounded-lg border border-dashed border-red-300 flex items-center justify-center text-xs text-red-600">
                        Failed
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
