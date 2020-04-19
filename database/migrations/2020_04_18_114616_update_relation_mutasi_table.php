<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRelationMutasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bagian_id')->references('id')->on('bagian')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('unit')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('outsourcing_id')->references('id')->on('outsourcing')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->dropForeign('mutasi_karyawan_id_foreign');
            $table->dropForeign('mutasi_bagian_id_foreign');
            $table->dropForeign('mutasi_jabatan_id_foreign');
            $table->dropForeign('mutasi_unit_id_foreign');
            $table->dropForeign('mutasi_outsourcing_id_foreign');
        });
    }
}
