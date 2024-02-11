<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('email_user',50)->nullable(false)->primary();
            $table->text('password')->nullable(false);
            $table->longText('foto_profil',225)->nullable(false);
            $table->enum('role', ['ketua_dkm', 'bendahara', 'warga_sekolah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
