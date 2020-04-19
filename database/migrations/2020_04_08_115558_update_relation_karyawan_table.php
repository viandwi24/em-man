<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRelationKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->foreign('bagian_id')->references('id')->on('bagian')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('unit')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('outsourcing_id')->references('id')->on('outsourcing')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('karyawan_pendidikan', function (Blueprint $table) {
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropForeign('karyawan_bagian_id_foreign');
            $table->dropForeign('karyawan_jabatan_id_foreign');
            $table->dropForeign('karyawan_unit_id_foreign');
            $table->dropForeign('karyawan_outsourcing_id_foreign');
        });
        Schema::table('karyawan_pendidikan', function (Blueprint $table) {
            $table->dropForeign('karyawan_pendidikan_karyawan_id_foreign');
        });
    }
}
