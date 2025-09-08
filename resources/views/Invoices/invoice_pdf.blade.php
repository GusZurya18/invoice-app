<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->code }}</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px 8px; 
            text-align: left; 
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f0f8ff;
        }
        
        .header { 
            text-align: center; 
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }
        
        .header h2 {
            color: #007bff;
            margin: 0 0 15px 0;
            font-size: 28px;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
        
        td:last-child, th:last-child {
            text-align: right;
        }
        
        tbody tr:last-child td,
        tbody tr:nth-last-child(2) td,
        tbody tr:nth-last-child(3) td {
            font-weight: bold;
            background-color: #e9ecef;
        }
        
        tbody tr:last-child td {
            background-color: #007bff;
            color: white;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Invoice {{ $invoice->code }}</h2>
            <p>Tanggal: {{ $invoice->created_at->format('Y-m-d') }}</p>
            <p>Customer: {{ $invoice->customer->name ?? $invoice->customer_name }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td>{{ number_format($invoice->items->sum('total'),2) }}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Diskon (%)</strong></td>
                    <td>{{ number_format($invoice->discount_percent ?? 0,2) }}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td>{{ number_format($invoice->total_amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        @if($invoice->payment_proof)
        <div style="margin-top:30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
            <p style="margin: 0 0 15px 0; font-weight: bold;">Bukti Pembayaran:</p>
            <img src="{{ public_path('storage/'.$invoice->payment_proof) }}" style="width:200px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        @endif
    </div>

    @if($invoice->notes)
    <div style="margin-top:20px; padding:10px; background:#f8f9fa; border-radius:5px;">
        <p style="margin:0; font-weight:bold;">Catatan:</p>
        <p style="margin:5px 0 0 0;">{{ $invoice->notes }}</p>
    </div>
    @endif


</body>
</html>