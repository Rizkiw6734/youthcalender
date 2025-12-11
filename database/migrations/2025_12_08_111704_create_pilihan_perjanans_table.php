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
        Schema::create('pilihan_perjalanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulan_id')->constrained('bulans')->onDelete('cascade');
            $table->string('nama_destinasi');
            $table->string('negara')->nullable();
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_perjanans');
    }
};
