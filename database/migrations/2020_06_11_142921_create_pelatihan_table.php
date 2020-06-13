<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("periode_id")->unsigned();
            $table->string("nama");
            $table->json("usulan")->default(new Expression('(JSON_OBJECT())'));
            $table->json("materi")->default(new Expression('(JSON_ARRAY())'));
            $table->json("laporan")->default(new Expression('(JSON_OBJECT())'));
            $table->json("evaluasi")->default(new Expression('(JSON_OBJECT())'));
            $table->string("disetujui")->nullable();
            $table->string("disetujui_jabatan")->nullable();
            $table->string("dibuat")->nullable();
            $table->string("dibuat_jabatan")->nullable();
            $table->string("no_dokumentasi")->nullable();
            $table->string("no_revisi")->nullable();
            $table->string("instruktur")->nullable();
            $table->string("lokasi")->nullable();
            $table->date("terbit")->nullable();
            $table->date("pelatihan")->nullable();
            $table->timestamps();

            $table->foreign("periode_id")->references('id')->on('periode')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatihan');
    }
}
