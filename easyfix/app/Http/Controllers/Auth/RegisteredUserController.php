<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:30'],
            'address_type' => ['required', 'string', 'in:home,work,other'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_type' => $request->address_type,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        $address = $request->address_line1;
        if ($request->filled('address_line2')) {
            $address .= ', ' . $request->address_line2;
        }

        $user->addresses()->create([
            'label' => $request->address_type,
            'address' => $address,
            'is_default' => true,
        ]);

        // Link any existing guest job requests to this user (by email or phone)
        $this->linkGuestJobsToUser($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Link guest job requests to the newly registered user.
     */
    protected function linkGuestJobsToUser(User $user): void
    {
        // Find guest jobs by email or phone that don't have a customer_id yet
        JobRequest::whereNull('customer_id')
            ->where(function ($query) use ($user) {
                $query->where('guest_email', $user->email)
                    ->orWhere('guest_phone', $user->phone);
            })
            ->update(['customer_id' => $user->id]);
    }
}
