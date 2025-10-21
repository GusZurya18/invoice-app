<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending','in_progress','done'])->default('pending');
            $table->date('deadline')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // assigned user
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // admin creator
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};