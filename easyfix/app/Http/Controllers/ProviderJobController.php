<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class ProviderJobController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->user()->isProvider()) {
                abort(403, 'Access denied. Providers only.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $activeJobs = $user->jobRequestsAsProvider()
            ->whereIn('status', [
                JobStatus::Assigned,
                JobStatus::EnRoute,
                JobStatus::InProgress,
            ])
            ->with(['category', 'service', 'customer'])
            ->latest('updated_at')
            ->get();

        $completedJobs = $user->jobRequestsAsProvider()
            ->where('status', JobStatus::Completed)
            ->with(['category', 'service', 'customer', 'payment'])
            ->latest('completed_at')
            ->take(10)
            ->get();

        $stats = [
            'active' => $activeJobs->count(),
            'completed_today' => $user->jobRequestsAsProvider()
                ->where('status', JobStatus::Completed)
                ->whereDate('completed_at', today())
                ->count(),
            'completed_total' => $user->jobRequestsAsProvider()
                ->where('status', JobStatus::Completed)
                ->count(),
        ];

        return view('provider.index', compact('activeJobs', 'completedJobs', 'stats'));
    }

    public function show(JobRequest $jobRequest)
    {
        $this->authorizeProvider($jobRequest);

        $jobRequest->load([
            'category',
            'service',
            'customer',
            'approvedQuote',
            'attachments',
            'statusUpdates.user',
            'messages.user',
            'updateRequests.requestedBy',
            'updateRequests.respondedBy',
            'payment',
            'photos',
        ]);

        $jobRequest->messageReads()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['last_read_at' => now()]
        );

        return view('provider.show', ['job' => $jobRequest]);
    }

    public function markEnRoute(JobRequest $jobRequest)
    {
        $this->authorizeProvider($jobRequest);

        if ($jobRequest->status !== JobStatus::Assigned) {
            return back()->with('error', 'Cannot mark as en route from current status.');
        }

        $jobRequest->updateStatus(JobStatus::EnRoute, 'Provider is on the way', auth()->id());

        return back()->with('success', 'Status updated to En Route.');
    }

    public function markInProgress(JobRequest $jobRequest)
    {
        $this->authorizeProvider($jobRequest);

        if ($jobRequest->status !== JobStatus::EnRoute) {
            return back()->with('error', 'Cannot mark as in progress from current status.');
        }

        $jobRequest->updateStatus(JobStatus::InProgress, 'Work started', auth()->id());

        return back()->with('success', 'Status updated to In Progress.');
    }

    public function markComplete(Request $request, JobRequest $jobRequest)
    {
        $this->authorizeProvider($jobRequest);

        if ($jobRequest->status !== JobStatus::InProgress) {
            return back()->with('error', 'Cannot mark as complete from current status.');
        }

        $request->validate([
            'payment_method' => ['required', 'in:cash,bank_transfer'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        // Create payment record
        $amount = $jobRequest->approvedQuote?->total
            ?? $jobRequest->approvedQuote?->amount
            ?? 0;
        $jobRequest->payment()->create([
            'method' => $request->payment_method,
            'amount' => $amount,
            'status' => $request->payment_method === 'cash' ? 'confirmed' : 'pending',
            'notes' => $request->notes,
            'confirmed_at' => $request->payment_method === 'cash' ? now() : null,
            'confirmed_by' => $request->payment_method === 'cash' ? auth()->id() : null,
        ]);

        $jobRequest->updateStatus(
            JobStatus::Completed,
            'Job completed. Payment: ' . ucfirst(str_replace('_', ' ', $request->payment_method)),
            auth()->id()
        );

        // Update provider stats
        $profile = auth()->user()->providerProfile;
        if ($profile) {
            $profile->increment('total_jobs');
        }

        return redirect()->route('provider.index')->with('success', 'Job completed successfully!');
    }

    public function uploadPhoto(Request $request, JobRequest $jobRequest)
    {
        $this->authorizeProvider($jobRequest);

        $request->validate([
            'photo' => ['required', 'image', 'max:5120'],
            'type' => ['required', 'in:before,after'],
        ]);

        $path = $request->file('photo')->store('job-attachments/' . $jobRequest->id, 'local');

        $jobRequest->attachments()->create([
            'file_path' => $path,
            'file_name' => $request->file('photo')->getClientOriginalName(),
            'file_type' => $request->file('photo')->getMimeType(),
            'type' => $request->type,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', ucfirst($request->type) . ' photo uploaded.');
    }

    private function authorizeProvider(JobRequest $jobRequest): void
    {
        if ($jobRequest->provider_id !== auth()->id()) {
            abort(403, 'This job is not assigned to you.');
        }
    }
}
