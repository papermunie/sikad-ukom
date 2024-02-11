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
        Schema::create('pemasukan_kas', function (Blueprint $table) {
            $table->string('kode_pemasukan', 10)->primary(); 
            $table->enum('jenis_pemasukan', ['Amal Harian', 'Sumbangan', 'Infaq']); 
            $table->date('tanggal_pemasukan')->default('2023-01-01'); 
            $table->decimal('jumlah_pemasukan', 15, 2); 
            $table->text('dokumentasi')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan_kas');
    }
};
