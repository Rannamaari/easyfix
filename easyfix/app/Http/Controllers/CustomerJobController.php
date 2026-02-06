<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\StoreJobRequest;
use App\Models\JobRequest;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\JobConfirmation;

class CustomerJobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = $request->user()
            ->jobRequestsAsCustomer()
            ->with(['category', 'service', 'provider', 'latestQuote'])
            ->latest()
            ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = ServiceCategory::with('services')
            ->active()
            ->ordered()
            ->get();

        $addresses = auth()->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return view('jobs.create', compact('categories', 'addresses'));
    }

    public function store(StoreJobRequest $request)
    {
        $user = $request->user();

        if ($request->address_mode === 'saved') {
            $selectedAddress = $user->addresses()->whereKey($request->address_id)->firstOrFail();
        } else {
            $selectedAddress = $user->addresses()->create([
                'label' => $request->new_address_label,
                'address' => $request->new_address,
                'is_default' => $user->addresses()->count() === 0,
            ]);
        }

        $preferredTime = null;
        if ($request->filled('preferred_date') && $request->filled('preferred_time_slot')) {
            $preferredTime = \Carbon\Carbon::parse($request->preferred_date . ' ' . $request->preferred_time_slot);
        } elseif ($request->filled('preferred_time')) {
            $preferredTime = \Carbon\Carbon::parse($request->preferred_time);
        }

        $description = $request->description;
        if ($request->filled('specific_issue')) {
            $description .= "\n\nSpecific issue: " . $request->specific_issue;
        }

        $job = JobRequest::create([
            'customer_id' => $user->id,
            'service_category_id' => $request->service_category_id,
            'service_id' => $request->service_id,
            'description' => $description,
            'address' => $selectedAddress->address,
            'preferred_time' => $preferredTime,
            'status' => JobStatus::Requested,
        ]);

        // Handle attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('job-attachments/' . $job->id, 'public');
                $job->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'type' => 'photo',
                    'uploaded_by' => $request->user()->id,
                ]);
            }
        }

        // Log initial status
        $job->statusUpdates()->create([
            'status' => JobStatus::Requested->value,
            'note' => 'Job request submitted',
            'user_id' => $request->user()->id,
        ]);

        Mail::to($user->email)->send(new JobConfirmation($job));

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Your job request has been submitted. We\'ll send you a quote soon.');
    }

    public function show(JobRequest $jobRequest)
    {
        // Ensure user owns this job
        if ($jobRequest->customer_id !== auth()->id()) {
            abort(403);
        }

        $jobRequest->load([
            'category',
            'service',
            'provider',
            'latestQuote.items',
            'approvedQuote.items',
            'quotes' => fn($q) => $q->latest(),
            'attachments',
            'statusUpdates.user',
            'messages.user',
            'updateRequests.requestedBy',
            'updateRequests.respondedBy',
            'payment',
        ]);

        $jobRequest->messageReads()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['last_read_at' => now()]
        );

        return view('jobs.show', ['job' => $jobRequest]);
    }

    public function approveQuote(JobRequest $jobRequest)
    {
        if ($jobRequest->customer_id !== auth()->id()) {
            abort(403);
        }

        $quote = $jobRequest->latestQuote;

        if (!$quote || $quote->status !== 'sent') {
            return back()->with('error', 'No pending quote to approve.');
        }

        $quote->approve();
        $jobRequest->updateStatus(JobStatus::Approved, 'Quote approved by customer', auth()->id());

        return back()->with('success', 'Quote approved! We\'ll assign a provider shortly.');
    }

    public function rejectQuote(JobRequest $jobRequest)
    {
        if ($jobRequest->customer_id !== auth()->id()) {
            abort(403);
        }

        $quote = $jobRequest->latestQuote;

        if (!$quote || $quote->status !== 'sent') {
            return back()->with('error', 'No pending quote to reject.');
        }

        $quote->reject();
        $jobRequest->updateStatus(JobStatus::Cancelled, 'Quote rejected by customer', auth()->id());

        return back()->with('success', 'Quote rejected. We\'ll send you a revised quote.');
    }
}
