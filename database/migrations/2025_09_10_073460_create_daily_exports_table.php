<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_exports', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // tanggal export
            $table->string('file_path'); // lokasi file CSV/Excel
            $table->timestamp('sent_to_whatsapp_at')->nullable(); // waktu dikirim ke WhatsApp
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending'); // tracking status export
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_exports');
    }
};
