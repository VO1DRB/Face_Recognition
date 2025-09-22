<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('device_id')->nullable()->constrained('devices')->onDelete('set null');
            $table->foreignId('face_id')->nullable()->constrained('faces')->onDelete('set null');
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->onDelete('set null');

            $table->enum('type', ['in','out']); // absensi masuk/keluar
            $table->enum('status', ['on_time','late','early_leave'])->nullable();

            $table->string('foto_path')->nullable();    // optional, bukti foto saat scan
            $table->string('encoding_path')->nullable(); // path file encoding, jangan simpan langsung
            $table->dateTime('scanned_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
