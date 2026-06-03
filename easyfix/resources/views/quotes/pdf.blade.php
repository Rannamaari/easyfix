<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $quote->status === 'approved' ? 'EasyFix Invoice' : 'EasyFix Quotation' }}</title>
        <style>
            body {
                font-family: DejaVu Sans, Arial, sans-serif;
                color: #0f172a;
                font-size: 12px;
            }
            .header {
                border-bottom: 1px solid #e2e8f0;
                padding-bottom: 12px;
                margin-bottom: 20px;
            }
            .header table,
            .company table {
                width: 100%;
            }
            .logo {
                font-size: 20px;
                font-weight: 700;
                color: #1d4ed8;
            }
            .company-name {
                font-size: 14px;
                font-weight: 700;
            }
            .badge {
                display: inline-block;
                padding: 4px 10px;
                border-radius: 999px;
                background: #e0f2fe;
                color: #0369a1;
                font-weight: 600;
                font-size: 11px;
            }
            .section {
                margin-bottom: 16px;
            }
            .muted {
                color: #64748b;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                text-align: left;
                padding: 8px;
                border-bottom: 1px solid #e2e8f0;
            }
            th {
                background: #f8fafc;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.04em;
                color: #475569;
            }
            .totals td {
                border: none;
                padding: 4px 8px;
            }
            .right {
                text-align: right;
            }
            .company {
                margin-bottom: 18px;
            }
            .company td {
                vertical-align: top;
                border: none;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <table>
                <tr>
                    <td>
                        <div class="logo">EasyFix by Micronet</div>
                        <div class="muted">{{ $quote->status === 'approved' ? 'Invoice' : 'Quotation' }}</div>
                    </td>
                    <td class="right">
                        <div class="badge">{{ $quote->status === 'approved' ? 'Approved' : 'Quotation' }}</div>
                        @if($quote->status === 'approved' && $quote->invoice_number)
                            <div class="muted" style="margin-top: 6px;">Invoice #{{ $quote->invoice_number }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="company">
            <table>
                <tr>
                    <td style="width: 60%;">
                        <div class="company-name">Micronet</div>
                        <div class="muted">M. Ithaamuiyge, 10th Floor, Alimasmagu</div>
                        <div class="muted">EasyFix by Micronet</div>
                        <div class="muted">hello@micronet.mv</div>
                        <div class="muted">7779493</div>
                    </td>
                    <td class="right">
                        <div class="muted">Issued: {{ $quote->created_at->format('M d, Y') }}</div>
                        @if($quote->status === 'approved' && $quote->approved_at)
                            <div class="muted">Approved: {{ $quote->approved_at->format('M d, Y') }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <strong>Customer:</strong> {{ $job->customer?->name ?? 'Guest' }}<br>
            <span class="muted">Job #{{ $job->id }} • {{ $job->category?->name }}</span>
        </div>

        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quote->items as $item)
                        <tr>
                            <td>{{ $item->description }}</td>
                            <td class="right">MVR {{ number_format($item->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <table class="totals">
                <tr>
                    <td class="right muted">Subtotal</td>
                    <td class="right">MVR {{ number_format($quote->subtotal ?? $quote->amount, 2) }}</td>
                </tr>
                @if($quote->tax_enabled)
                    <tr>
                        <td class="right muted">Tax ({{ number_format($quote->tax_rate ?? 8, 2) }}%)</td>
                        <td class="right">MVR {{ number_format($quote->tax_amount ?? 0, 2) }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right"><strong>MVR {{ number_format($quote->total ?? $quote->amount, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        @if($quote->notes)
            <div class="section">
                <strong>Notes:</strong><br>
                <span class="muted">{{ $quote->notes }}</span>
            </div>
        @endif
    </body>
</html>
