<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','customer_id','status','notes','payment_proof','discount_percent'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotalAmountAttribute() {
        $total = $this->items->sum('total');
        return $total - ($total * $this->discount_percent / 100);
    }
}


