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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default('')->nullable(false);
            $table->double('harga_beli')->default(0)->nullable(false);
            $table->double('harga_jual')->default(0)->nullable(false);
            $table->double('stock')->default(0)->nullable(false);
            $table->double('terjual')->default(0)->nullable(false);
            $table->double('sisa_stock')->default(0)->nullable(false);
            $table->double('modal')->default(0)->nullable(false);
            $table->double('ekspektasi_pendapatan')->default(0)->nullable(false);
            $table->double('pendapatan')->default(0)->nullable(false);
            $table->double('laba')->default(0)->nullable(false);
            $table->string('status')->default('rugi')->nullable(false);
            $table->boolean('visibility')->default(true)->nullable(false);
            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER before_insert_barang
            BEFORE INSERT ON barang
            FOR EACH ROW
            BEGIN
                SET NEW.sisa_stock = NEW.stock - NEW.terjual;
                SET NEW.ekspektasi_pendapatan = NEW.harga_jual * NEW.stock;
                SET NEW.laba = NEW.pendapatan - NEW.modal;
                
                IF NEW.laba < 0 THEN
                    SET NEW.status = 'rugi';
                ELSEIF NEW.laba = 0 THEN
                    SET NEW.status = 'BEP';
                ELSE
                    SET NEW.status = 'untung';
                END IF;
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER before_update_barang
            BEFORE UPDATE ON barang
            FOR EACH ROW
            BEGIN
                SET NEW.sisa_stock = NEW.stock - NEW.terjual;    
                SET NEW.laba = NEW.pendapatan - NEW.modal;

                IF NEW.laba < 0 THEN
                    SET NEW.status = 'rugi';
                ELSEIF NEW.laba = 0 THEN
                    SET NEW.status = 'BEP';
                ELSE
                    SET NEW.status = 'untung';
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_barang;');
        DB::unprepared('DROP TRIGGER IF EXISTS before_update_barang;');
        Schema::dropIfExists('barang');
    }
};
