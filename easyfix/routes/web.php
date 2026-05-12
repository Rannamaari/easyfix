<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomerJobController;
use App\Http\Controllers\GuestJobController;
use App\Http\Controllers\JobAttachmentController;
use App\Http\Controllers\JobCommunicationController;
use App\Http\Controllers\ProfessionalApplicationController;
use App\Http\Controllers\QuotePdfController;
use App\Http\Controllers\ProfileAddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestPosts = \App\Models\BlogPost::published()->ordered()->take(1)->get();
    return view('welcome', compact('latestPosts'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/faq', function () {
    $faqItems = [
        [
            'question' => 'Do you provide plumbing services in Hulhumalé?',
            'answer' => 'Yes, we provide plumbing, electrical, AC repair, appliance repair, and handyman services in Hulhumalé Phase 1 and Phase 2, as well as Malé City and Villingili. A minimum MVR 350 site visit / service charge applies before arranging a technician visit. If the issue is small and can be fixed quickly without extra parts or major work, it may be completed within this charge.',
        ],
        [
            'question' => 'What is the cost of AC repair in Malé?',
            'answer' => 'AC repair costs depend on the issue. We can provide a basic estimate by phone or WhatsApp, but an accurate price may require a technician to inspect the AC. A minimum MVR 350 site visit / diagnosis charge applies. After inspection, we will provide a clear quotation before starting any additional repair work. Extra parts, gas refill, major repairs, or additional labour will be quoted separately.',
        ],
        [
            'question' => 'Do you work on Fridays and weekends?',
            'answer' => 'For the time being, we are closed on Fridays. On Saturdays, we are available from 2 PM to 10 PM. On other working days, we are available from 8 AM to 10 PM. For urgent requests, please contact us on WhatsApp. Urgent visits may be charged MVR 500, plus any additional repair, parts, or service charges if required.',
        ],
        [
            'question' => 'Can I book a handyman for small jobs?',
            'answer' => 'Yes. We handle small and quick fixes such as door handles, leaky taps, electrical switches, wall mounting, furniture assembly, and other handyman work. A minimum MVR 350 site visit / service charge applies. If the job is small and does not require extra parts or major work, we may complete it within this charge.',
        ],
        [
            'question' => 'Is the MVR 350 a diagnosis fee or service charge?',
            'answer' => 'The MVR 350 is our minimum site visit / service charge. It covers the technician’s visit and diagnosis. If the issue is small and can be fixed quickly without extra parts or major work, we may complete it within this charge.',
        ],
        [
            'question' => 'Do I have to pay before the technician comes?',
            'answer' => 'Yes. The minimum site visit / service charge must be paid before we arrange the technician visit. After payment, please share the payment slip via WhatsApp so we can confirm and schedule the visit.',
        ],
        [
            'question' => 'Will I be charged more than MVR 350?',
            'answer' => 'Only if the job requires extra parts, materials, additional labour, transport, or more time. We will explain the cost and get your approval before starting additional work.',
        ],
        [
            'question' => 'What if spare parts or materials are needed?',
            'answer' => 'Spare parts, materials, fittings, accessories, or replacement items are charged separately. We will inform you of the cost before proceeding.',
        ],
        [
            'question' => 'How do I confirm my booking?',
            'answer' => 'After submitting your request, please transfer the site visit / service charge and share the payment slip via WhatsApp. Once payment is confirmed, we will arrange the technician visit.',
        ],
        [
            'question' => 'What is the charge for urgent site visits?',
            'answer' => 'Urgent site visits are charged at MVR 500. This is for priority attendance. Additional repair work, parts, or materials may be quoted separately if required.',
        ],
        [
            'question' => 'Is the urgent charge the final repair cost?',
            'answer' => 'Not always. The urgent charge covers priority visit and diagnosis. If the job is small and can be fixed quickly without extra parts or major work, it may be completed within this charge. Otherwise, extra work will be quoted separately.',
        ],
        [
            'question' => 'Will EasyFix start work without my approval?',
            'answer' => 'No. If extra work, parts, materials, or additional labour is required, we will explain the cost first and proceed only after your approval.',
        ],
        [
            'question' => 'Are there any hidden charges?',
            'answer' => 'No. We try to keep pricing clear and simple. Any extra charges will be explained before work begins.',
        ],
        [
            'question' => 'What if I cancel after making payment?',
            'answer' => 'If the technician has not yet been assigned or dispatched, please contact us as soon as possible. Cancellation or rescheduling will be handled based on the status of the booking.',
        ],
        [
            'question' => 'Can I reschedule my site visit?',
            'answer' => 'Yes, you can request to reschedule. Please inform us early so we can adjust the technician’s schedule.',
        ],
        [
            'question' => 'Does the MVR 350 guarantee the issue will be repaired?',
            'answer' => 'No. The MVR 350 covers the site visit and diagnosis. Small issues may be fixed within this amount, but repairs that require parts, extra labour, or more time will be quoted separately.',
        ],
    ];

    return view('faq', compact('faqItems'));
})->name('faq');

