<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private $spName = 'prosedur_show_user
  ';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        DB::unprepared("DROP PROCEDURE IF EXISTS $this->spName;");
        DB::unprepared(
        "CREATE OR REPLACE PROCEDURE $this->spName()
        BEGIN
            SELECT * FROM tbl_user;
        END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared("DROP PROCEDURE IF EXISTS $this->spName;");
    }
};
