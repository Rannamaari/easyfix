<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\SignupVerification;
use App\Models\User;
use App\Services\DhiraaguSmsClient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.phone-entry', [
            'mode' => 'register',
        ]);
    }

    /**
     * Start a phone-first registration or login flow.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, DhiraaguSmsClient $smsClient): RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'mode' => ['required', 'in:register,login'],
        ]);

        $localPhone = $this->normalizeLocalPhone($request->string('phone')->value(), $smsClient);
        $destination = $smsClient->normalizeDestination($request->string('phone')->value());

        if (! $localPhone || ! $destination) {
            return back()->withErrors([
                'phone' => 'Enter a valid Maldivian phone number.',
            ])->withInput();
        }

        $mode = $request->string('mode')->value();
        $rateLimitKey = 'auth-phone-start:' . $request->ip() . ':' . $localPhone;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            return back()->withErrors([
                'phone' => "Please wait {$seconds} seconds before requesting another code.",
            ])->withInput();
        }

        RateLimiter::hit($rateLimitKey, 60);

        SignupVerification::query()
            ->where('phone', $localPhone)
            ->delete();

        $otp = (string) random_int(100000, 999999);
        $verification = SignupVerification::create([
            'token' => (string) Str::uuid(),
            'signup_method' => 'phone',
            'phone' => $localPhone,
            'otp_hash' => Hash::make($otp),
            'otp_sent_at' => now(),
            'otp_expires_at' => now()->addMinutes(10),
            'attempts' => 0,
        ]);

        $result = $smsClient->send([
            $destination,
        ], "Your EasyFix verification code is {$otp}. It expires in 10 minutes.");

        if (! $result['ok']) {
            $verification->delete();

            return back()->withErrors([
                'phone' => 'We could not send the verification code just now. Please try again.',
            ])->withInput();
        }

        return redirect()->route('register.verify', [
            'signupVerification' => $verification,
            'mode' => $mode,
        ])->with('status', 'We sent a 6-digit code to your phone.');
    }

    public function showVerification(SignupVerification $signupVerification, Request $request): View
    {
        return view('auth.verify-phone-otp', [
            'signupVerification' => $signupVerification,
            'mode' => $request->query('mode', 'register'),
        ]);
    }

    public function verifyOtp(SignupVerification $signupVerification, Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
            'mode' => ['required', 'in:register,login'],
        ]);

        if ($signupVerification->verified_at) {
            return $this->handleVerifiedPhone($signupVerification);
        }

        if (! $signupVerification->otp_expires_at || now()->greaterThan($signupVerification->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'That code has expired. Please request a new one.',
            ]);
        }

        if ($signupVerification->attempts >= 5) {
            return back()->withErrors([
                'otp' => 'Too many incorrect attempts. Please request a new code.',
            ]);
        }

        if (! $signupVerification->otpMatches($request->string('otp')->value())) {
            $signupVerification->increment('attempts');

            return back()->withErrors([
                'otp' => 'That code does not look right. Please try again.',
            ]);
        }

        $signupVerification->forceFill([
            'verified_at' => now(),
        ])->save();

        return $this->handleVerifiedPhone($signupVerification);
    }

    public function resendOtp(SignupVerification $signupVerification, Request $request, DhiraaguSmsClient $smsClient): RedirectResponse
    {
        $destination = $smsClient->normalizeDestination($signupVerification->phone);
        $rateLimitKey = 'auth-phone-resend:' . $request->ip() . ':' . $signupVerification->phone;

        if (! $destination) {
            return back()->withErrors([
                'otp' => 'This phone number is no longer valid for SMS delivery.',
            ]);
        }

        if (RateLimiter::tooManyAttempts($rateLimitKey, 2)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);

            return back()->withErrors([
                'otp' => "Please wait {$seconds} seconds before asking for a new code.",
            ]);
        }

        RateLimiter::hit($rateLimitKey, 60);

        $otp = (string) random_int(100000, 999999);
        $signupVerification->markOtp($otp);

        $result = $smsClient->send([
            $destination,
        ], "Your EasyFix verification code is {$otp}. It expires in 10 minutes.");

        if (! $result['ok']) {
            return back()->withErrors([
                'otp' => 'We could not resend the verification code right now.',
            ]);
        }

        return back()->with('status', 'A fresh verification code is on its way.');
    }

    public function showComplete(SignupVerification $signupVerification): RedirectResponse|View
    {
        if (! $signupVerification->verified_at) {
            return redirect()->route('register.verify', $signupVerification);
        }

        if (User::query()->where('phone', $signupVerification->phone)->exists()) {
            return $this->handleVerifiedPhone($signupVerification);
        }

        return view('auth.register', [
            'signupVerification' => $signupVerification,
        ]);
    }

    public function complete(SignupVerification $signupVerification, Request $request): RedirectResponse
    {
        if (! $signupVerification->verified_at) {
            return redirect()->route('register.verify', $signupVerification);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9_]+$/', 'unique:' . User::class . ',username'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email'],
            'address_type' => ['required', 'string', 'in:home,work,other'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $signupVerification->forceFill([
            'name' => $request->string('name')->value(),
            'username' => $request->string('username')->lower()->value(),
            'email' => $request->filled('email') ? $request->string('email')->lower()->value() : null,
            'address_type' => $request->string('address_type')->value(),
            'address_line1' => $request->string('address_line1')->value(),
            'address_line2' => $request->string('address_line2')->value() ?: null,
            'password' => Hash::make($request->string('password')->value()),
        ])->save();

        $user = User::create([
            'name' => $signupVerification->name,
            'username' => $signupVerification->username,
            'email' => $signupVerification->email,
            'phone' => $signupVerification->phone,
            'phone_verified_at' => now(),
            'address_type' => $signupVerification->address_type,
            'address_line1' => $signupVerification->address_line1,
            'address_line2' => $signupVerification->address_line2,
            'password' => $signupVerification->password,
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $address = $signupVerification->address_line1;
        if ($signupVerification->address_line2) {
            $address .= ', ' . $signupVerification->address_line2;
        }

        $user->addresses()->create([
            'label' => $signupVerification->address_type,
            'address' => $address,
            'is_default' => true,
        ]);

        $this->linkGuestJobsToUser($user);

        event(new Registered($user));

        Auth::login($user);
        $signupVerification->delete();

        return redirect(route('dashboard', absolute: false));
    }

    protected function handleVerifiedPhone(SignupVerification $signupVerification): RedirectResponse
    {
        $user = User::query()->where('phone', $signupVerification->phone)->first();

        if ($user) {
            $user->forceFill([
                'phone_verified_at' => $user->phone_verified_at ?: now(),
                'email_verified_at' => $user->email_verified_at ?: now(),
            ])->save();

            Auth::login($user);
            $signupVerification->delete();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->route('register.complete', $signupVerification);
    }

    protected function normalizeLocalPhone(string $phone, DhiraaguSmsClient $smsClient): ?string
    {
        $destination = $smsClient->normalizeDestination($phone);

        if (! $destination) {
            return null;
        }

        return substr($destination, -7);
    }

    /**
     * Link guest job requests to the newly registered user.
     */
    protected function linkGuestJobsToUser(User $user): void
    {
        // Find guest jobs by email or phone that don't have a customer_id yet
        JobRequest::whereNull('customer_id')
            ->where(function ($query) use ($user) {
                if ($user->email) {
                    $query->where('guest_email', $user->email)
                        ->orWhere('guest_phone', $user->phone);
                } else {
                    $query->where('guest_phone', $user->phone);
                }
            })
            ->update(['customer_id' => $user->id]);
    }
}
