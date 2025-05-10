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
        Schema::create('utang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_berhutang')->nullable(false);
            $table->date('tanggal_lunas')->nullable()->default(null);
            $table->string('nama')->nullable(false);
            $table->integer('barang_id')->nullable(false);
            $table->string('nama_barang')->nullable(false);
            $table->integer('jumlah_barang')->nullable(false);
            $table->double('nominal_utang')->nullable(false);
            $table->string('status')->nullable(false)->default('belum lunas');
            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER before_update_utang
            BEFORE UPDATE ON utang
            FOR EACH ROW
            BEGIN                
                IF NEW.tanggal_lunas IS NOT NULL THEN
                    SET NEW.status = 'lunas';
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS before_update_utang");
        Schema::dropIfExists('utang');
    }
};
