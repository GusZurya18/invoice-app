<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'status',
        'notes',
        'discount_percent',
        'tax_rate', // ← TAMBAHKAN INI
        'payment_proof',
        'start_date',
        'due_date',
        'paid_status',
        'total_amount'
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'discount_percent' => 'decimal:2',
        'tax_rate' => 'decimal:2', // ← TAMBAHKAN INI
    ];

    protected static function booted()
    {
        static::retrieved(function ($invoice) {
            if ($invoice->due_date && now()->gt($invoice->due_date) && $invoice->paid_status !== 'done') {
                $invoice->paid_status = 'overdue';
                $invoice->save();
            }
        });
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }

    // ========== HELPER METHODS UNTUK CALCULATION ==========
    
    // 1. Subtotal (sebelum diskon dan pajak)
    public function getSubtotalAttribute() {
        return $this->items->sum('total');
    }

    // 2. Jumlah diskon dalam rupiah
    public function getDiscountAmountAttribute() {
        return $this->subtotal * ($this->discount_percent / 100);
    }

    // 3. Subtotal setelah diskon (sebelum pajak)
    public function getSubtotalAfterDiscountAttribute() {
        return $this->subtotal - $this->discount_amount;
    }

    // 4. Jumlah pajak dalam rupiah
    public function getTaxAmountAttribute() {
        return $this->subtotal_after_discount * ($this->tax_rate / 100);
    }

    // 5. Grand Total (setelah diskon dan pajak)
    public function getGrandTotalAttribute() {
        return $this->subtotal_after_discount + $this->tax_amount;
    }

    // Legacy - untuk backward compatibility
    public function getCalculatedTotalAttribute() {
        return $this->grand_total;
    }
}