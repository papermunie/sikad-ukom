<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER before_pemasukan_insert
            BEFORE INSERT ON pemasukan_kas
            FOR EACH ROW
            BEGIN
                SET NEW.created_at = NOW();
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_pemasukan_insert');
    }
};
