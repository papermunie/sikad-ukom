<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan store function
        DB::unprepared("
            CREATE FUNCTION log_activity(entity VARCHAR(255), entity_id INT, action VARCHAR(255))
            RETURNS INT
            BEGIN
                INSERT INTO activity_logs (entity, entity_id, action, created_at, updated_at) 
                VALUES (entity, entity_id, action, NOW(), NOW());
                RETURN LAST_INSERT_ID();
            END
        ");

        // Tambahkan store procedure
        DB::unprepared("
            CREATE PROCEDURE record_activity(IN entity VARCHAR(255), IN entity_id INT, IN action VARCHAR(255))
            BEGIN
                INSERT INTO activity_logs (entity, entity_id, action, created_at, updated_at) 
                VALUES (entity, entity_id, action, NOW(), NOW());
            END
        ");

        // Tambahkan trigger untuk tabel tbl_user
        DB::unprepared("
            CREATE TRIGGER trg_tbl_user_activity
            AFTER INSERT, UPDATE, DELETE ON tbl_user
            FOR EACH ROW
            BEGIN
                -- Notifikasi untuk setiap operasi CRUD pada tbl_user
                CALL record_activity('tbl_user', NEW.email_user, IFNULL(OLD.email_user, '') <> '' ? 'updated' : 'created');
            END
        ");

        // Tambahkan trigger untuk tabel pengeluaran_kas
        DB::unprepared("
            CREATE TRIGGER trg_pengeluaran_kas_activity
            AFTER INSERT, UPDATE, DELETE ON pengeluaran_kas
            FOR EACH ROW
            BEGIN
                -- Notifikasi untuk setiap operasi CRUD pada pengeluaran_kas
                CALL record_activity('pengeluaran_kas', NEW.kode_pengeluaran, IFNULL(OLD.kode_pengeluaran, '') <> '' ? 'updated' : 'created');
            END
        ");

        // Tambahkan trigger untuk tabel pemasukan_kas
        DB::unprepared("
            CREATE TRIGGER trg_pemasukan_kas_activity
            AFTER INSERT, UPDATE, DELETE ON pemasukan_kas
            FOR EACH ROW
            BEGIN
                -- Notifikasi untuk setiap operasi CRUD pada pemasukan_kas
                CALL record_activity('pemasukan_kas', NEW.kode_pemasukan, IFNULL(OLD.kode_pemasukan, '') <> '' ? 'updated' : 'created');
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop store function jika diperlukan
        DB::unprepared("DROP FUNCTION IF EXISTS log_activity");

        // Drop store procedure jika diperlukan
        DB::unprepared("DROP PROCEDURE IF EXISTS record_activity");

        // Drop trigger jika diperlukan
        DB::unprepared("DROP TRIGGER IF EXISTS trg_tbl_user_activity");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_pengeluaran_kas_activity");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_pemasukan_kas_activity");
    }
}
