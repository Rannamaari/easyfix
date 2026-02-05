<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileAddressController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'label' => ['required', 'in:home,work,other'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $user = $request->user();

        $isFirst = $user->addresses()->count() === 0;
        $user->addresses()->create([
            'label' => $data['label'],
            'address' => $data['address'],
            'is_default' => $isFirst,
        ]);

        return back()->with('status', 'address-added');
    }

    public function setDefault(Request $request, UserAddress $address): RedirectResponse
    {
        $user = $request->user();

        if ($address->user_id !== $user->id) {
            abort(403);
        }

        $user->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return back()->with('status', 'address-default-updated');
    }

    public function destroy(Request $request, UserAddress $address): RedirectResponse
    {
        $user = $request->user();

        if ($address->user_id !== $user->id) {
            abort(403);
        }

        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $next = $user->addresses()->oldest()->first();
            if ($next) {
                $next->update(['is_default' => true]);
            }
        }

        return back()->with('status', 'address-removed');
    }
}
