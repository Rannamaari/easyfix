<x-email-layout subject="Verify Your Email - EasyFix">
    <h2 style="margin: 0 0 16px; color: #111827; font-size: 20px; font-weight: 600;">
        Welcome to EasyFix, {{ $user->name }}!
    </h2>

    <p style="margin: 0 0 16px; color: #374151; font-size: 15px; line-height: 1.6;">
        Thank you for creating your account. Please verify your email address to get started.
    </p>

    <p style="margin: 0 0 8px; color: #374151; font-size: 15px; font-weight: 600;">
        Here's what you can do once verified:
    </p>

    <ul style="margin: 0 0 24px; padding-left: 20px; color: #374151; font-size: 15px; line-height: 1.8;">
        <li>Submit repair and maintenance requests</li>
        <li>Track your jobs in real time</li>
        <li>Receive and approve quotes</li>
        <li>Manage your addresses and profile</li>
    </ul>

    <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 0 16px;">
        <tr>
            <td style="background-color: #2563EB; border-radius: 6px;">
                <a href="{{ $verificationUrl }}" style="display: inline-block; padding: 12px 24px; color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none;">
                    Verify Your Email
                </a>
            </td>
        </tr>
    </table>

    <p style="margin: 0 0 16px; color: #6b7280; font-size: 13px;">
        This verification link will expire in 60 minutes. If you did not create an account, no further action is required.
    </p>

    <p style="margin: 0; color: #6b7280; font-size: 13px;">
        If you have any questions, just reply to this email or contact us at hello@easyfix.mv.
    </p>
</x-email-layout>
