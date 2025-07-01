<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('areaID')->constrained('areas', 'id');
            $table->string('type');
            $table->string('category')->nullable();
            $table->string('cnic')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('ntn')->nullable();
            $table->string('strn')->nullable();
            $table->string('c_type')->default('Other');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
