<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>EasyFix Quote</title>
        <style>
            body {
                font-family: DejaVu Sans, Arial, sans-serif;
                color: #0f172a;
                font-size: 12px;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #e2e8f0;
                padding-bottom: 12px;
                margin-bottom: 20px;
            }
            .logo {
                font-size: 18px;
                font-weight: 700;
                color: #1d4ed8;
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
        </style>
    </head>
    <body>
        <div class="header">
            <div>
                <div class="logo">EasyFix</div>
                <div class="muted">Quote Summary</div>
            </div>
            <div class="right">
                <div class="badge">{{ ucfirst($quote->status) }}</div>
                <div class="muted">Quote #{{ $quote->id }}</div>
                @if($quote->invoice_number)
                    <div class="muted">Invoice #{{ $quote->invoice_number }}</div>
                @endif
            </div>
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
