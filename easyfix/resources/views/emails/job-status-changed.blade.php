<x-email-layout subject="Job #{{ $job->id }} - {{ $status->label() }}">
    <h2 style="margin: 0 0 16px; color: #111827; font-size: 20px; font-weight: 600;">
        Your job status has been updated
    </h2>

    <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
        Hi {{ $job->contact_name }}, here's an update on your job request <strong>#{{ $job->id }}</strong>.
    </p>

    {{-- Status Badge --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 24px;">
        <tr>
            <td style="padding: 16px; background-color: #f0f9ff; border-radius: 6px; border: 1px solid #bae6fd; text-align: center;">
                <p style="margin: 0 0 4px; color: #6b7280; font-size: 13px;">Current Status</p>
                @php
                    $badgeColor = match($status) {
                        App\Enums\JobStatus::Quoted => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                        App\Enums\JobStatus::Approved => ['bg' => '#dcfce7', 'text' => '#166534'],
                        App\Enums\JobStatus::Assigned => ['bg' => '#fef3c7', 'text' => '#92400e'],
                        App\Enums\JobStatus::EnRoute => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                        App\Enums\JobStatus::InProgress => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                        App\Enums\JobStatus::Completed => ['bg' => '#dcfce7', 'text' => '#166534'],
                        App\Enums\JobStatus::Cancelled => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                        default => ['bg' => '#e5e7eb', 'text' => '#374151'],
                    };
                @endphp
                <span style="display: inline-block; padding: 6px 16px; background-color: {{ $badgeColor['bg'] }}; color: {{ $badgeColor['text'] }}; border-radius: 9999px; font-size: 14px; font-weight: 700;">
                    {{ $status->label() }}
                </span>
            </td>
        </tr>
    </table>

    {{-- Contextual message per status --}}
    @switch($status)
        @case(App\Enums\JobStatus::Quoted)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                We've prepared a quote for your job. Please review it and let us know if you'd like to proceed.
            </p>
            @break
        @case(App\Enums\JobStatus::Approved)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                Your quote has been approved. We'll assign a service provider shortly.
            </p>
            @break
        @case(App\Enums\JobStatus::Assigned)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                A service provider has been assigned to your job and will be in touch soon.
            </p>
            @break
        @case(App\Enums\JobStatus::EnRoute)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                Your service provider is on their way to your location.
            </p>
            @break
        @case(App\Enums\JobStatus::InProgress)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                Work on your job is now in progress. We'll notify you once it's completed.
            </p>
            @break
        @case(App\Enums\JobStatus::Completed)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                Your job has been completed. Thank you for choosing EasyFix!
            </p>
            @break
        @case(App\Enums\JobStatus::Cancelled)
            <p style="margin: 0 0 24px; color: #374151; font-size: 15px; line-height: 1.6;">
                This job has been cancelled. If you have any questions, please don't hesitate to reach out.
            </p>
            @break
    @endswitch

    @if($note)
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 24px;">
            <tr>
                <td style="padding: 12px 16px; background-color: #f9fafb; border-radius: 6px; border: 1px solid #e5e7eb;">
                    <p style="margin: 0 0 4px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Note</p>
                    <p style="margin: 0; color: #374151; font-size: 14px; line-height: 1.5;">{{ $note }}</p>
                </td>
            </tr>
        </table>
    @endif

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
