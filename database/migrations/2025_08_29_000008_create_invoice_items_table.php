<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('invoice_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->string('product_name');
        $table->integer('quantity')->default(1);
        $table->decimal('unit_price', 12, 2)->default(0);
        $table->decimal('total', 12, 2)->default(0);
        $table->timestamps();
    });

    }   

};
