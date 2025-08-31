<x-app-layout>
    <x-slot name="header">
        <h2>Invoice {{ $invoice->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Customer: {{ $invoice->customer_name }}</p>
                <p>Status: {{ $invoice->status }}</p>
                <p>Total: {{ number_format($invoice->total_amount,2) }}</p>

                <a href="{{ route('invoices.pdf', $invoice) }}">Download PDF</a>

                @if($invoice->payment_proof)
                    <div>
                        <img src="{{ asset('storage/'.$invoice->payment_proof) }}" alt="Bukti" style="max-width:300px">
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
