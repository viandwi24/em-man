<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->string('foto')->nullable();

            $table->bigInteger('bagian_id')->unsigned();
            $table->bigInteger('jabatan_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('outsourcing_id')->unsigned();

            $table->date('tanggal_masuk');
            $table->date('tanggal_lahir');
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
        Schema::dropIfExists('karyawan');
    }
}
