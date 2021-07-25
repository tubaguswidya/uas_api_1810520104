<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGolongansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golongans', function (Blueprint $table) {
            $table->bigIncrements('id_golongan');
            $table->integer('id_jabatan');
            $table->string('tunjangan_nikah');
            $table->string('tunjangan_anak');
            $table->string('upah_makan');
            $table->string('lembur');
            $table->string('asuransi');
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
        Schema::dropIfExists('golongans');
    }
}
