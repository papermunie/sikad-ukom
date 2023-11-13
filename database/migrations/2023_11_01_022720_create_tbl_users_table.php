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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->string('email_user',50)->nullable(false)->primary();
            $table->text('password')->nullable(false);
            $table->string('foto_profil',225)->nullable(false);
            $table->enum('role', ['Ketua DKM', 'Bendahara', 'Warga Sekolah']);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
    }
};
