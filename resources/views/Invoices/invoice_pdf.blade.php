<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('invoice.invoice') }} {{ $invoice->code }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        .header { margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .company-info { width: 50%; float: left; }
        .company-logo { max-width: 150px; margin-bottom: 10px; }
        .invoice-info { width: 50%; float: right; text-align: right; }
        .clearfix { clear: both; }
        .customer-info { margin: 20px 0; padding: 10px; background: #f5f5f5; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4a5568; color: white; }
        .text-right { text-align: right; }
        .totals { width: 300px; margin-left: auto; margin-top: 20px; }
        .totals table { width: 100%; }
        .totals td { padding: 5px; }
        .grand-total { font-size: 14px; font-weight: bold; border-top: 2px solid #000; }
        .footer { margin-top: 50px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; }
        .bank-info { margin-top: 30px; padding: 10px; background: #f9f9f9; }
        .status-badge { 
            padding: 3px 8px; 
            border-radius: 3px; 
            font-weight: bold;
        }
        .status-paid { background-color: #48bb78; color: white; }
        .status-pending { background-color: #ed8936; color: white; }
        .status-draft { background-color: #cbd5e0; color: #2d3748; }
        .status-overdue { background-color: #f56565; color: white; }
    </style>
</head>
<body>
    @php
        $company = App\Models\CompanySetting::current();
    @endphp

    <div class="header">
        <div class="company-info">
            @if($company->logo)
                <img src="{{ public_path('storage/' . $company->logo) }}" class="company-logo" alt="Logo">
            @endif
            <h2 style="margin: 0;">{{ $company->company_name }}</h2>
            <p style="margin: 5px 0;">
                {{ $company->address }}<br>
                {{ $company->city }}, {{ $company->province }} {{ $company->postal_code }}<br>
                {{ $company->country }}
            </p>
            <p style="margin: 5px 0;">
                <strong>{{ __('invoice.phone') }}:</strong> {{ $company->phone }}<br>
                <strong>{{ __('invoice.email') }}:</strong> {{ $company->email }}<br>
                @if($company->website)
                    <strong>{{ __('invoice.website') }}:</strong> {{ $company->website }}<br>
                @endif
                <strong>NPWP:</strong> {{ $company->npwp }}
            </p>
        </div>
        <div class="invoice-info">
            <h1 style="margin: 0;">{{ __('invoice.title') }}</h1>
            <p style="margin: 10px 0;">
                <strong>{{ __('invoice.invoice_number') }}:</strong> {{ $invoice->code }}<br>
                <strong>{{ __('invoice.date') }}:</strong> {{ $invoice->created_at->format('d M Y') }}<br>
                @if($invoice->due_date)
                    <strong>{{ __('invoice.due_date') }}:</strong> {{ $invoice->due_date->format('d M Y') }}<br>
                @endif
                <strong>{{ __('invoice.status') }}:</strong> 
                <span class="status-badge status-{{ $invoice->status }}">
                    {{ strtoupper(__('invoice.' . $invoice->status)) }}
                </span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="customer-info">
        <h3 style="margin: 0 0 10px 0;">{{ __('invoice.bill_to') }}:</h3>
        <p style="margin: 0;">
            <strong>{{ $invoice->customer->name }}</strong><br>
            {{ $invoice->customer->email }}<br>
            {{ $invoice->customer->phone }}<br>
            {{ $invoice->customer->address }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50%">{{ __('invoice.product') }}</th>
                <th class="text-right" style="width: 15%">{{ __('invoice.unit_price') }}</th>
                <th class="text-right" style="width: 10%">{{ __('invoice.qty') }}</th>
                <th class="text-right" style="width: 25%">{{ __('invoice.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td><strong>{{ __('invoice.subtotal') }}:</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($invoice->discount_percent > 0)
            <tr>
                <td><strong>{{ __('invoice.discount') }} ({{ number_format($invoice->discount_percent, 2) }}%):</strong></td>
                <td class="text-right">- Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>{{ __('invoice.subtotal_after_discount') }}:</strong></td>
                <td class="text-right">Rp {{ number_format($invoice->subtotal_after_discount, 0, ',', '.') }}</td>
            </tr>
            @endif
            @if($invoice->tax_rate > 0)
            <tr>
                <td><strong>{{ __('invoice.tax') }} ({{ number_format($invoice->tax_rate, 2) }}%):</strong></td>
                <td class="text-right">+ Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
            <tr class="grand-total">
                <td><strong>{{ __('invoice.grand_total') }}:</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    @if($invoice->notes)
    <div style="margin-top: 20px;">
        <strong>{{ __('invoice.notes') }}:</strong>
        <p>{{ $invoice->notes }}</p>
    </div>
    @endif

    <div class="bank-info">
        <h4 style="margin: 0 0 10px 0;">{{ __('invoice.payment_info') }}</h4>
        <p style="margin: 0;">
            <strong>{{ __('invoice.bank_name') }}:</strong> {{ $company->bank_name }}<br>
            <strong>{{ __('invoice.account_number') }}:</strong> {{ $company->account_number }}<br>
            <strong>{{ __('invoice.account_holder') }}:</strong> {{ $company->account_holder_name }}
        </p>
    </div>

    <div class="footer">
        <p style="text-align: center; margin: 0;">
            {{ __('invoice.thank_you') }}<br>
            {{ __('invoice.no_signature') }}
        </p>
    </div>
</body>
</html>