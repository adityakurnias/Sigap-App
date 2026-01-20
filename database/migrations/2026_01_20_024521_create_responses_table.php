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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            
            // Relasi 1: Menjawab laporan yang mana?
            $table->foreignId('report_id')->constrained('reports')->cascadeOnDelete();
            
            // Relasi 2: Siapa petugas yang menjawab?
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('response_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
