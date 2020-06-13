<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan_karyawan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pelatihan_id")->unsigned();
            $table->bigInteger("karyawan_id")->unsigned();
            $table->foreign("pelatihan_id")->references('id')->on('pelatihan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign("karyawan_id")->references('id')->on('karyawan')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pelatihan_karyawan');
    }
}
