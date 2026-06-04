<?php

namespace App\Providers;

use App\Listeners\SendTelegramNewUserNotification;
use App\Models\JobQuote;
use App\Models\JobRequest;
use App\Models\Payment;
use App\Models\User;
use App\Observers\JobQuoteObserver;
use App\Observers\JobRequestObserver;
use App\Observers\PaymentObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('request-store', function (Request $request) {
            return Limit::perHour(10)->by($request->ip());
        });

        RateLimiter::for('auth-phone-start', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip());
        });

        RateLimiter::for('auth-phone-verify', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        Event::listen(Registered::class, SendTelegramNewUserNotification::class);
        User::observe(UserObserver::class);
        JobRequest::observe(JobRequestObserver::class);
        JobQuote::observe(JobQuoteObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
