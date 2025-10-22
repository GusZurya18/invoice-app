<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'logo',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'phone',
        'email',
        'website',
        'fax',
        'npwp',
        'siup_tdp',
        'bank_name',
        'account_number',
        'account_holder_name',
        'tax_rate',
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
    ];

    // Singleton pattern - hanya 1 company setting
    public static function current()
    {
        return static::first() ?? static::create([
            'company_name' => 'Nama Perusahaan',
            'address' => 'Alamat',
            'city' => 'Kota',
            'province' => 'Provinsi',
            'postal_code' => '00000',
            'country' => 'Indonesia',
            'phone' => '0000000000',
            'email' => 'info@company.com',
            'npwp' => '00.000.000.0-000.000',
            'bank_name' => 'Bank',
            'account_number' => '0000000000',
            'account_holder_name' => 'Nama Pemilik',
            'tax_rate' => 11.00,
        ]);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}