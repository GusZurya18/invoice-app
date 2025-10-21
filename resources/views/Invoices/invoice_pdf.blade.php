<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $invoice->code }}</title>
    <style>
        @page {
            margin: 10mm;
        }
        
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 9pt;
        }
        
        .page-header {
            text-align: center;
            font-size: 8pt;
            color: #666;
            margin-bottom: 8px;
            padding: 5px 0;
        }
        
        /* Header dengan gradient */
        .invoice-header {
            background: linear-gradient(135deg, #5B6FE8 0%, #9B6FE8 50%, #D16FE8 100%);
            color: white;
            padding: 18px 20px;
            margin-bottom: 0;
        }
        
        .header-row {
            display: table;
            width: 100%;
        }
        
        .header-left {
            display: table-cell;
            width: 65%;
            vertical-align: middle;
        }
        
        .header-right {
            display: table-cell;
            width: 35%;
            text-align: right;
            vertical-align: middle;
        }
        
        .voice-title {
            margin: 0;
            font-size: 22pt;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        
        .no-invoice {
            background-color: rgba(100, 100, 255, 0.4);
            display: inline-block;
            padding: 5px 12px;
            margin-top: 8px;
            font-size: 8.5pt;
            border-radius: 3px;
        }
        
        .tanggal-label {
            font-size: 8.5pt;
            margin: 0;
            font-weight: normal;
        }
        
        .tanggal-besar {
            font-size: 40pt;
            font-weight: bold;
            line-height: 1;
            margin: 5px 0 0 0;
        }
        
        .bulan-tahun {
            font-size: 9pt;
            margin: 2px 0 0 0;
        }
        
        /* Info Pelanggan */
        .info-pelanggan {
            background-color: #F5F6F8;
            padding: 14px 18px;
            margin: 0;
        }
        
        .info-title {
            margin: 0 0 10px 0;
            font-size: 9.5pt;
            font-weight: bold;
            color: #000;
        }
        
        .nama-pelanggan {
            font-weight: bold;
            font-size: 10pt;
            margin: 0 0 8px 0;
            color: #000;
        }
        
        .info-detail {
            margin: 5px 0;
            font-size: 9pt;
            color: #333;
        }
        
        /* Status Container */
        .status-wrapper {
            border: 2px solid #FFC107;
            background-color: #FFFDF5;
            padding: 14px 18px;
            margin: 0;
        }
        
        .status-line {
            margin: 8px 0;
            font-size: 9.5pt;
        }
        
        .label-status {
            display: inline-block;
            width: 155px;
            color: #000;
        }
        
        .badge-status {
            display: inline-block;
            padding: 4px 14px;
            font-weight: bold;
            font-size: 8pt;
            border-radius: 3px;
        }
        
        .badge-pending {
            background-color: #FFF4CD;
            color: #7C6F00;
        }
        
        .badge-overdue {
            background-color: #FFE5E8;
            color: #8B0000;
        }
        
        /* Date Info */
        .date-info {
            padding: 14px 18px 0 18px;
        }
        
        .date-line {
            margin: 7px 0;
            font-size: 9.5pt;
        }
        
        .label-date {
            display: inline-block;
            width: 110px;
            color: #000;
        }
        
        .value-date {
            font-weight: bold;
            color: #000;
        }
        
        .red-date {
            color: #DC3545;
        }
        
        /* Item Invoice */
        .section-title {
            padding: 18px 18px 8px 18px;
            font-size: 10pt;
            font-weight: bold;
            color: #000;
            margin: 0;
        }
        
        .table-wrapper {
            padding: 0 18px;
        }
        
        .item-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 0;
        }
        
        .item-table thead {
            background-color: #F8F9FA;
        }
        
        .item-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #DEE2E6;
            color: #000;
            font-size: 9pt;
        }
        
        .item-table td {
            padding: 12px 10px;
            border: 1px solid #DEE2E6;
            background-color: #FAFBFC;
            color: #000;
        }
        
        .align-center {
            text-align: center;
        }
        
        .align-right {
            text-align: right;
        }
        
        /* Catatan */
        .catatan-wrapper {
            padding: 12px 18px;
        }
        
        .catatan-content {
            background-color: #FFF8E6;
            border-left: 3px solid #FF9800;
            padding: 14px 16px;
        }
        
        .catatan-judul {
            margin: 0 0 8px 0;
            font-size: 9.5pt;
            font-weight: bold;
            color: #E65100;
        }
        
        .catatan-text {
            margin: 0;
            font-size: 9pt;
            color: #000;
        }
        
        /* Ringkasan */
        .ringkasan-wrapper {
            padding: 12px 18px;
        }
        
        .ringkasan-content {
            background-color: #F8F9FA;
            border: 1px solid #DEE2E6;
            padding: 16px 18px;
        }
        
        .ringkasan-judul {
            margin: 0 0 14px 0;
            font-size: 10pt;
            font-weight: bold;
            color: #000;
        }
        
        .ringkasan-baris {
            margin: 12px 0;
            font-size: 9.5pt;
        }
        
        .ringkasan-baris:after {
            content: "";
            display: table;
            clear: both;
        }
        
        .label-ringkasan {
            float: left;
            color: #000;
        }
        
        .value-ringkasan {
            float: right;
            font-weight: bold;
            color: #000;
        }
        
        .total-baris {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #CCC;
        }
        
        .total-baris .label-ringkasan {
            font-weight: bold;
            font-size: 10pt;
        }
        
        .total-baris .value-ringkasan {
            color: #28A745;
            font-size: 13pt;
            font-weight: bold;
        }
        
        /* Footer */
        .footer-info {
            text-align: center;
            font-size: 8pt;
            color: #666;
            margin-top: 20px;
            padding: 14px 0;
            border-top: 1px solid #DDD;
        }
        
        /* Payment */
        .payment-wrapper {
            padding: 12px 18px;
        }
        
        .payment-content {
            background-color: #F8F9FA;
            border: 1px solid #DEE2E6;
            padding: 14px 16px;
        }
        
        .payment-judul {
            margin: 0 0 12px 0;
            font-size: 9.5pt;
            font-weight: bold;
        }
        
        .payment-content img {
            max-width: 200px;
            border: 1px solid #CCC;
        }
        
        .page-bottom {
            position: fixed;
            bottom: 5px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7.5pt;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="page-header">
        {{ date('n/j/y, g:i A') }}<span style="margin: 0 220px;"></span>Invoice Details
    </div>

    <!-- Header Gradient -->
    <div class="invoice-header">
        <div class="header-row">
            <div class="header-left">
                <h1 class="voice-title">≡ VOICE</h1>
                <div class="no-invoice">No. Invoice: {{ $invoice->code }}</div>
            </div>
            <div class="header-right">
                <p class="tanggal-label">Tanggal Invoice</p>
                <p class="tanggal-besar">{{ str_pad($invoice->created_at->format('d'), 2, '0', STR_PAD_LEFT) }}</p>
                <p class="bulan-tahun">{{ $invoice->created_at->format('M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Info Pelanggan -->
    <div class="info-pelanggan">
        <p class="info-title">👤 Informasi Pelanggan</p>
        <p class="nama-pelanggan">{{ $invoice->customer->name ?? $invoice->customer_name }}</p>
        @if(isset($invoice->customer->email))
        <p class="info-detail">✉ {{ $invoice->customer->email }}</p>
        @endif
        @if(isset($invoice->customer->phone))
        <p class="info-detail">☎ {{ $invoice->customer->phone }}</p>
        @endif
        @if(isset($invoice->customer->address))
        <p class="info-detail">📍 {{ $invoice->customer->address }}</p>
        @endif
    </div>

    <!-- Status -->
    <div class="status-wrapper">
        @if(isset($invoice->status))
        <div class="status-line">
            <span class="label-status">Status Invoice</span>
            <span class="badge-status badge-pending">{{ strtoupper($invoice->status) }}</span>
        </div>
        @endif
        @if(isset($invoice->payment_status))
        <div class="status-line">
            <span class="label-status">Status Pembayaran</span>
            <span class="badge-status badge-overdue">{{ strtoupper($invoice->payment_status) }}</span>
        </div>
        @endif
    </div>

    <!-- Date Info -->
    <div class="date-info">
        <div class="date-line">
            <span class="label-date">Tanggal Mulai:</span>
            <span class="value-date">{{ $invoice->created_at->format('d/m/Y') }}</span>
        </div>
        @if(isset($invoice->due_date))
        <div class="date-line">
            <span class="label-date">Jatuh Tempo:</span>
            <span class="value-date red-date">{{ $invoice->due_date->format('d/m/Y') }}</span>
        </div>
        @endif
    </div>

    <!-- Item Invoice -->
    <p class="section-title">📋 Item Invoice</p>
    <div class="table-wrapper">
        <table class="item-table">
            <thead>
                <tr>
                    <th style="width: 8%;" class="align-center">NO</th>
                    <th style="width: 42%;">PRODUK</th>
                    <th style="width: 12%;" class="align-center">QTY</th>
                    <th style="width: 19%;" class="align-right">HARGA SATUAN</th>
                    <th style="width: 19%;" class="align-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $index => $item)
                <tr>
                    <td class="align-center">{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="align-center">{{ $item->quantity }}</td>
                    <td class="align-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="align-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Catatan -->
    @if($invoice->notes)
    <div class="catatan-wrapper">
        <div class="catatan-content">
            <p class="catatan-judul">📝 Catatan</p>
            <p class="catatan-text">{{ $invoice->notes }}</p>
        </div>
    </div>
    @endif

    <!-- Ringkasan -->
    <div class="ringkasan-wrapper">
        <div class="ringkasan-content">
            <p class="ringkasan-judul">📊 Ringkasan</p>
            <div class="ringkasan-baris">
                <span class="label-ringkasan">Subtotal:</span>
                <span class="value-ringkasan">Rp {{ number_format($invoice->items->sum('total'), 0, ',', '.') }}</span>
            </div>
            <div class="ringkasan-baris total-baris">
                <span class="label-ringkasan">Grand Total:</span>
                <span class="value-ringkasan">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Payment Proof -->
    @if($invoice->payment_proof)
    <div class="payment-wrapper">
        <div class="payment-content">
            <p class="payment-judul">💳 Bukti Pembayaran:</p>
            <img src="{{ public_path('storage/'.$invoice->payment_proof) }}" alt="Payment Proof">
        </div>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer-info">
        🕐 Invoice dibuat otomatis pada {{ $invoice->created_at->format('d/m/Y H:i') }} WIB
    </div>

    <div class="page-bottom">
        127.0.0.1:8000/invoices/{{ $invoice->id }}<span style="margin: 0 280px;"></span>1/1
    </div>
</body>
</html>