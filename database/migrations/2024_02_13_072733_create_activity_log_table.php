<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('auth');
            $table->string('entity');
            $table->string('entity_id');
            $table->string('action');
            $table->timestamps();
        });

        // Tambahkan store function
        DB::unprepared(
            "CREATE OR REPLACE FUNCTION log_activity(entity VARCHAR(255), entity_id INT, action VARCHAR(255))
            RETURNS INT
            BEGIN
                INSERT INTO activity_logs (entity, entity_id, action, created_at, updated_at) 
                VALUES (entity, entity_id, action, NOW(), NOW());
                RETURN LAST_INSERT_ID();
            END
        ");

        // Tambahkan store procedure
        DB::unprepared(
            "CREATE OR REPLACE PROCEDURE record_activity(IN entity VARCHAR(255), IN entity_id INT, IN action VARCHAR(255))
            BEGIN
                INSERT INTO activity_logs (entity, entity_id, action, created_at, updated_at) 
                VALUES (entity, entity_id, action, NOW(), NOW());
            END
        ");

        // Tambahkan trigger
        DB::unprepared("
            CREATE TRIGGER log_activity_trigger
            AFTER INSERT ON activity_logs
            FOR EACH ROW
            BEGIN
                -- Lakukan sesuatu setelah log aktivitas dimasukkan
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
        Schema::dropIfExists('activity_logs');

        // Drop store function jika diperlukan
        DB::unprepared("DROP FUNCTION IF EXISTS log_activity");

        // Drop store procedure jika diperlukan
        DB::unprepared("DROP PROCEDURE IF EXISTS record_activity");

        // Drop trigger jika diperlukan
        DB::unprepared("DROP TRIGGER IF EXISTS log_activity_trigger");
    }
}