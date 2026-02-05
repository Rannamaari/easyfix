<?php

namespace App\Http\Controllers;

use App\Models\JobQuote;
use Illuminate\Http\Request;

class QuotePdfController extends Controller
{
    public function show(Request $request, JobQuote $quote)
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            abort(403);
        }

        $quote->load(['jobRequest.customer', 'jobRequest.category', 'items']);

        $data = [
            'quote' => $quote,
            'job' => $quote->jobRequest,
        ];

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            return \Barryvdh\DomPDF\Facade\Pdf::loadView('quotes.pdf', $data)
                ->stream("quote-{$quote->id}.pdf");
        }

        return view('quotes.pdf', $data);
    }
}
