<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessionalApplicationRequest;
use App\Models\ProfessionalApplication;
use Illuminate\Http\RedirectResponse;

class ProfessionalApplicationController extends Controller
{
    public function create()
    {
        return view('professionals.create');
    }

    public function store(StoreProfessionalApplicationRequest $request): RedirectResponse
    {
        ProfessionalApplication::create([
            'phone' => $request->string('phone'),
        ]);

        return redirect()
            ->route('professionals.create')
            ->with('status', 'Thanks! We received your number and will contact you shortly.');
    }
}
