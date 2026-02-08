<?php

namespace App\Http\Controllers;

use App\Models\JobAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class JobAttachmentController extends Controller
{
    public function show(Request $request, JobAttachment $attachment): Response
    {
        $job = $attachment->jobRequest;
        $user = $request->user();
        $token = (string) $request->query('token', '');

        $authorized = false;

        if ($user) {
            if ($user->isAdmin()) {
                $authorized = true;
            } elseif ($user->isProvider() && $job?->provider_id === $user->id) {
                $authorized = true;
            } elseif ($job?->customer_id === $user->id) {
                $authorized = true;
            }
        } elseif ($job && $token !== '' && hash_equals((string) $job->guest_token, $token)) {
            $authorized = true;
        }

        if (!$authorized) {
            abort(403);
        }

        $path = $attachment->file_path;
        $disk = Storage::disk('local');

        if (!$disk->exists($path)) {
            $publicDisk = Storage::disk('public');
            if ($publicDisk->exists($path)) {
                $disk->put($path, $publicDisk->get($path));
                $publicDisk->delete($path);
            } else {
                abort(404);
            }
        }

        $mime = $disk->mimeType($path) ?? 'application/octet-stream';
        $filename = $attachment->file_name ?: basename($path);

        return response()->file($disk->path($path), [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
