<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getOrdersCountAttribute()
    {
        return $this->invoices()->count();
    }
    
}
