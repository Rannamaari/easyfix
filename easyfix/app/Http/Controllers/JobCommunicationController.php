<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\JobUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobCommunicationController extends Controller
{
    public function storeMessage(Request $request, JobRequest $jobRequest): RedirectResponse
    {
        $this->authorizeAccess($request, $jobRequest);

        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $jobRequest->messages()->create([
            'user_id' => $request->user()->id,
            'sender_role' => $request->user()->role ?? 'customer',
            'message' => $data['message'],
        ]);

        return back()->with('success', 'Message sent.');
    }

    public function updateMessage(Request $request, JobRequest $jobRequest, int $messageId): RedirectResponse
    {
        $this->authorizeAccess($request, $jobRequest);

        $message = $jobRequest->messages()->whereKey($messageId)->firstOrFail();
        $user = $request->user();
        $isAdmin = ($user->role ?? null) === 'admin';

        if (!$isAdmin && $message->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $message->update([
            'message' => $data['message'],
            'edited_at' => now(),
        ]);

        return back()->with('success', 'Message updated.');
    }

    public function requestUpdate(Request $request, JobRequest $jobRequest): RedirectResponse
    {
        $this->authorizeAccess($request, $jobRequest, customerOnly: true);

        $openRequest = $jobRequest->updateRequests()->where('status', 'open')->first();
        if ($openRequest) {
            return back()->with('error', 'You already have an open update request. Please wait for a response.');
        }

        $data = $request->validate([
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $jobRequest->updateRequests()->create([
            'requested_by_user_id' => $request->user()->id,
            'requested_by_role' => $request->user()->role ?? 'customer',
            'message' => $data['message'] ?? null,
            'status' => 'open',
        ]);

        return back()->with('success', 'Update request sent.');
    }

    public function respondUpdate(Request $request, JobRequest $jobRequest, JobUpdateRequest $updateRequest): RedirectResponse
    {
        $this->authorizeAccess($request, $jobRequest, providerOrAdminOnly: true);

        if ($updateRequest->job_request_id !== $jobRequest->id) {
            abort(404);
        }

        $data = $request->validate([
            'response' => ['required', 'string', 'max:2000'],
        ]);

        $updateRequest->update([
            'response' => $data['response'],
            'status' => 'responded',
            'responded_by_user_id' => $request->user()->id,
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Update response sent.');
    }

    private function authorizeAccess(Request $request, JobRequest $jobRequest, bool $customerOnly = false, bool $providerOrAdminOnly = false): void
    {
        $user = $request->user();

        $isAdmin = ($user->role ?? null) === 'admin';
        $isCustomer = $jobRequest->customer_id === $user->id;
        $isProvider = $jobRequest->provider_id === $user->id;

        if ($customerOnly && !$isCustomer && !$isAdmin) {
            abort(403);
        }

        if ($providerOrAdminOnly && !$isProvider && !$isAdmin) {
            abort(403);
        }

        if (!$customerOnly && !$providerOrAdminOnly && !$isAdmin && !$isCustomer && !$isProvider) {
            abort(403);
        }
    }
}
