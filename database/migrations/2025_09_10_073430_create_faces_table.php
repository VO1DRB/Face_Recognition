<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // user pemilik wajah
            $table->foreignId('device_id')->nullable()->constrained('devices')->onDelete('set null'); // device yang registrasi
            $table->string('encoding_path'); // lokasi file encoding / template wajah
            $table->string('image_path')->nullable(); // opsional: foto wajah sumber
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // siapa yg daftar (admin/superadmin/device)
            $table->timestamps();
            $table->softDeletes(); // agar tidak benar-benar hilang
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faces');
    }
};
