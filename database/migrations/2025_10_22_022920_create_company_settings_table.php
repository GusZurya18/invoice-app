// database/migrations/xxxx_create_company_settings_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            
            // Alamat
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country')->default('Indonesia');
            
            // Kontak
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('fax')->nullable();
            
            // Legal
            $table->string('npwp');
            $table->string('siup_tdp')->nullable();
            
            // Bank
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_holder_name');
            
            // Tax
            $table->decimal('tax_rate', 5, 2)->default(11.00); // 11% default
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};