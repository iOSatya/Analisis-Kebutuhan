<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER set_default_periode_and_status
            BEFORE INSERT ON keuangans
            FOR EACH ROW
            BEGIN
                IF NEW.periode IS NULL THEN
                    SET NEW.periode = CURDATE();
                END IF;

                IF NEW.pendapatan >= NEW.ekspektasi THEN
                    SET NEW.status = TRUE;
                ELSE
                    SET NEW.status = FALSE;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS set_default_periode_and_status');
    }
};
