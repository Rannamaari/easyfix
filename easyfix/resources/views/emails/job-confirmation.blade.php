<x-email-layout subject="Job Request Confirmed - #{{ $job->id }}">
    <h2 style="margin: 0 0 16px; color: #111827; font-size: 20px; font-weight: 600;">
        Your job request has been submitted
    </h2>

    <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
        Hi {{ $job->contact_name }}, we've received your request and our team will review it shortly.
    </p>

    {{-- Job Details Table --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 24px; border: 1px solid #e5e7eb; border-radius: 6px; overflow: hidden;">
        <tr>
            <td style="background-color: #f9fafb; padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
                <strong style="color: #111827; font-size: 14px;">Job Details</strong>
            </td>
        </tr>
        <tr>
            <td style="padding: 0;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px; width: 120px;">Reference</td>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 13px; font-weight: 600;">#{{ $job->id }}</td>
                    </tr>
                    @if($job->category)
                    <tr>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Category</td>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 13px;">{{ $job->category->name }}</td>
                    </tr>
                    @endif
                    @if($job->service)
                    <tr>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Service</td>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 13px;">{{ $job->service->name }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Address</td>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 13px;">{{ $job->address }}</td>
                    </tr>
                    @if($job->preferred_time)
                    <tr>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 13px;">Preferred Time</td>
                        <td style="padding: 10px 16px; border-bottom: 1px solid #f3f4f6; color: #111827; font-size: 13px;">{{ $job->preferred_time->format('M d, Y g:i A') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 10px 16px; color: #6b7280; font-size: 13px;">Status</td>
                        <td style="padding: 10px 16px; color: #111827; font-size: 13px;">
                            <span style="display: inline-block; padding: 2px 10px; background-color: #e5e7eb; color: #374151; border-radius: 9999px; font-size: 12px; font-weight: 600;">
                                {{ $job->status->label() }}
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="margin: 0 0 8px; color: #374151; font-size: 15px; font-weight: 600;">
        What happens next?
    </p>

    <ol style="margin: 0 0 24px; padding-left: 20px; color: #374151; font-size: 14px; line-height: 1.8;">
        <li>Our team reviews your request</li>
        <li>We'll send you a quote for approval</li>
        <li>Once approved, a provider will be assigned</li>
    </ol>

    @if($job->isGuest() && $job->tracking_url)
        <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 0 24px;">
            <tr>
                <td style="background-color: #2563EB; border-radius: 6px;">
                    <a href="{{ $job->tracking_url }}" style="display: inline-block; padding: 12px 24px; color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none;">
                        Track Your Request
                    </a>
                </td>
            </tr>
        </table>
    @elseif($job->isRegistered())
        <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 0 24px;">
            <tr>
                <td style="background-color: #2563EB; border-radius: 6px;">
                    <a href="{{ url('/jobs/' . $job->id) }}" style="display: inline-block; padding: 12px 24px; color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none;">
                        View Your Job
                    </a>
                </td>
            </tr>
        </table>
    @endif

    <p style="margin: 0; color: #6b7280; font-size: 13px;">
        If you have any questions, contact us at hello@easyfix.mv.
    </p>
</x-email-layout>
