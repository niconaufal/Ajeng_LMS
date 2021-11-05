<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jadwal_id', false)->unsigned()->nullable();
            $table->integer('bobot_pg')->nullable();
            $table->integer('bobot_essay')->nullable();
            $table->timestamps();
        });

        Schema::table('penilaian', function(Blueprint $table) {
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('set null');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
}
