<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
    'code','customer_id','status','notes','discount_percent','payment_proof',
    'start_date','due_date','paid_status','total_amount'
    ];

    protected $casts = [
    'start_date' => 'date',
    'due_date'   => 'date',
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

    public function getCalculatedTotalAttribute() {
        $total = $this->items->sum('total');
        return $total - ($total * $this->discount_percent / 100);
    }

}


