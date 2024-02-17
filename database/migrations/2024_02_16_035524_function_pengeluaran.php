<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  private $spName = 'generate_pengeluaran
  ';

  public function up(): void
  {
    DB::unprepared("DROP FUNCTION IF EXISTS $this->spName;");
    DB::unprepared(
      "CREATE OR REPLACE FUNCTION $this->spName() RETURNS VARCHAR(4)
    BEGIN
        DECLARE new_id VARCHAR(4);
        DECLARE next_number INT;
    
        -- Mencari kode maximum
        SELECT MAX(CAST(SUBSTRING(kode_pengeluaran
        , 2) AS SIGNED)) INTO next_number FROM pengeluaran_kas WHERE kode_pengeluaran
         LIKE 'P%';

        -- check jika table kosong maka angka selanjutnya 1
        IF next_number IS NULL THEN
            SET next_number = 1;
        ELSE
        SET next_number = next_number + 1;
        END IF;
    
        -- membuat kode baru
        SET new_id = CONCAT('P', LPAD(next_number, 3, '0'));
    
        RETURN new_id;
    END;");
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    DB::unprepared("DROP FUNCTION IF EXISTS $this->spName");
  }
};