<?php

use App\Models\Kunjungan;
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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kunjungan::class)->constrained()->cascadeOnDelete();
            $table->enum('jenis_bayar', ['Umum', 'BPJS']);
            $table->date('tanggal_periksa');
            $table->string('poli');
            $table->enum('status', ['Mengantri', 'Pemeriksaan', 'Selesai'])->default('Mengantri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
