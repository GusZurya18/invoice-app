<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        $table->enum('status',['draft','pending','paid','cancelled'])->default('pending');
        $table->decimal('discount_percent',5,2)->default(0);
        $table->text('notes')->nullable();
        $table->string('payment_proof')->nullable();
        $table->timestamps();
    });



}

};
