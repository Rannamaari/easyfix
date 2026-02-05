<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\StoreGuestJobRequest;
use App\Models\JobRequest;
use App\Models\ServiceCategory;

class GuestJobController extends Controller
{
    public function create()
    {
        $categories = ServiceCategory::with('services')
            ->active()
            ->ordered()
            ->get();

        return view('guest.create', compact('categories'));
    }

    public function store(StoreGuestJobRequest $request)
    {
        $preferredTime = null;
        if ($request->filled('preferred_date') && $request->filled('preferred_time_slot')) {
            $preferredTime = \Carbon\Carbon::parse($request->preferred_date . ' ' . $request->preferred_time_slot);
        } elseif ($request->filled('preferred_time')) {
            $preferredTime = \Carbon\Carbon::parse($request->preferred_time);
        }

        $job = JobRequest::create([
            'guest_name' => $request->guest_name,
            'guest_username' => $request->guest_username,
            'guest_phone' => $request->guest_phone,
            'guest_email' => $request->guest_email,
            'guest_contact_preference' => $request->guest_contact_preference,
            'service_category_id' => $request->service_category_id,
            'service_id' => $request->service_id,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'preferred_time' => $preferredTime,
            'status' => JobStatus::Requested,
        ]);

        // Log initial status
        $job->statusUpdates()->create([
            'status' => JobStatus::Requested->value,
            'note' => 'Job request submitted by guest',
        ]);

        return redirect()->route('track.show', $job->guest_token)
            ->with('success', 'Your job request has been submitted. Save this page to track your request.');
    }

    public function show(string $token)
    {
        $job = JobRequest::where('guest_token', $token)
            ->with([
                'category',
                'service',
                'provider',
                'quotes' => fn($q) => $q->latest(),
                'attachments',
                'statusUpdates.user',
                'payment',
            ])
            ->firstOrFail();

        return view('guest.show', compact('job', 'token'));
    }

    public function approveQuote(string $token)
    {
        $job = JobRequest::where('guest_token', $token)->firstOrFail();
        $quote = $job->latestQuote;

        if (!$quote || $quote->status !== 'sent') {
            return back()->with('error', 'No pending quote to approve.');
        }

        $quote->approve();
        $job->updateStatus(JobStatus::Approved, 'Quote approved by guest');

        return back()->with('success', 'Quote approved! We\'ll assign a provider shortly.');
    }

    public function rejectQuote(string $token)
    {
        $job = JobRequest::where('guest_token', $token)->firstOrFail();
        $quote = $job->latestQuote;

        if (!$quote || $quote->status !== 'sent') {
            return back()->with('error', 'No pending quote to reject.');
        }

        $quote->reject();
        $job->updateStatus(JobStatus::Cancelled, 'Quote rejected by guest');

        return back()->with('success', 'Quote rejected. We\'ll send you a revised quote.');
    }
}
