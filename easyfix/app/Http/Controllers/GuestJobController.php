<?php

namespace App\Http\Controllers;

use App\Enums\JobStatus;
use App\Http\Requests\StoreGuestJobRequest;
use App\Models\JobRequest;
use App\Models\RequestPhoto;
use App\Jobs\ProcessRequestPhotoJob;
use App\Models\User;
use App\Mail\JobConfirmation;
use App\Models\ServiceCategory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class GuestJobController extends Controller
{
    public function create()
    {
        return view('guest.create');
    }

    public function store(StoreGuestJobRequest $request)
    {
        return redirect()
            ->route('register')
            ->with('status', 'Please register or log in before requesting a service.');
    }

    public function showRegister(Request $request)
    {
        return view('guest.register', [
            'name' => $request->query('name', ''),
            'email' => $request->query('email', ''),
            'phone' => $request->query('phone', ''),
            'token' => $request->query('token', ''),
        ]);
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:30', 'unique:' . User::class],
            'token' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $job = JobRequest::where('guest_token', $request->token)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        if ($job) {
            $user->addresses()->create([
                'label' => 'home',
                'address' => $job->address,
                'is_default' => true,
            ]);
        }

        // Link guest jobs by email or phone
        JobRequest::whereNull('customer_id')
            ->where(function ($query) use ($user) {
                $query->where('guest_email', $user->email)
                    ->orWhere('guest_phone', $user->phone);
            })
            ->update(['customer_id' => $user->id]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
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
            'photos',
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
