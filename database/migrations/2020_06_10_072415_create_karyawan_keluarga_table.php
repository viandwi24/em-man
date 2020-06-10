<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('karyawan_id')->unsigned();
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onUpdate('cascade')->onDelete('cascade');
            $table->string("nama");
            $table->integer("usia");
            $table->string("pendidikan");
            $table->enum("keterangan", ["hidup", "meninggal"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan_keluarga');
    }
}
