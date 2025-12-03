<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('invoice.invoice') }} {{ $invoice->code }}</title>
    <style>
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        @page {
            margin: 10mm;
        }
        
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            margin: 0;
            padding: 0;
            background: white;
            color: #1F2937;
            font-size: 9pt;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
        }
        
        /* Header dengan Warna Solid - Ungu */
        .invoice-header {
            background-color: #7C3AED;
            color: white;
            padding: 20px 25px;
            position: relative;
        }
        
        .header-content {
            width: 100%;
        }
        
        .header-left {
            width: 48%;
            float: left;
        }
        
        .header-right {
            width: 48%;
            float: right;
            text-align: right;
        }
        
        .invoice-title {
            margin: 0;
            font-size: 28pt;
            font-weight: bold;
            letter-spacing: 1px;
            color: white;
        }
        
        .invoice-number {
            background-color: rgba(255, 255, 255, 0.25);
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 9pt;
            margin-top: 8px;
            color: white;
        }
        
        .date-section {
            text-align: right;
        }
        
        .date-label {
            font-size: 8.5pt;
            margin: 0 0 4px 0;
            color: white;
        }
        
        .date-big {
            font-size: 40pt;
            font-weight: bold;
            line-height: 1;
            margin: 0;
            color: white;
        }
        
        .date-month {
            font-size: 10pt;
            margin: 2px 0 0 0;
            color: white;
        }
        
        .clearfix {
            clear: both;
        }
        
        /* Company Info */
        .company-section {
            padding: 15px 25px;
            background-color: #F3F4F6;
            border-bottom: 2px solid #E5E7EB;
        }
        
        .company-logo {
            max-width: 120px;
            margin-bottom: 10px;
        }
        
        .company-name {
            font-size: 12pt;
            font-weight: bold;
            margin: 0 0 8px 0;
            color: #111827;
        }
        
        .company-detail {
            font-size: 8.5pt;
            margin: 3px 0;
            color: #4B5563;
        }
        
        /* Bill To Section */
        .bill-to-section {
            background-color: #EFF6FF;
            padding: 18px 25px;
            margin-top: 0;
            border-left: 4px solid #3B82F6;
        }
        
        .bill-to-title {
            margin: 0 0 10px 0;
            font-size: 10pt;
            font-weight: bold;
            color: #1E40AF;
        }
        
        .customer-name {
            font-weight: bold;
            font-size: 12pt;
            margin: 0 0 10px 0;
            color: #111827;
        }
        
        .customer-info {
            margin: 5px 0;
            font-size: 9pt;
            color: #374151;
        }
        
        /* Status and Date Info - Side by Side */
        .info-container {
            width: 100%;
            padding: 15px 25px;
            background-color: white;
        }
        
        .info-left-col {
            width: 48%;
            float: left;
        }
        
        .info-right-col {
            width: 48%;
            float: right;
        }
        
        .status-box {
            background-color: #F0FDF4;
            border: 2px solid #86EFAC;
            border-radius: 6px;
            padding: 14px;
        }
        
        .status-row {
            margin: 10px 0;
            font-size: 9pt;
        }
        
        .status-label {
            display: block;
            color: #4B5563;
            font-size: 8pt;
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            font-weight: bold;
            font-size: 8pt;
            border-radius: 4px;
            text-transform: uppercase;
        }
        
        .status-paid {
            background-color: #D1FAE5;
            color: #065F46;
        }
        
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }
        
        .status-draft {
            background-color: #F3F4F6;
            color: #374151;
        }
        
        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }
        
        .status-done {
            background-color: #D1FAE5;
            color: #065F46;
        }
        
        .status-overdue {
            background-color: #FEE2E2;
            color: #991B1B;
        }
        
        /* Date Info Box */
        .date-box {
            background-color: #F9FAFB;
            border: 2px solid #E5E7EB;
            border-radius: 6px;
            padding: 14px;
        }
        
        .date-info-row {
            margin: 10px 0;
            font-size: 9pt;
        }
        
        .date-info-label {
            display: block;
            color: #6B7280;
            font-size: 8pt;
            margin-bottom: 4px;
        }
        
        .date-info-value {
            font-weight: bold;
            color: #111827;
            font-size: 9pt;
        }
        
        .date-overdue {
            color: #DC2626;
        }
        
        /* Items Section */
        .items-section {
            padding: 15px 25px;
        }
        
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            color: #1F2937;
            margin: 0 0 12px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #3B82F6;
        }
        
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .item-table thead {
            background-color: #DBEAFE;
        }
        
        .item-table th {
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #93C5FD;
            color: #1E40AF;
            font-size: 8pt;
            text-transform: uppercase;
        }
        
        .item-table td {
            padding: 10px 8px;
            border: 1px solid #E5E7EB;
            background-color: #FFFFFF;
            color: #1F2937;
            font-size: 9pt;
        }
        
        .item-table tbody tr:nth-child(odd) td {
            background-color: #F9FAFB;
        }
        
        .align-center {
            text-align: center;
        }
        
        .align-right {
            text-align: right;
        }
        
        /* Notes Section */
        .notes-section {
            padding: 0 25px 15px 25px;
        }
        
        .notes-box {
            background-color: #FFFBEB;
            border-left: 4px solid #F59E0B;
            padding: 14px;
            border-radius: 4px;
        }
        
        .notes-title {
            margin: 0 0 8px 0;
            font-size: 9.5pt;
            font-weight: bold;
            color: #92400E;
        }
        
        .notes-text {
            margin: 0;
            font-size: 9pt;
            color: #78350F;
        }
        
        /* Summary Section */
        .summary-section {
            padding: 0 25px 15px 25px;
        }
        
        .summary-box {
            background-color: #EFF6FF;
            border: 2px solid #93C5FD;
            border-radius: 6px;
            padding: 16px;
        }
        
        .summary-title {
            margin: 0 0 14px 0;
            font-size: 10pt;
            font-weight: bold;
            color: #1E40AF;
        }
        
        .summary-row {
            width: 100%;
            margin: 8px 0;
            font-size: 9pt;
        }
        
        .summary-label {
            float: left;
            color: #374151;
        }
        
        .summary-value {
            float: right;
            font-weight: bold;
            color: #111827;
        }
        
        .summary-discount .summary-value {
            color: #DC2626;
        }
        
        .summary-tax .summary-value {
            color: #059669;
        }
        
        .summary-total {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #1E40AF;
        }
        
        .summary-total .summary-label {
            font-weight: bold;
            font-size: 10pt;
            color: #111827;
        }
        
        .summary-total .summary-value {
            color: #059669;
            font-size: 13pt;
        }
        
        /* Bank Info */
        .bank-section {
            padding: 0 25px 15px 25px;
        }
        
        .bank-box {
            background-color: #DBEAFE;
            border: 2px solid #60A5FA;
            padding: 14px;
            border-radius: 4px;
        }
        
        .bank-title {
            margin: 0 0 10px 0;
            font-size: 9.5pt;
            font-weight: bold;
            color: #1E40AF;
        }
        
        .bank-detail {
            margin: 5px 0;
            font-size: 9pt;
            color: #1F2937;
        }
        
        .bank-detail strong {
            color: #1E40AF;
        }
        
        /* Payment Proof */
        .payment-section {
            padding: 0 25px 15px 25px;
        }
        
        .payment-box {
            background-color: #D1FAE5;
            border: 2px solid #6EE7B7;
            padding: 14px;
            border-radius: 4px;
        }
        
        .payment-title {
            margin: 0 0 10px 0;
            font-size: 9.5pt;
            font-weight: bold;
            color: #065F46;
        }
        
        .payment-box img {
            max-width: 200px;
            border: 2px solid #6EE7B7;
            border-radius: 4px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            font-size: 8pt;
            color: #6B7280;
            padding: 15px 25px;
            border-top: 2px solid #E5E7EB;
            margin-top: 15px;
        }
        
        .page-info {
            text-align: center;
            font-size: 7.5pt;
            color: #9CA3AF;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    @php
        $company = App\Models\CompanySetting::current();
    @endphp

    <div class="container">
        <!-- Header Section dengan Warna Ungu -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="header-left">
                    <h1 class="invoice-title">{{ __('invoice.title') }}</h1>
                    <div class="invoice-number">
                        {{ __('invoice.invoice_number') }}: {{ $invoice->code }}
                    </div>
                </div>
                <div class="header-right">
                    <div class="date-section">
                        <p class="date-label">{{ __('invoice.date') }}</p>
                        <p class="date-big">{{ str_pad($invoice->created_at->format('d'), 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="date-month">{{ $invoice->created_at->format('M Y') }}</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Company Info dengan Background Abu-abu -->
        <div class="company-section">
            @if($company->logo)
                <img src="{{ public_path('storage/' . $company->logo) }}" class="company-logo" alt="Logo">
            @endif
            <p class="company-name">{{ $company->company_name }}</p>
            <p class="company-detail">
                {{ $company->address }}, {{ $company->city }}, {{ $company->province }} {{ $company->postal_code }}, {{ $company->country }}
            </p>
            <p class="company-detail">
                {{ __('invoice.phone') }}: {{ $company->phone }} | {{ __('invoice.email') }}: {{ $company->email }}
                @if($company->website) | {{ __('invoice.website') }}: {{ $company->website }}@endif
            </p>
            @if($company->npwp)
            <p class="company-detail">NPWP: {{ $company->npwp }}</p>
            @endif
        </div>

        <!-- Bill To Section dengan Background Biru Muda -->
        <div class="bill-to-section">
            <p class="bill-to-title">{{ __('invoice.bill_to') }}</p>
            <p class="customer-name">{{ $invoice->customer->name }}</p>
            @if($invoice->customer->email)
            <p class="customer-info">{{ __('invoice.email') }}: {{ $invoice->customer->email }}</p>
            @endif
            @if($invoice->customer->phone)
            <p class="customer-info">{{ __('invoice.phone') }}: {{ $invoice->customer->phone }}</p>
            @endif
            @if($invoice->customer->address)
            <p class="customer-info">{{ __('invoice.address') }}: {{ $invoice->customer->address }}</p>
            @endif
        </div>

        <!-- Status and Date Info - Side by Side -->
        <div class="info-container">
            <!-- Left: Status dengan Background Hijau Muda -->
            <div class="info-left-col">
                <div class="status-box">
                    <div class="status-row">
                        <span class="status-label">{{ __('invoice.status') }}</span>
                        <span class="status-badge status-{{ $invoice->status }}">
                            {{ strtoupper(__('invoice.' . $invoice->status)) }}
                        </span>
                    </div>
                    @if(isset($invoice->paid_status))
                    <div class="status-row">
                        <span class="status-label">{{ __('invoice.payment_status') }}</span>
                        <span class="status-badge status-{{ $invoice->paid_status }}">
                            {{ strtoupper(__('invoice.' . $invoice->paid_status)) }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Right: Date Info dengan Background Abu-abu -->
            <div class="info-right-col">
                <div class="date-box">
                    @if($invoice->start_date)
                    <div class="date-info-row">
                        <span class="date-info-label">{{ __('invoice.start_date') }}</span>
                        <span class="date-info-value">{{ $invoice->start_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    @if($invoice->due_date)
                    <div class="date-info-row">
                        <span class="date-info-label">{{ __('invoice.due_date') }}</span>
                        <span class="date-info-value {{ $invoice->due_date->isPast() && $invoice->paid_status !== 'done' ? 'date-overdue' : '' }}">
                            {{ $invoice->due_date->format('d/m/Y') }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Items Section -->
        <div class="items-section">
            <p class="section-title">{{ __('invoice.items') }}</p>
            <table class="item-table">
                <thead>
                    <tr>
                        <th style="width: 8%;" class="align-center">{{ __('invoice.no') }}</th>
                        <th style="width: 40%;">{{ __('invoice.product') }}</th>
                        <th style="width: 12%;" class="align-center">{{ __('invoice.qty') }}</th>
                        <th style="width: 20%;" class="align-right">{{ __('invoice.unit_price') }}</th>
                        <th style="width: 20%;" class="align-right">{{ __('invoice.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $index => $item)
                    <tr>
                        <td class="align-center">{{ $index + 1 }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td class="align-center">{{ $item->quantity }}</td>
                        <td class="align-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td class="align-right"><strong>Rp {{ number_format($item->total, 0, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Notes dengan Background Kuning -->
        @if($invoice->notes)
        <div class="notes-section">
            <div class="notes-box">
                <p class="notes-title">{{ __('invoice.notes') }}</p>
                <p class="notes-text">{{ $invoice->notes }}</p>
            </div>
        </div>
        @endif

        <!-- Payment Summary dengan Background Biru Muda -->
        <div class="summary-section">
            <div class="summary-box">
                <p class="summary-title">{{ __('invoice.payment_summary') }}</p>
                
                <div class="summary-row">
                    <span class="summary-label">{{ __('invoice.subtotal') }}:</span>
                    <span class="summary-value">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</span>
                    <div class="clearfix"></div>
                </div>
                
                @if($invoice->discount_percent > 0)
                    <div class="summary-row">
                        <span class="summary-label">{{ __('invoice.discount') }} ({{ number_format($invoice->discount_percent, 2) }}%):</span>
                        <span class="summary-value">{{ number_format($invoice->discount_percent, 2) }}%</span>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="summary-row summary-discount">
                        <span class="summary-label">{{ __('invoice.discount_amount') }}:</span>
                        <span class="summary-value">- Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</span>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">{{ __('invoice.subtotal_after_discount') }}:</span>
                        <span class="summary-value">Rp {{ number_format($invoice->subtotal_after_discount, 0, ',', '.') }}</span>
                        <div class="clearfix"></div>
                    </div>
                @endif
                
                @if($invoice->tax_rate > 0)
                    <div class="summary-row">
                        <span class="summary-label">{{ __('invoice.tax') }} ({{ number_format($invoice->tax_rate, 2) }}%):</span>
                        <span class="summary-value">{{ number_format($invoice->tax_rate, 2) }}%</span>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="summary-row summary-tax">
                        <span class="summary-label">{{ __('invoice.tax_amount') }}:</span>
                        <span class="summary-value">+ Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</span>
                        <div class="clearfix"></div>
                    </div>
                @endif
                
                <div class="summary-row summary-total">
                    <span class="summary-label">{{ strtoupper(__('invoice.grand_total')) }}:</span>
                    <span class="summary-value">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!-- Bank Info dengan Background Biru -->
        <div class="bank-section">
            <div class="bank-box">
                <p class="bank-title">{{ __('invoice.payment_info') }}</p>
                <p class="bank-detail"><strong>{{ __('invoice.bank_name') }}:</strong> {{ $company->bank_name }}</p>
                <p class="bank-detail"><strong>{{ __('invoice.account_number') }}:</strong> {{ $company->account_number }}</p>
                <p class="bank-detail"><strong>{{ __('invoice.account_holder') }}:</strong> {{ $company->account_holder_name }}</p>
            </div>
        </div>

        <!-- Payment Proof dengan Background Hijau -->
        @if($invoice->payment_proof)
        <div class="payment-section">
            <div class="payment-box">
                <p class="payment-title">{{ __('invoice.payment_proof') }}</p>
                <img src="{{ public_path('storage/'.$invoice->payment_proof) }}" alt="{{ __('invoice.payment_proof') }}">
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            {{ __('invoice.auto_generated') }} {{ $invoice->created_at->format('d/m/Y H:i') }} WIB<br>
            {{ __('invoice.thank_you') }}
            <div class="page-info">
                {{ __('invoice.invoice') }} {{ $invoice->code }} | {{ __('invoice.page') }} 1/1
            </div>
        </div>
    </div>
</body>
</html>