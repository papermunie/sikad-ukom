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
        Schema::create('pengeluaran_kas', function (Blueprint $table) {
            $table->string('kode_pengeluaran', 10); 
            $table->primary('kode_pengeluaran');
            $table->string('jenis_pengeluaran')->nullable(false);
            $table->date('tanggal_pengeluaran')
            ->default('2023-01-01')->nullable(false);
            $table->string('jumlah_pengeluaran')->nullable(false);
            $table->text('dokumentasi')->nullable(true);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_kas');
    }
};
