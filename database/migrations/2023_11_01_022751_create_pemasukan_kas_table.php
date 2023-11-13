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
            $table->char('kode_pemasukan', 10)->primary();
            $table->string('email_user',50)
            ->nullable(false);
            $table->char('id_kategori_pemasukan', 5)
            ->nullable(false);
            $table->dateTime('tanggal_pemasukan')
            ->default('2023-01-01 00:00:00')->nullable(false);
            $table->integer('jumlah_pemasukan')->nullable(false);
            //foreign key
            $table->foreign('email_user')->references('email_user')
            ->on('tbl_user')->onDelete('cascade')
            ->onUpdate('cascade');  
            $table->foreign('id_kategori_pemasukan')->references('id_kategori_pemasukan')
            ->on('kategori_pemasukan')->onDelete('cascade')
            ->onUpdate('cascade');  
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
