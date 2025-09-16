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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_code')->unique(); // kode unik device
            $table->string('nama_device');
            $table->string('lokasi');
            $table->string('ip_address')->nullable();
            $table->string('status')->default('nonaktif');
            $table->timestamp('last_seen')->nullable(); // terakhir online
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