Route::prefix('professionals')->name('professionals.')->group(function () {
    Route::get('/apply', [ProfessionalApplicationController::class, 'create'])->name('create');
    Route::post('/apply', [ProfessionalApplicationController::class, 'store'])->name('store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/quotes/{quote}/pdf', [QuotePdfController::class, 'show'])->name('quotes.pdf');

    Route::post('/profile/addresses', [ProfileAddressController::class, 'store'])->name('profile.addresses.store');
    Route::patch('/profile/addresses/{address}/default', [ProfileAddressController::class, 'setDefault'])->name('profile.addresses.default');
    Route::delete('/profile/addresses/{address}', [ProfileAddressController::class, 'destroy'])->name('profile.addresses.destroy');
});

// Customer routes (authenticated)
Route::middleware(['auth', 'verified'])->prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', [CustomerJobController::class, 'index'])->name('index');
    Route::get('/request', [CustomerJobController::class, 'create'])->name('create');
    Route::post('/request', [CustomerJobController::class, 'store'])->name('store')->middleware('throttle:request-store');
    Route::get('/{jobRequest}', [CustomerJobController::class, 'show'])->name('show');
    Route::post('/{jobRequest}/approve-quote', [CustomerJobController::class, 'approveQuote'])->name('approve-quote');
    Route::post('/{jobRequest}/reject-quote', [CustomerJobController::class, 'rejectQuote'])->name('reject-quote');
    Route::post('/{jobRequest}/messages', [JobCommunicationController::class, 'storeMessage'])->name('messages.store');
    Route::post('/{jobRequest}/update-requests', [JobCommunicationController::class, 'requestUpdate'])->name('update-requests.store');
    Route::post('/{jobRequest}/update-requests/{updateRequest}/respond', [JobCommunicationController::class, 'respondUpdate'])->name('update-requests.respond');
    Route::patch('/{jobRequest}/messages/{messageId}', [JobCommunicationController::class, 'updateMessage'])->name('messages.update');
});

// Provider routes (authenticated + provider role)
Route::middleware(['auth', 'verified'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/', [ProviderJobController::class, 'index'])->name('index');
    Route::get('/jobs/{jobRequest}', [ProviderJobController::class, 'show'])->name('show');
    Route::post('/jobs/{jobRequest}/en-route', [ProviderJobController::class, 'markEnRoute'])->name('en-route');
    Route::post('/jobs/{jobRequest}/in-progress', [ProviderJobController::class, 'markInProgress'])->name('in-progress');
    Route::post('/jobs/{jobRequest}/complete', [ProviderJobController::class, 'markComplete'])->name('complete');
    Route::post('/jobs/{jobRequest}/upload-photo', [ProviderJobController::class, 'uploadPhoto'])->name('upload-photo');
    Route::post('/jobs/{jobRequest}/messages', [JobCommunicationController::class, 'storeMessage'])->name('jobs.messages.store');
    Route::post('/jobs/{jobRequest}/update-requests/{updateRequest}/respond', [JobCommunicationController::class, 'respondUpdate'])->name('jobs.update-requests.respond');
    Route::patch('/jobs/{jobRequest}/messages/{messageId}', [JobCommunicationController::class, 'updateMessage'])->name('jobs.messages.update');
});

// Guest routes (unauthenticated)
Route::prefix('request')->name('guest.')->group(function () {
    Route::get('/', [GuestJobController::class, 'create'])->name('create');
    Route::post('/', [GuestJobController::class, 'store'])->name('store')->middleware('throttle:request-store');
    Route::get('/register', [GuestJobController::class, 'showRegister'])->name('register');
    Route::post('/register', [GuestJobController::class, 'storeRegister'])->name('register.store');
});

Route::prefix('track')->name('track.')->group(function () {
    Route::get('/{token}', [GuestJobController::class, 'show'])->name('show');
    Route::post('/{token}/approve-quote', [GuestJobController::class, 'approveQuote'])->name('approve-quote');
    Route::post('/{token}/reject-quote', [GuestJobController::class, 'rejectQuote'])->name('reject-quote');
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/attachments/{attachment}', [JobAttachmentController::class, 'show'])
    ->middleware('signed')
    ->name('attachments.show');

require __DIR__.'/auth.php';
